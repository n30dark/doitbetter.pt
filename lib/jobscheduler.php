<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 *
 * Classe para criação e execução de scheduled jobs
 *
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

define('TIME_WINDOW', 3600);//60 mins de time_window
define('ERROR_LOG', TRUE);// prints runs and errors to error log table
define('LOCATION', dirname(__FILE__) ."/");//abrir ficheiros locais
define('JS_TABLE','jobscheduler');//nome da tabela js
define('LOGS_TABLE','jobscheduler_logs');//tabela logs
define('MAX_ERROR_LOG_LENGTH',1200);//tamanho máximo da string para a gravação de erro na tabela de logs
define('SHOW_MYSQL_ERRORS', false); //se ocorrerem erros com mysql, não apresentar

class JobScheduler{

    var $bd;
    
    function  __construct() {
        $this->bd = new BaseDados();
    }

    function limpar_input($string){
        $padroes[0] = "/'/";
        $padroes[1] = "/\"/";
        $string = preg_replace($padroes,'',$string);
        $string = trim($string);
        $string = stripslashes($string);
        return preg_replace("/[<>]/",'_',$string);
    }

    function actualizar_bd(){
        if($this->bd->executar("SHOW TABLES LIKE '".LOGS_TABLE."'")==0){
            $resultado = $this->bd->executar("CREATE TABLE ".LOGS_TABLE."(
                                    id int(11) NOT NULL,
                                    script varchar(128) default NULL,
                                    output text default NULL,
                                    execution_time varchar(60) default NULL,
                                    PRIMARY KEY (id)
                                ) TYPE=MyISAM");
        }

        if($this->bd->executar("SHOW TABLES LIKE '".JS_TABLE."'")==0){
            $resultado = $this->bd->executar("CREATE TABLE ".PJS_TABLE." (
                                    id int(11) NOT NULL auto_increment,
                                    scriptpath varchar(255) default NULL,
                                    name varchar(128) default NULL,
                                    time_interval int(11) default NULL,
                                    fire_time int(11) default NULL,
                                    time_last_fired int(11) default NULL,
                                    run_only_once tinyint(1) NOT NULL DEFAULT '0',
                                    PRIMARY KEY (id),
                                    KEY fire_time (fire_time)) TYPE=MyISAM");
        }
    }

    function unidade_tempo($intervalo_tempo){
        $unidade = array(0, 'type');
        if($intervalo_tempo <= (59*60)){
            $unidade[0] = $intervalo_tempo/60;
            $unidade[1]="minutos";
        }
        if(($intervalo_tempo > (59*60)) && ($intervalo_tempo <= (23*3600))){
            $unidade[0] = $intervalo_tempo/3600;
            $unidade[1] = "horas";
        }
        if(($intervalo_tempo > (23*3600)) && ($intervalo_tempo <= (6*86400))){
            $unidade[0] = $intervalo_tempo/86400;
            $unidade[1] = "dias";
        }
        if($intervalo_tempo > (6*86400)){
            $unidade[0] = $intervalo_tempo/604800;
            $unidade[1] = "semanas";
        }
        $dominio = $_SERVER['HTTP_HOST'];
        return $unidade;
    }

    function salvar_log($script, $saida, $tempo_execucao){
        $agora = time();
        $script = $this->limpar_input($script);
        $saida = htmlentities($saida);
        $this->bd->executar("INSERT INTO ".LOGS_TABLE." (id, script, output, execution_time) VALUES ('$now','$script','$saida','$tempo_execucao')");
    }

    function mostrar_jobs(){
        $jobs = $this->bd->obterArrayDados("SELECT * FROM ".JS_TABLE);
        if(!$jobs)
            BO_JAVASCRIPT::alert("Ocorreu um erro: ".$this->bd->desc_ultimo_erro());
        else{
            return $jobs;
        }
    }

    function mostrar_logs($qstart){
        $num = 5;
        $next_logs = $num+$qstart;
        $logs = $this->bd->obterArrayDados("SELECT * FROM ".LOGS_TABLE." ORDER BY id DESC LIMIT $qstart, $num");
        if(!$logs)
            BO_JAVASCRIPT::alert("Ocorreu um erro: ".$this->bd->desc_ultimo_erro());
        else{
            return $logs;
        }
    }

