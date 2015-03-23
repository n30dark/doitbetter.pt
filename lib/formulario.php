<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe para criação automática de formulários
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */
class Formulario{
	
	var $validacao = Array();
	var $validacao_rules = Array();
	var $validacao_messages = Array();
	var $validator;
	var $form;
	var $submit;
	var $campos = Array();
	
	/**
	 * 
	 * Construir um novo formulário
	 * 
	 * @param $form Nome do formulário
	 * @param $submit Url de submit
	 * @return unknown_type
	 */
	function __construct($form, $submit){
		$this->form = $form;
		$this->submit = $submit;
		$this->loadValidator();
	}
	
	/**
	 * Carregar o Validator
	 * 
	 */
	function loadValidator(){
		$this->validator = new Config();
		$this->validator->ficheiroConfig = "validations.ini";
		$this->validator = $this->validator->load();
	}
	
	/**
	 * Definir uma nova validação a partir do ficheiro de validacao
	 * 
	 * @param $validacao A validacao a definir
	 */
	function defineValidacao($validacao){
		array_push($this->validacao, $validacao);
		array_push($this->validacao_rules, $this->validator[$validacao]['rules']);
		array_push($this->validacao_messages, $this->validator[$validacao]['message']); 
	}
	
	/**
	 * Definir a url de submit
	 * 
	 * @param $submit
	 * @return unknown_type
	 */
	function defineSubmit($submit){
		$this->submit = $submit;
	}
	
	/**
	 * Criar o jQuery validator com as validações previamente inseridas
	 * 
	 * @return jQuery validator completo
	 */
	function jQueryValidator(){
		
		$ret = "$('#$this->form').validate({".
			   "rules:{";
		foreach($this->validacao as $v)
			$vals = "$v: {".$this->validator[$v]['rules']."},";
		$ret .= substr_replace($vals, "", -1);
		$ret .= "},messages:{";
		foreach($this->validacao as $v)
			$vals = "$v: {".$this->validator[$v]['message']."},";
		$ret .= substr_replace($vals, "", -1);
		$ret .="},submitHandler: $this->submit});";
		
		return $ret;
	}
	
