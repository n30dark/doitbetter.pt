<?php
class home_plugin extends Plugin{

    function index($parametros){
        $variaveis = new Buffer();

        $this->template->adicionarCSS('estilos/site/normalize.css');
        $this->template->adicionarCSS('estilos/site/style.css');
        $this->template->adicionarCSS('js/jquery/ui/jquery-ui-1.8.22.custom.css');
        $this->template->adicionarCSS('js/jquery-lightbox/css/jquery.lightbox-0.5.css');            
                

        $this->template->adicionarJS('js/jquery/ui/jquery-1.7.2.min.js');
        $this->template->adicionarJS('js/jclock.js');
        $this->template->adicionarJS('js/jquery.form.js');
        $this->template->adicionarJS('js/home.js');
        $this->template->adicionarJS('js/jquery/ui/jquery-ui-1.8.22.custom.min.js');
        $this->template->adicionarJS('js/jquery-lightbox/js/jquery.lightbox-0.5.min.js');

        $install = $this->template->Instalacao;

        $QS = new QueryString();        
        
        if(isset($QS->Segmentos[1]) && $QS->Segmentos[1]!="" && $QS->Segmentos[0]!="produto")
		$lingua = $QS->Segmentos[1];
	else
		$lingua = "pt";
        
        $lingua = new Lingua("site", "home", $lingua);
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);

        $vista = new Vista('vista_stage');
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();

