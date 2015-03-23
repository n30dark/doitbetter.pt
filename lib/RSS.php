<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 *
 * Classe para criação de feed RSS
 *
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class RSS{

    var $rss,
        $codificacao;

    var $titulo,
        $link,
        $descricao,
        $lingua,
        $copyright,
        $editor,
        $webmaster,
        $data_publicacao,
        $data_ultima_criacao,
        $categoria,
        $gerador,
        $docs,
        $nuvem,
        $ttl,
        $imagem,
        $input_texto;

    var $skipHours = array();
    var $skipDays = array();

    var $titulo_item,
        $link_item,
        $descricao_item,
        $autor_item,
        $categoria_item,
        $comentarios_item,
        $encapsulamento_item,
        $guid_item,
        $data_publicacao_item,
        $fonte_item;

    var $caminho,
        $ficheiro;

    function  __construct($codificacao = '') {
        $this->gerador = "Classe geradora RSS 2.0";
        $this->docs = "http://blogs.law.harvard.edu/tech/rss";
        if(isset($codificacao)){
            $this->codificacao = $codificacao;
        }
    }

    function definir_canal($titulo, $link, $descricao){
        $this->titulo = $titulo;
        $this->link = $link;
        $this->descricao = $descricao;
    }

    function definir_lingua($lingua){
        $this->lingua = $lingua;
    }

    function copyright($copyright){
        $this->copyright = $copyright;
    }

    function definir_editor($editor){
        $this->editor = $editor;
    }

    function definir_webmaster($webmaster){
        $this->webmaster = $webmaster;
    }

    function definir_data_publicacao($data_publicacao){
        $this->data_publicacao = $data_publicacao;
    }

    function definir_data_ultima_criacao($data_ultima_criacao){
        $this->data_ultima_criacao = $data_ultima_criacao;
    }

    function definir_categoria($categoria, $dominio=''){
        $this->categoria .= $this->s(2) . '<category';
        if(isset($dominio)){
            $this->categoria .= ' domain="' . $dominio . '"';
        }
        $this->categoria .= '>' . $categoria . '</category>' . '\n';
    }

    function definir_nuvem($dominio, $porta, $caminho, $registarProcedimento, $protocolo){
        $this->nuvem .= $this->s(2) .
                        '<cloud domain="' . $dominio .
                        '" port="' . $porto .
                        '" registerProcedure="' . $registarProcedimento .
                        '" protocol="' . $protocolo . '" />';
    }

    function definir_ttl($ttl){
        $this->ttl = $ttl;
    }

    function definir_imagem($url, $titulo, $link, $largura='', $altura='', $descricao=''){
        $this->imagem = $this->s(2). '<image>' . '\n';
        $this->imagem .= $this->s(3) . '<url>' . $url . '</url>' . '\n';
        $this->imagem .= $this->s(3) . '<title>' . $titulo . '</title>' . '\n';
        $this->imagem .= $this->s(3) . '<link>' . $link .'</link>' . '\n';
        if($largura!=''){
            $this->imagem .= $this->s(3) . '<width>' . $largura . '</width>' . '\n';
        }
        if($altura!=''){
            $this->imagem .= $this->s(3) . '<height>' . $aljtura . '</height>' . '\n';
        }
        if($descricao!=''){
            $this->imagem .= $this->s(3) . '<description>' . $descricao . '</description>' . '\n';
        }
        $this->imagem .= $this->s(2) . '</image>'.'\n';
    }

    function definir_input_texto($titulo, $descricao, $nome, $link){
        $this->input_texto = $this->s(2). '<textInput>' . '\n';
        $this->input_texto .= $this->s(3) . '<title>' . $titulo .'</title>' . '\n';
        $this->input_texto .= $this->s(3) . '<description>' . $descricao . '</description>' . '\n';
        $this->input_texto .= $this->s(3) . '<name>' . $nome . '</name>' . "\n";
        $this->input_texto .= $this->s(3) . '<link>' . $link . '</link>' . "\n";
        $this->input_texto .= $this->s(2) . '</textInput>' . "\n";
    }

    function definir_skip_hours(){
        $this->skipHours = array();
        $args = func_get_args();
        $this->skipHours = array_values($args);
    }

    function skipDays(){
        $this->skipDays = array();
        $args = func_get_args();
        $this->skipDays = array_values($args);
    }

    function iniciarRSS($caminho = '.', $ficheiro = 'rss'){
        $this->caminho = $caminho;
        $this->ficheiro = $ficheiro;
        $this->rss = '<?xml version="1.0"';
        if(!empty($this->codificacao)){
            $this->rss .= ' encoding="' . $this->codificacao .'"';
        }
        $this->rss .= '?>'. '\n';
        $this->rss .= '<rss version="2.0">' . '\n';
        $this->rss .= $this->s(1) . '<channel>' . '\n';
        $this->rss .= $this->s(2) . '<title>' . $this->titulo . '</title>' . '\n';
        $this->rss .= $this->s(2) . '<link>' . $this->link . '</link>' . '\n';
        $this->rss .= $this->s(2) . '<description>' . $this->descricao . '</description>' . '\n';
        if(!empty($this->lingua)){
            $this->rss .= $this->s(2) . '<language>' . $this->lingua .'</language>' . '\n';
        }
        if(!empty($this->copyright)){
            $this->rss .= $this->s(2) . '<copyright>' . $this->copyright . '</copyright>' . '\n';
        }
        if(!empty($this->editor)){
            $this->rss .= $this->s(2) . '<managingEditor>' . $this->editor .'</managingEditor>' . '\n';
        }
        if(!empty($this->webmaster)){
            $this->rss .= $this->s(2) . '<webMaster>' . $this->webmaster .'</webMaster>' . '\n';
        }
        if(!empty($this->data_publicacao)){
            $this->rss .= $this->s(2) . '<pubDate>' . $this->data_publicacao .'</pubDate>' . '\n';
        }
        if(!empty($this->data_ultima_criacao)){
            $this->rss .= $this->s(2) . '<lastBuildDate>' . $this->data_ultima_criacao .'</lastBuildDate>' . '\n';
        }
        if(!empty($this->categoria)){
            $this->rss .= $this->categoria;
        }
        $this->rss .= $this->s(2) . '<generator>' . $this->gerador . '</generator>' . '\n';
        $this->rss .= $this->s(2) . '<docs>' . $this->docs . '</docs>' . '\n';
        if(!empty($this->nuvem)){
            $this->rss .= $this->nuvem;
        }
        if(!empty($this->ttl)){
            $this->rss .= $this->s(2) . '<ttl>' . $this->ttl .'</ttl>' . '\n';
        }
        if(!empty($this->imagem)){
            $this->rss .= $this->imagem;
        }
        if(!empty($this->input_texto)){
            $this->rss .= $this->input_texto;
        }
        if(count($this->skipHours)>0){
            $this->rss .= $this->s(2) . '<skipHours>' . '\n';
            foreach($this->skipHours as $sh){
                $this->rss .= $this->s(3) . '<hour>' . $sh . '</hour>' . '\n';
            }
            $this->rss .= $this->s(2) . '</skipHours>' . '\n';
        }
        if(count($this->skipDays)>0){
            $this->rss .= $this->s(2) . '<skipDays>' . '\n';
            foreach($this->skipDays as $sd){
                $this->rss .= $this->s(3) . '<day>' . $sd . '</day>' . '\n';
            }
            $this->rss .= $this->s(2) . '</skipDays>' . '\n';
        }
    }

    function definir_titulo_item($titulo){
        $this->titulo_item = $titulo;
    }

    function definir_link_item($link){
        $this->link_item = $link;
    }

    function definir_descricao_item($descricao){
        $this->descricao_item = $descricao;
    }

    function definir_autor_item($autor){
        $this->autor_item = $autor;
    }

    function definir_categoria_item($categoria, $dominio=''){
        $this->categoria_item .= $this->s(3) . '<category';
        if(!empty($dominio)){
            $this->categoria_item .= ' domain="'.$dominio.'"';
        }
        $this->categoria_item .= '>' . $categoria . '</category>' . '\n';
    }

    function definir_comentarios_item($comentarios){
        $this->comentarios_item = $comentarios;
    }

    function definir_encapsulamento_item($encapsulamento){
        $this->encapsulamento_item = $encapsulamento;
    }

    function definir_guid_item($guid, $isPermaLink =''){
        $this->guid_item = $this->s(3) . '</guid';
        if(!empty($isPermaLink)){
            $this->guid_item .= ' isPermaLink="' . $isPermaLink .'"';
        }
        $this->guid_item .= '>'. $guid . '</guid>' . '\n';
    }

    function definir_data_publicacao_item($data_publicacao){
        $this->data_publicacao_item = $data_publicacao;
    }

    function definir_fonte_item($fonte, $url){
        $this->fonte_item = $this->s(3) . '<source url="'. $url .'">' . $fonte .'</source>' . '\n';
    }

    function addItem(){
        $this->rss .= $this->s(2) . '<item>' . '\n';
        if(!empty($this->titulo_item)){
            $this->rss .= $this->s(3) . '<title>' . $this->titulo_item . '</title>' . '\n';
        }
        if(!empty($this->link_item)){
            $this->rss .= $this->s(3) . '<link>' . $this->link_item . '</link>' . '\n';
        }
        if(!empty($this->descricao_item)){
            $this->rss .= $this->s(3) . '<description>' . $this->descricao_item . '</description>' . '\n';
        }
        if(!empty($this->autor_item)){
            $this->rss .= $this->s(3) . '<author>' . $this->autor_item . '</author>' . '\n';
        }
        if(!empty($this->categoria_item)){
            $this->rss .= $this->categoria_item;
        }
        if(!empty($this->comentarios_item)){
            $this->rss .= $this->s(3) . '<comments>' . $this->comentarios_item . '</comments>' . '\n';
        }
        if(!empty($this->encapsulamento_item)){
            $this->rss .= $this->s(3) . '<enclosure>' . $this->encapsulamento_item . '</enclosure>' . '\n';
        }
        if(!empty($this->guid_item)){
            $this->rss .= $this->guid_item;
        }
        if(!empty($this->data_publicacao_item)){
            $this->rss .= $this->s(3) . '<pubDate>' . $this->data_publicacao_item . '</pubDate>' . '\n';
        }
        if(!empty($this->fonte_item)){
            $this->rss .= $this->fonte_item;
        }
        $this->rss .= $this->s(2) . '</item>' . '\n';

        $this->titulo_item = '';
        $this->link_item = '';
        $this->descricao_item = '';
        $this->autor_item = '';
        $this->categoria_item= '';
        $this->comentarios_item = '';
        $this->encapsulamento_item = '';
        $this->guid_item = '';
        $this->data_publicacao_item = '';
        $this->fonte_item = '';
    }

    function RSS_terminado(){
        $this->rss .= $this->s(1) . '</channel>' . '\n';
        $this->rss .= '</rss>';

        $execucao = fopen($this->caminho . '/' . $this->ficheiro . '.xml', 'w');
        fwrite($execucao, $this->rss);
        fclose($execucao);
    }

    function limpar_RSS(){
        $this->titulo = '';
        $this->link = '';
        $this->descricao = '';
        $this->lingua = '';
        $this->copyright = '';
        $this->editor = '';
        $this->webmaster = '';
        $this->data_publicacao = '';
        $this->data_ultima_criacao = '';
        $this->categoria = '';
        $this->nuvem = '';
        $this->ttl = '';
        $this->skipHours = array();
        $this->skipDays = array();
    }

    function s($espaco){
        $s = '';
        for($i=0;$i<$espaco;$i++){
            $s .='  ';
        }
        return $s;
    }
}
?>