	/**
	 * Criar um novo campo no formulário
	 * 
	 * @param $nome O nome do campo
	 * @param $label A label do campo
	 * @param $classe A classe do campo
	 * @param $valor O valor do campo
	 * @param $tabela Os dados da tabela correspondente ao campo (para dropdowns)
	 */
	function novoCampo($nome, $label, $classe="", $valor="", $tabela=Array()){
			
		$ret = "";

		switch($classe){
			case 'texto':
				$ret = "";
				$ret .= "<textarea class='frmcampos texto ui-widget-content ui-corner-all' name='$nome' id='$nome'>$valor</textarea>";
				$ret .= "<script>CKEDITOR.replace('$nome', 
				{
                    filebrowserBrowseUrl :'".BO_URL::obterHrefInterno('')."js/ckeditor/filemanager/browser/default/browser.html?Connector=".BO_URL::obterHrefInterno('')."js/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl : '".BO_URL::obterHrefInterno('')."js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=".BO_URL::obterHrefInterno('')."js/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl :'".BO_URL::obterHrefInterno('')."js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=".BO_URL::obterHrefInterno('')."js/ckeditor/filemanager/connectors/php/connector.php',
					filebrowserUploadUrl  :'".BO_URL::obterHrefInterno('')."js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
					filebrowserImageUploadUrl : '".BO_URL::obterHrefInterno('')."js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
					filebrowserFlashUploadUrl : '".BO_URL::obterHrefInterno('')."js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
				});</script>"; 
				break;
                            case 'simpletext':
				$ret = "<label class='form_label' for='$nome'>".ucwords(str_replace("_", " ",$label))."</label>";
				$ret .= "<textarea class='frmcampos simpletext ui-widget-content' name='$nome' id='$nome'>$valor</textarea>";
				break;
			case 'newsletter':
				$ret = "<label class='form_label' for='$nome'>".ucwords(str_replace("_", " ",$label))."</label>";
				$ret .= "<textarea class='frmcampos newsletter ui-widget-content' name='$nome' id='$nome'>$valor</textarea>";
				break;
			case 'dropdown_req':
				$ret = "<label class='form_label' for='$nome'>".ucwords(str_replace("_", " ",$label))."</label>";
				$ret .= "<select class='frmcampos dropdown ui-widget-content' name='$nome' id='$nome'>";
				if(!isset($tabela->default))
					$ret .= "<option value='' onclick='add($tabela->nome, $tabela->label)'>Novo ".str_replace("_", " ",$tabela->label)."...</option>";
				else
					$ret .= "<option value=''>Seleccionar ".str_replace("_", " ",$tabela->label)."...</option>";
				foreach($tabela->dados as $t):
					if($value==$t->cod)
						$selected = 'selected';
					else
						$selected = '';
					$ret .= "<option value='$t->cod' $selected >$t->nome</option>";
				endforeach;
				$ret .= "</select>";
				break;
			case 'dropdown':
				$ret = "<label class='form_label' for='$nome'>".ucwords(str_replace("_", " ",$label))."</label>";
				$ret .= "<select class='frmcampos dropdown ui-widget-content' name='$nome' id='$nome'>";
				if(!isset($tabela->default))
					$ret .= "<option value='' onclick='add($tabela->nome)'>Novo ".str_replace("_", " ",$tabela->label)."...</option>";
				else
					$ret .= "<option value=''>Seleccionar ".str_replace("_", " ",$tabela->label)."...</option>";
				foreach($tabela->dados as $t):
					if($valor==$t->cod)
						$selected = 'selected';
					else
						$selected = '';
					$ret .= "<option value='$t->cod' $selected >$t->nome</option>";
				endforeach;
				$ret .= "</select>";
				break;
			case 'data':
				$ret = "<label class='form_label' for='$nome'>".ucwords(str_replace("_", " ",$label))."</label>";
				($valor!='')?$valor = $valor: $valor = date('Y-m-d');
				$ret .= "<input type='text' class='frmcampos data ui-widget-content' name='$nome' id='$nome' value='$valor' />";
				break;
			case 'bopassword':
				$ret = $this->setPassword(); 
				break;
			case 'password':
				$ret = $this->setPassword(); 
				break;
			case 'morada':
				$ret = "<label class='form_label' for='$nome'>".ucwords(str_replace("_", " ",$label))."</label>";
				$ret .= "<textarea class='frmcampos morada ui-widget-content' name='$nome' id='$nome'>$valor</textarea>"; 
				break;
				break;
			case 'checkbox':
				$ret = "<label class='form_label' for='$nome'>".ucwords(str_replace("_", " ",$label))."</label>";
				($valor==1)?$checked='checked':$checked='';
				$ret .= "<input type='checkbox' class='frmcampos checkbox ui-widget-content' name='$nome' id='$nome' value='$valor' $checked />"; 
				break;
			case 'upload':
			case 'image_upload':
				$ret = "<label class='form_label' for='$nome'>".ucwords(str_replace("_", " ",$label))."</label>";
				$ret .= "<div style='float:left;'><div id='fileQueue'></div>";
				$ret .= "<input type='file' class='frmcampos upload ui-widget-content' name='$nome' id='$nome' />";				
				$ret .= "<p><a href='javascript:jQuery(\"#uploadify\").uploadifyClearQueue()'>Cancelar todos os uploads</a></p></div>";
				break;
            case 'multiselect':
                                $ret = "<label class='form_label' for='$nome'>".ucwords(str_replace("_", " ",$label))."</label>";
                                $ret .= "<select id='$nome' class='multiselect' multiple='multiple' name='".$nome."[]'>";
                                $valor = explode(",", $valor);
                                foreach($tabela->dados as $t):
                                        if(in_array($t->cod, $valor))
						$selected = 'selected';
					else
						$selected = '';
					$ret .= "<option value='$t->cod' $selected >$t->nome</option>";
				endforeach;
                                $ret .= "</select>";
                                $ret .= "<script>$(function(){ $('.multiselect').multiselect(); });</script>";
                                break;
			default:
				$ret = "<label class='form_label' for='$nome'>".ucwords(str_replace("_", " ",$label))."</label>";
				$ret .= "<input type='text' class='frmcampos dados ui-widget-content' name='$nome' id='$nome' value='$valor' />"; 
				break;
		}
		
		$this->campos[$nome] = "<div class='frmfield'>".$ret."</div><br />";
		
		$this->defineValidacao($classe);
	}
	
	/**
	 * Definir um campo de password
	 * 
	 * @return O novo campo de password
	 */
	function setPassword(){
		
		$ret = "";
		switch($this->form){
			case 'frmnew':
				$ret = "<label class='form_label' for='password'>Password</label>";
				$ret .= "<input type='password' class='frmcampos password pcheck ui-widget-content' name='password' id='password' /></div><br />";
				$ret .= "<div class='frmfield'><label class='form_label' for='password_confirm'>Confirmar Password</label>";
				$ret .= "<input type='password' class='frmcampos password ui-widget-content' name='password_confirm' id='password_confirm' />";
				$this->defineValidacao('password_confirm');
				break;
			case 'frmedit':
				$ret = "<label class='form_label' for='password_check'>Password Antiga</label>";
				$ret .= "<input type='password' class='frmcampos password ui-widget-content' name='password_check' id='password_check' /></div><br />";
				$ret .= "<div class='frmfield'><label class='form_label' for='password_new'>Nova Password</label>";
				$ret .= "<input type='password' class='frmcampos password pcheck ui-widget-content' name='password_new' id='password_new' /></div><br />";
				$ret .= "<div class='frmfield'><label class='form_label' for='password_confirm'>Confirmar Password</label>";
				$ret .= "<input type='password' class='frmcampos password ui-widget-content' name='password_confirm' id='password_confirm' />";
				$this->defineValidacao('password_new');
				$this->defineValidacao('password_confirm');
				break;
		}
			return $ret;
	}
}