        $this->template->adicionarVista($vista, 'stage');
    }
    
    function banner($parametros){
        $variaveis = new Buffer();
        
        $bd = new Basedados();
        $banner = $bd->obterArrayObjectos("SELECT * FROM artigos WHERE tipo_artigo='destaque' ORDER BY ordem");
        foreach($banner as $option){
            $images = $bd->obterArrayObjectos("SELECT * FROM artigos_imagens WHERE parent='".$option->aliasweb."'");      
            $option->icon = $images[0]->nome;
            $option->image2 = $images[1]->nome;
        }
        
        $lingua = $parametros[1];
        
        $lingua = new Lingua("site", "home", $lingua);          
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        $variaveis->adicionar("banner", $banner);
        
        $vista = new Vista("vista_banner");
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "banner";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function newsletter($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        
        $lingua = new Lingua("site", "home", $lingua);          
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        
        $vista = new Vista("vista_newsletter");
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "newsletter";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function apps($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        
        $lingua = new Lingua("site", "home", $lingua);          
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        
        $vista = new Vista("vista_apps");
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "apps";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function logo($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        
        $lingua = new Lingua("site", "home", $lingua);          
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        
        $vista = new Vista("vista_logo");
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "logo";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function phone($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        
        $lingua = new Lingua("site", "home", $lingua);          
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        
        $vista = new Vista("vista_phone");
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "phone";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function courses($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        
        $bd = new Basedados();
        $cursos = $bd->obterArrayObjectos("SELECT * FROM paginas WHERE seccao='cursos' AND posicao>0 ORDER BY posicao LIMIT 6");
        $variaveis->adicionar("cursos", $cursos);
        
        $lingua = new Lingua("site", "home", $lingua);          
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        
        $vista = new Vista("vista_courses");
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "courses";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function promos($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        
        $bd = new Basedados();
        $promos = $bd->obterArrayObjectos("SELECT * FROM artigos WHERE tipo_artigo='promo-es' LIMIT 2");
        $variaveis->adicionar("promos", $promos);
        
        $lingua = new Lingua("site", "home", $lingua);          
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        
        $vista = new Vista("vista_promos");
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "promos";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function legal($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        
        $lingua = new Lingua("site", "home", $lingua);          
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        
        $vista = new Vista("vista_legal");
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "legal";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function contador($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        
        $lingua = new Lingua("site", "home", $lingua);          
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        
        $vista = new Vista("vista_contador");
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "contador";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    
    function seccoes($parametros){
        $variaveis = new Buffer();
        
        $lingua = $parametros[1];
        
        
        
        $lingua = new Lingua("site", "home", $lingua);          
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        
        $vista = new Vista("vista_seccoes");
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "seccoes";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function extras($parametros){
       $variaveis = new Buffer();
       
      $lingua = $parametros[1];
        
        $bd = new Basedados();
        $seccoes = $bd->obterArrayObjectos("SELECT * FROM paginas WHERE seccao='extras'");
        foreach($seccoes as $option){
            $image = $bd->obterObjecto("SELECT * FROM paginas_imagens WHERE parent='".$option->aliasweb."'");
            //var_dump($image);
            $option->image = $image->nome;
        }
        $variaveis->adicionar("seccoes", $seccoes);
        
        $lingua = new Lingua("site", "home", $lingua);          
        $variaveis->adicionar("conf", $this->Conf);
        $variaveis->adicionar("lingua", $lingua);
        
        $vista = new Vista("vista_extras");
        $vista->caminhoBase = $this->caminhoBase . '/vistas';
        $vista->variaveis = $variaveis->toArray();
        
        $bloco = "extras";
        $this->template->adicionarVista($vista, $bloco);
        $this->template->mostrarBloco($bloco);
    }
    
    function submeter_newsletter(){
        $bd = new Basedados();
        
        $email = $_POST['email'];
        $cod = md5(microtime());
        
        $teste = $bd->obterObjecto("SELECT * FROM nl_subscritores WHERE email='$email'");
        
        if($bd->contar()==0){
            $bd->executar("INSERT INTO nl_subscritores(email, cod) VALUES ('$email', '$cod')");
        }
        
        $pagina = $bd->obterObjecto("SELECT * FROM paginas WHERE aliasweb='submeter_newsletter'");
        
        $subject = "Subscrição Newsletter DoItBetter";
        $message = $pagina->conteudo;
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers        
        $headers .= 'From: DoItBetter <mailer@doitbetter.pt>' . "\r\n" . 'Reply-To: noreply@doitbetter.pt' . "\r\n" ;
        
        mail($email, $subject, $message, $headers);
        
    }
    
    function preinscrever(){
        $bd = new Basedados();
        
        $curso = $_POST['curso'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $morada = $_POST['morada'];
        $localidade = $_POST['localidade'];
        $cod_postal = $_POST['cod_postal'];
        $data_nascimento = $_POST['data_nascimento'];
        $nacionalidade = $_POST['nacionalidade'];
        $habilitacoes = $_POST['habilitacoes'];
        $como_conheceu = $_POST['como_soube'];
        $razoes = $_POST['razoes'];
        if(isset($_POST['autorizo_outras'])){
            $outras=1;
        }else{
            $outras=0;
        }
        $cod = md5(microtime());
        
        $teste = $bd->obterObjecto("SELECT * FROM utilizadores WHERE email='$email'");
        
        if($bd->contar()==0){
            $bd->executar("INSERT INTO utilizadores(curso, nome, morada, localidade, cod_postal, email, telefone, pais, data_nascimento, habilitacoes, como_conheceu, razoes, autorizo_outras, cod) 
                            VALUES ('$curso', '$nome', '$morada', '$localidade', '$cod_postal', '$email', '$telefone', '$nacionalidade', '$data_nascimento', '$habilitacoes', '$como_conheceu', '$razoes', '$outras', '$cod')");
                            
        }
        
        if(isset($_POST['autorizo_nl'])){
            $cod = md5(microtime());
        
            $teste = $bd->obterObjecto("SELECT * FROM nl_subscritores WHERE email='$email'");
            
            if($bd->contar()==0){
                $bd->executar("INSERT INTO nl_subscritores(email, cod) VALUES ('$email', '$cod')");
            }
            
            $pagina = $bd->obterObjecto("SELECT * FROM paginas WHERE aliasweb='submeter_newsletter'");
            
            $subject = "Subscrição Newsletter DoItBetter";
            $message = $pagina->conteudo;
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
            // Additional headers        
            $headers .= 'From: DoItBetter <mailer@doitbetter.pt>' . "\r\n" . 'Reply-To: noreply@doitbetter.pt' . "\r\n" ;
            
            mail($email, $subject, $message, $headers);
            
        }
        
        $pagina = $bd->obterObjecto("SELECT * FROM paginas WHERE aliasweb='preinscrever'");
        
        $subject = "Pré-inscrição efectuada";
        $message = $pagina->conteudo;
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n" ;

        // Additional headers        
        $headers .= 'From: DoItBetter <mailer@doitbetter.pt>' . "\r\n" . 'Reply-To: noreply@doitbetter.pt' . "\r\n" ;
        
        mail($email, $subject, $message, $headers);
        
        $message = "Nova pré-inscrição de ".$nome.". <br /> Ver no <a href='".BO_URL::obterHrefInterno('bo')."'>BO</a>.";
        
        mail($this->Conf['Site']['Email'], $subject, $message, $headers);
        
    }
    
    function enviar_contacto(){
        $bd = new Basedados();
        
        $curso = $_POST['curso'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $morada = $_POST['morada'];
        $distrito = $_POST['distrito'];
        $data_nascimento = $_POST['data_nascimento'];
        $nacionalidade = $_POST['nacionalidade'];
        $habilitacoes = $_POST['habilitacoes'];
        $onde_nos_conheceu = $_POST['onde_nos_conheceu'];
        
        $pagina = $bd->obterObjecto("SELECT * FROM paginas WHERE aliasweb='enviar_contacto'");
        
        $subject = "Contacto de ".$nome." para o curso de ".$curso;
        $message = $pagina->conteudo;
        $message .= "<p>Curso: $curso</p>";
        $message .= "<p>Nome: $nome</p>";
        $message .= "<p>Email: $email</p>";
        $message .= "<p>Telefone: $telefone</p>";
        $message .= "<p>Morada: $morada</p>";
        $message .= "<p>Distrito: $distrito</p>";
        $message .= "<p>Data de Bascimento: $data_nascimento</p>";
        $message .= "<p>Nacionalidade: $nacionalidade</p>";
        $message .= "<p>Habilitações: $habilitacoes</p>";
        $message .= "<p>Onde nos conheceu: $onde_nos_conheceu</p>";
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n" ;

        // Additional headers        
        $headers .= 'From: '.$nome.' <mailer@doitbetter.pt>' . "\r\n" . 'Reply-To: '.$email . "\r\n" ;
        
        mail($this->Conf['Site']['Email'], $subject, $message, $headers);
    }
    
    function enviar_emailcontacto(){
        $bd = new Basedados();
        
        $assunto = $_POST['assunto'];
        $email = $_POST['email'];
        $nome = $_POST['nome'];
        $mensagem = $_POST['mensagem'];
        
        $pagina = $bd->obterObjecto("SELECT * FROM paginas WHERE aliasweb='enviar_emailcontacto'");
        
        $subject = $assunto;
        $message = $mensagem."<br /><hr />";
        $message .= $pagina->conteudo;
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n" ;

        // Additional headers        
        $headers .= 'From: '.$nome.' <mailer@doitbetter.pt>' . "\r\n" . 'Reply-To: '.$email . "\r\n" ;
        
        mail($this->Conf['Site']['Email'], $subject, $message, $headers);
        
    }
    
    function enviar_cv(){
        $bd = new Basedados();
        $mail = new Email();
        
        $email = $_POST['email'];
        $nome = $_POST['nome'];
        $localidade = $_POST['localidade'];
        $habilitacoes = $_POST['habilitacoes'];
        $funcao = $_POST['funcao'];
        $areas = $_POST['areas'];
        $outro_qual = $_POST['outro_qual'];
        
        if ($_FILES["cv"]["error"] > 0)
        {
            echo "Error: " . $_FILES["cv"]["error"] . "<br />";
        }
        else
        {
          echo "Upload: " . $_FILES["cv"]["name"] . "<br />";
          echo "Type: " . $_FILES["cv"]["type"] . "<br />";
          $ext = ".".strtolower(str_replace("application/", "", $_FILES["cv"]["type"]));
          $filename = str_replace(" ", "_", $nome);
          echo $filename;
          echo "Size: " . ($_FILES["cv"]["size"] / 1024) . " Kb<br />";
          echo "Stored in: " . $_FILES["cv"]["tmp_name"];
          move_uploaded_file($_FILES["cv"]["tmp_name"],$this->Conf['Caminho']['SistemaFicheiros'].'/uploads/ficheiros/cv_'.$filename.$ext);
          
          $pagina = $bd->obterObjecto("SELECT * FROM paginas WHERE aliasweb='enviar_cv'");
        
            $subject = "Candidatura DoItBetter";
            $message = $pagina->conteudo;
            
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n" ;
            $headers .= 'From: DoItBetter <mailer@doitbetter.pt>' . "\r\n" . 'Reply-To: rh@dibconsulting.com'. "\r\n" ;
            mail($email, $subject, $message, $headers);
    
            // Additional headers        
            //$headers .= 'From: '.$nome.' <mailer@doitbetter.pt>' . "\r\n" . 'Reply-To: '.$email . "\r\n" ;
            
            $message = "<p>Nome: $nome</p>";
            $message .= "<p>Email: $email</p>";
            $message .= "<p>Localidade: $localidade</p>";            
            $message .= "<p>Habilitações: $habilitacoes</p>";
            $message .= "<p>Função a que se candidata: $funcao</p>";
            if($funcao=='Outro')
                $message .= "<p>Outra, qual?: $funcao_qual</p>";
            if($funcao=='Formador')
                $message .= "<p>Áreas de Formação: $areas</p>";
            
            $pagina = $bd->obterObjecto("SELECT * FROM paginas WHERE aliasweb='enviar_cv_admin'");    
            
            $message .= "<br /><hr />";
            $message .= $pagina->conteudo;
              
          $mail->mail_attachment($nome,$email, "rh@dibconsulting.com", "Nova Candidatura", $message,$this->Conf['Caminho']['SistemaFicheiros'].'/uploads/ficheiros/cv_'.$filename.$ext);
        }        
        
        //mail($this->Conf['Site']['Email'], $subject, $message, $headers);
    }
}
?>
