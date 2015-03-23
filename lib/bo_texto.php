<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe de Texto
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */
class BO_TEXTO{
	
	/**
	 * Cortar o texto pela última palavra antes do comprimento indicado
	 * 
	 * @param $input O texto a cortar
	 * @param $comprimento O comprimento máximo do texto
	 * @param $ellipses Colocar ou não "..." no fim do texto cortado
	 * @param $strip_html Remover tags html
	 * @return O texto cortado
	 */
	function cortar_texto($input, $comprimento, $ellipses = true, $strip_html = true) {
		
		$comprimento = BO_TEXTO::num_caracteres_especiais($input, $comprimento);
		
		//strip tags, if desired
		if ($strip_html) {
			$input = strip_tags($input);
		}
	 
		//no need to trim, already shorter than trim length
		if (strlen($input) <= $comprimento) {
			return $input;
		}
	 
		//find last space within length
		$ultimo_espaco = strrpos(substr($input, 0, $comprimento), ' ');
		$texto_cortado = substr($input, 0, $ultimo_espaco);
	 
		//add ellipses (...)
		if ($ellipses) {
			$texto_cortado .= '...';
		}
	 
		return $texto_cortado;
	}
	
	/**
	 * Obter o comprimento dos caracteres especiais num excerto de texto
	 * 
	 * @param $input O texto a verificar
	 * @param $comprimento O comprimento máximo do texto
	 * @return O comprimento dos caracteres especiais no excerto de texto
	 */
	function num_caracteres_especiais($input, $comprimento){
		if (strlen($input) <= $comprimento) {
			$comprimento = strlen($input);
		}
		
		$comp = $comprimento;
		
		for($i=0; $i<$comprimento; $i++){
			if($input[$i]=='&'){
				$comp +=6;
			}
		}
		
		return $comp;
	}

        /**
         * Codifica o texto, removendo acentos e alterando espaços para _
         *
         * @param $texto = texto a modificar
         * @return O texto modificado
         */
        function codificar($string, $slug = '-') {

            $string = strtolower($string);

            // Código ASCII das vogais
            $ascii['a'] = range(224, 230);
            $ascii['e'] = range(232, 235);
            $ascii['i'] = range(236, 239);
            $ascii['o'] = array_merge(range(242, 246), array(240, 248));
            $ascii['u'] = range(249, 252);

            // Código ASCII dos outros caracteres
            $ascii['b'] = array(223);
            $ascii['c'] = array(231);
            $ascii['d'] = array(208);
            $ascii['n'] = array(241);
            $ascii['y'] = array(253, 255);		

            foreach ($ascii as $key=>$item) {
                    $acentos = '';
                    foreach ($item AS $codigo) $acentos .= chr($codigo);
                    $troca[$key] = '/['.$acentos.']/i';
            }

            $string = preg_replace(array_values($troca), array_keys($troca), $string);

            // Slug?
            if ($slug) {
                    // Troca tudo que não for letra ou número por um caractere ($slug)
                    $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
                    // Tira os caracteres ($slug) repetidos
                    $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
                    $string = trim($string, $slug);
            }

            return $string;
    }
	
}