    function executar_script($script, $buffer_saida=1){
        if(!session_id()){
            session_start();
        }
        $md5_script = md5($script);
        if(!isset($_SESSION[$md5_script])){
            $_SESSION[$md5_script] = "em-execucao";
            $tempo_inicio = microtime(true);

            if($bufer_saida){
                ob_start();
            }

            $tipo_execucao = (function_exists('curl_exec'))?" PHP CURL":" PHP fsockopen";

            if(strstr($script,"://")){
                    executar_script_remoto($script);


            }else{
                include(LOCATION.$script);
                $tipo_execucao = " PHP include";
            }

            if($buffer_saida){
                $saida = ob_get_contents();
            }else{
                $saida = "";
            }

            if($buffer_saida){
                ob_end_clean();
            }

            $tempo_execucao = number_format((microtime(true)-$start_time),5)."segundos via".$tipo_execucao;
            $saida = substr($saida,0,MAX_ERROR_LOG_LENGTH);
            
            if(ERROR_LOG){
                $this->salvar_log($script, $saida, $tempo_execucao);
            }

            unset($_SESSION[$md5_script]);
        }
    }

    function executar_script_remoto($url){
        $url_parsed = parse_url($url);
        $scheme = $url_parsed["scheme"];
        $host = $url_parsed["host"];
        $port = isset($url_parsed["port"]) ? $url_parsed["port"] : 80;
        $path = isset($url_parsed["path"]) ? $url_parsed["path"] : "/";
        $referer=$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        $buffer = "";

        if(function_exists('curl_exec')){
            $cURL = curl_init($url);
            curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);

            $buffer = curl_exec($cURL);
            curl_close($cURL);
        }elseif($fp = @fsockopen($host, $port, $errno, $errstr, 30)){
            $header = "POST $path HTTP/1.0\r\nHost: $host\r\nReferer: $referer\r\n"
                    ."Content-Type: application/x-www-form-urlencoded\r\n"
                    ."Connection: close\r\n\r\n";
            fputs($fp, $header);
            if($fp){
                while(!feof($fp)){
                    $buffer .= fgets($fp, 8192);
                }
            }
            @fclose($fp);
        }
        echo $buffer;
    }

    function adicionar_tarefa($nome, $script, $minutos, $horas, $dias, $semanas, $executar_uma_vez){
        if($minutos>0){
            $intervalo_tempo = $minutos*60;
        }elseif($horas>0){
            $intervalo_tempo = $horas*3600;
        }elseif($dias>0){
            $intervalo_tempo = $dias*86400;
        }else{
            $intervalo_tempo = $semanas*604800;
        }

        $tempo_execucao = time() + $intervalo_tempo;
        $resultado = $this->bd->executar("INSERT INTO jobscheduler 
                                (scriptpath, name, time_interval, fire_time, time_last_fired, run_only_once)
                            VALUES
                                ('$script','$nome','$intervalo_tempo','$tempo_execucao','0','$executar_uma_vez')");
        if(!resultado){
            BO_JAVASCRIPT::alert("Ocorreu um erro: ".$this->bd->desc_ultimo_erro());
        }
    }

    function editar_tarefa($id, $nome, $script, $minutos, $horas, $dias, $semanas, $ultima_vez_executada, $executar_uma_vez){
        if($minutos>0){
            $intervalo_tempo = $minutos*60;
        }elseif($horas>0){
            $intervalo_tempo = $horas*3600;
        }elseif($dias>0){
            $intervalo_tempo = $dias*86400;
        }else{
            $intervalo_tempo = $semanas*604800;
        }

        $ultima_vez_executada = ($ultima_vez_executada)? $ultima_vez_executada:time();
        $tempo_execucao = $ultima_vez_executada + $intervalo_tempo;

        $resultado = $this->bd->executar("UPDATE jobscheduler
                                            SET
                                        name='$nome',
                                        scriptpath='$script',
                                        time_interval='$intervalo_tempo',
                                        fire_time='$tempo_execucao',
                                        run_only_once='$executar_uma_vez'
                                            WHERE id='$id'");
        if(!resultado){
            BO_JAVASCRIPT::alert("Ocorreu um erro: ".$this->bd->desc_ultimo_erro());
        }
    }

    function eliminar_tarefa($id){
        $resultado = $this->bd->executar("DELETE FROM jobscheduler WHERE id='$id'");

        if(!resultado){
            BO_JAVASCRIPT::alert("Ocorreu um erro: ".$this->bd->desc_ultimo_erro());
        }
    }

    function executar_tarefas(){
        $tempo_e_janela = time() + TIME_WINDOW;
        $tarefas = $this->bd->obterArrayObjectos("SELECT * FROM jobscheduler WHERE fire_time <= $tempo_e_janela");
        $i=0;
        foreach($tarefas as $tarefa){
            $id = $tarefa->id;
            $script = $tarefa->scriptpath;
            $intervalo_tempo = $tarefa->time_interval;
            $tempo_execucao = $tarefa->fire_time;
            
        }
    }
}
?>
