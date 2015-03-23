<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe para leitura e escrita de ficheiros XML
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class BO_XML{
	
	var $ficheiro;
	var $dados;
	var $doc;
	var $result;
	
	/**
	 * Criação de um novo objecto XML
	 * 
	 * @param $ficheiro O nome do ficheiro XML
	 */
	function bo_xml($ficheiro){
		$this->ficheiro = $ficheiro;
		/*$this->doc = new DOMDocument();
		$this->doc->load($ficheiro);	*/
	}
	
	/**
	 * Alterar o ficheiro XML a utilizar
	 * 
	 * @param $ficheiro
	 * @return unknown_type
	 */
	function mudarFicheiro($ficheiro){
		$this->ficheiro = $ficheiro;
		$this->doc->load($ficheiro);
	}
	
	//inicio de funcoes de leitura
	/**
	 * Obter a tag superior
	 * 
	 * @param $tag A tag a obter
	 * @return Os elementos da tag indicada
	 */
	function obterTagSuperior($tag){
		return $this->doc->getElementsByTagName($tag);
	}
	
	/**
	 * 
	 * Obter a tag filho
	 * 
	 * @param $tag A tag a obter
	 * @param $pai A tag pai
	 * @return Os elementos da tag indicada
	 */
	function obterTagFilho($tag, $pai){
		return $pai->getElementsByTagName($tag);
	}
	
	/**
	 * Converter um documento xml para Array
	 * 
	 * @param $xml O xml a converter
	 * @return O Array convertido
	 */
	function xml2array($xml) {
				
        $xmlary = array();
               
        $reels = '/<(\w+)\s*([^\/>]*)\s*(?:\/>|>(.*)<\/\s*\\1\s*>)/s';
        $reattrs = '/(\w+)=(?:"|\')([^"\']*)(:?"|\')/';

        preg_match_all($reels, $xml, $elements);

        foreach ($elements[1] as $ie => $xx) {
                $xmlary[$ie]["name"] = $elements[1][$ie];
               
                if ($attributes = trim($elements[2][$ie])) {
                        preg_match_all($reattrs, $attributes, $att);
                        foreach ($att[1] as $ia => $xx)
                                $xmlary[$ie]["attributes"][$att[1][$ia]] = $att[2][$ia];
                }

                $cdend = strpos($elements[3][$ie], "<");
                if ($cdend > 0) {
                        $xmlary[$ie]["text"] = substr($elements[3][$ie], 0, $cdend - 1);
                }

                if (preg_match($reels, $elements[3][$ie]))
                        $xmlary[$ie]["elements"] = BO_XML::xml2array($elements[3][$ie]);
                else if ($elements[3][$ie]) {
                        $xmlary[$ie]["text"] = $elements[3][$ie];
                }
        }

        return $xmlary;

}


        function XMLToArray($fonte, $arr){
            $xmlUrl = $fonte; // XML feed file/URL
            $xmlStr = file_get_contents($xmlUrl);
            $xmlObj = simplexml_load_string($xmlStr);
            $arrXml = $this->objectsIntoArray($xmlObj);
            return $arrXml;
        }

        function objectsIntoArray($arrObjData, $arrSkipIndices = array()) {
            $arrData = array();

            // if input is object, convert into array
            if (is_object($arrObjData)) {
                $arrObjData = get_object_vars($arrObjData);
            }

            if (is_array($arrObjData)) {
                foreach ($arrObjData as $index => $value) {
                    if (is_object($value) || is_array($value)) {
                        $value = $this->objectsIntoArray($value, $arrSkipIndices); // recursive call
                    }
                    if (in_array($index, $arrSkipIndices)) {
                        continue;
                    }
                    $arrData[$index] = $value;
                }
            }
            return $arrData;
        }
	
	function _process($no){
		$resultado = array();

		foreach($no->childNodes as $filho){
                        if(!isset($resultado[$filho->nodeName])){
                            $resultado[$filho->nodeName] = 0;
                        }
			$resultado[$filho->nodeName]++;
		}
		
		if($no->nodeType == XML_TEXT_NODE){
			$res = html_entity_decode(htmlentities($no->nodeValue, ENT_COMPAT, 'UTF-8'),
					ENT_COMPAT, 'ISO-8859-15');
		}else{
			if($no->hasChildNodes()){
				$filhos = $no->childNodes;
				
				for($i=0; $i<$filhos->length; $i++){
					$filho = $filhos->item($i);
					
					if($filho->nodeName != "#text"){
						if($resultado[$filho->nodeName]>1){
							$res[$filho->nodeName][] = $this->_process($filho);
						}else{
							$res[$filho->nodeName] = $this->_process($filho);
						}
					}else if($filho->nodeName == "#text"){
						$texto = $this->_process($filho);
						
						if(trim($texto) != ''){
							$res[$filho->nodeName] = $this->_process($filho);
						}
					}
				}
			}
			
			if($no->hasAttributes()){
				$atributos = $node->attributes;
				
				if(!is_null($atributos)){
					foreach($atributos as $chave => $atr){
						$res["@".$atr->name] = $atr->value;		
					}
				}
			}
		}
		
		return $res;
	}
	
	function getResult(){
		return $this->_process($this->doc);
	}
	
	//fim de funcoes de leitura
	
	//inicio funcoes de escrita
	
	/**
	 * Converter um array para XML
	 * 
	 * @param $dados O array de dados
	 * @param $nomeRaiz O nó raiz
	 * @param $xml O documento xml para o qual será feita a conversão
	 */
	function arrayToXML($dados, $nomeRaiz, $xml=""){
		
		if(ini_get('zend.ze1_compatibility_mode')==1){
			ini_set('zend.ze1_compatibility_mode', 0);
		}
		
		if($xml==null){
			$xml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$nomeRaiz />");
		}
		
		foreach($dados as $chave => $valor){
			if(is_numeric($chave)){
				$chave = "unknownNode_". (string) $chave;
			}

			$chave = preg_replace('/[^a-z]/i', '', $chave);
			
			if(is_array($valor)){
				$no = $xml->addChild($chave);
				$this->arrayToXml($valor, $nomeRaiz, $no);
			}else{
				$valor = htmlentities($valor);
				$xml->addChild($chave, $valor);
			}
		}
		
		$this->doc->loadXML($xml);
		$this->doc->save($this->ficheiro);
		
	}		
	
	function convertxml2array($contents, $get_attributes=1, $priority = 'tag') {
		if(!$contents) return array();

		if(!function_exists('xml_parser_create')) {
			//print "'xml_parser_create()' function not found!";
			return array();
		}

		//Get the XML parser of PHP - PHP must have this module for the parser to work
		$parser = xml_parser_create('');
		xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); # http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parse_into_struct($parser, trim($contents), $xml_values);
		xml_parser_free($parser);

		if(!$xml_values) return;//Hmm...

		//Initializations
		$xml_array = array();
		$parents = array();
		$opened_tags = array();
		$arr = array();

		$current = &$xml_array; //Refference

		//Go through the tags.
		$repeated_tag_index = array();//Multiple tags with same name will be turned into an array
		foreach($xml_values as $data) {
			unset($attributes,$value);//Remove existing values, or there will be trouble

			//This command will extract these variables into the foreach scope
			// tag(string), type(string), level(int), attributes(array).
			extract($data);//We could use the array by itself, but this cooler.

			$result = array();
			$attributes_data = array();
			
			if(isset($value)) {
				if($priority == 'tag') $result = $value;
				else $result['value'] = $value; //Put the value in a assoc array if we are in the 'Attribute' mode
			}

			//Set the attributes too.
			if(isset($attributes) and $get_attributes) {
				foreach($attributes as $attr => $val) {
					if($priority == 'tag') $attributes_data[$attr] = $val;
					else $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
				}
			}

			//See tag status and do the needed.
			if($type == "open") {//The starting of the tag '<tag>'
				$parent[$level-1] = &$current;
				if(!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag
					$current[$tag] = $result;
					if($attributes_data) $current[$tag. '_attr'] = $attributes_data;
					$repeated_tag_index[$tag.'_'.$level] = 1;

					$current = &$current[$tag];

				} else { //There was another element with the same tag name

					if(isset($current[$tag][0])) {//If there is a 0th element it is already an array
						$current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
						$repeated_tag_index[$tag.'_'.$level]++;
					} else {//This section will make the value an array if multiple tags with the same name appear together
						$current[$tag] = array($current[$tag],$result);//This will combine the existing item and the new item together to make an array
						$repeated_tag_index[$tag.'_'.$level] = 2;
						
						if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
							$current[$tag]['0_attr'] = $current[$tag.'_attr'];
							unset($current[$tag.'_attr']);
						}

					}
					$last_item_index = $repeated_tag_index[$tag.'_'.$level]-1;
					$current = &$current[$tag][$last_item_index];
				}

			} elseif($type == "complete") { //Tags that ends in 1 line '<tag />'
				//See if the key is already taken.
				if(!isset($current[$tag])) { //New Key
					$current[$tag] = $result;
					$repeated_tag_index[$tag.'_'.$level] = 1;
					if($priority == 'tag' and $attributes_data) $current[$tag. '_attr'] = $attributes_data;

				} else { //If taken, put all things inside a list(array)
					if(isset($current[$tag][0]) and is_array($current[$tag])) {//If it is already an array...

						// ...push the new element into that array.
						$current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
						
						if($priority == 'tag' and $get_attributes and $attributes_data) {
							$current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
						}
						$repeated_tag_index[$tag.'_'.$level]++;

					} else { //If it is not an array...
						$current[$tag] = array($current[$tag],$result); //...Make it an array using using the existing value and the new value
						$repeated_tag_index[$tag.'_'.$level] = 1;
						if($priority == 'tag' and $get_attributes) {
							if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
								
								$current[$tag]['0_attr'] = $current[$tag.'_attr'];
								unset($current[$tag.'_attr']);
							}
							
							if($attributes_data) {
								$current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
							}
						}
						$repeated_tag_index[$tag.'_'.$level]++; //0 and 1 index is already taken
					}
				}

			} elseif($type == 'close') { //End of tag '</tag>'
				$current = &$parent[$level-1];
			}
		}
		
		return($xml_array);
	}  
	
}