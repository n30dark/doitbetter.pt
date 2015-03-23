<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe de Font
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */
class Font{
	
	var $font = '';
	var $angulo = '';	
	var $cores = array();
	var $fundo = '';
	
	/**
	 * Construtor da classe Font
	 * 
	 * @param $font O ficheiro ttf a utilizar
	 */
	function __construct($font){
		$this->font = "fonts/$font";
		$branco = array('branco', 248, 248, 255);
		$cinzento = array('cinzento', 128, 128, 128);
		$preto = array('preto', 0, 0, 0);
		$this->cores['branco'] = $branco;
		$this->cores['cinzento'] = $cinzento;
		$this->cores['preto'] = $preto;
		$this->angulo = 0;
		$this->fundo = $branco;
		
	}
	
	/**
	 * Definir a côr à qual atribuir transparência
	 * 
	 * @param $r Variável numérica RED
	 * @param $g Variável numérica GREEN
	 * @param $b Variável numérica BLUE
	 */
	function define_transparencia($r, $g, $b){
		$this->cores["transparente"] = array("transparente", $r, $g, $b);
	}
	
	/**
	 * Adicionar uma nova côr à paleta
	 * 
	 * @param $nome Nome da nova côr
	 * @param $r Variável numérica RED
	 * @param $g Variável numérica GREEN
	 * @param $b Variável numérica BLUE
	 */
	function adicionar_cor($nome, $r, $g, $b){
		$this->cores[$nome] = array($nome, $r, $g, $b);
	}
	
	/**
	 * Escrever um novo excerto de texto
	 * 
	 * @param $texto O texto a escrever
	 * @param $tamanho O tamanho de letra a utilizar
	 * @param $cor_letra A côr da letra a utilizar (das cores existentes na paleta)
	 * @param $angulo O ângulo a atribuir à letra (0 por definição)
	 * @param $fundo A côr de fundo a atribuir à letra (branco por definição; para transparência, introduzir "transparente")
	 * @param $sombra Variável booleana para introdução de sombra
	 * @param $hover Côr do efeito de hover caso pretenda ou false caso não exista efeito hover
	 */
	function escrever($texto, $tamanho, $cor_letra, $angulo=0, $fundo='branco', $sombra=false, $hover=false){
		$comp = ceil(strlen($texto)*($tamanho*1.5));
		$alt = ceil($tamanho*2.0);

		//header('Content-type: image/png');
		$im = imagecreatetruecolor($comp, $alt);
		
		$rgb = array();
		foreach($this->cores as $cor){
			$rgb[$cor[0]] = imagecolorallocate($im, $cor[1], $cor[2], $cor[3]);
		}
				
		imagefilledrectangle($im, 0, 0, $comp-1, $alt-1, $rgb[$fundo]);
		
		$bg = $rgb[$fundo];
		
		if($sombra)
			imagettftext($im, $tamanho, $angulo, 3, $tamanho+($tamanho/2)+1, $rgb['cinzento'], $this->font, $texto);
		
		imagettftext($im, $tamanho, $angulo, 2, $tamanho+($tamanho/2), $rgb[$cor_letra], $this->font, $texto);
		//imagecolortransparent($im, $rgb["transparente"]);
		
		$imw = imagesx($im);
		$imh = imagesy($im);
		$xmin = $imw;
		$xmax = 0;
		for ($iy=0; $iy<$imh; $iy++){
	        $first = true;
	        for ($ix=0; $ix<$imw; $ix++){
	            $ndx = imagecolorat($im, $ix, $iy);
	            if ($ndx != $bg){
	                if ($xmin > $ix){ $xmin = $ix; }
	                if ($xmax < $ix){ $xmax = $ix; }
	                if (!isset($ymin)){ $ymin = $iy; }
	                $ymax = $iy;
	                if ($first){ $ix = $xmax; $first = false; }
	            }
	        }
		}
		$imw = 1+$xmax-$xmin; // Image width in pixels
	    $imh = 5+$ymax-$ymin; // Image height in pixels            
	
	    // Make another image to place the trimmed version in.
	    if(preg_match("#[gjpqy]#", $texto))
	    	$im2 = imagecreatetruecolor($imw+5+5, $imh+3);
	    else
	    	$im2 = imagecreatetruecolor($imw+5+5, $imh+3+3);
	
	    // Make the background of the new image the same as the background of the old one.
	    //$bg2 = imagecolorallocate($im2, $bg[0], $bg[1], $bg[2]);
	    if(preg_match("#[gjpqy]#", $texto))
	    	imagefilledrectangle($im2, 0, 0, $imw+5+5, $imh+3, $rgb[$fundo]);
	    else
	    	imagefilledrectangle($im2, 0, 0, $imw+5+5, $imh+3+3, $rgb[$fundo]);
	
	    // Copy it over to the new image.
	    	imagecopy($im2, $im, 5, 5, $xmin, $ymin, $imw, $imh);
	
	    // To finish up, we replace the old image which is referenced.
	    $im = $im2;

            if(isset($rgb["transparente"]))
                imagecolortransparent($im, $rgb["transparente"]);
		
	    $texto_original = $texto;
	    
	    $texto = preg_replace("#[�?ÀÂÃ]#i","A",$texto);
	    $texto = preg_replace("#[áàâãª]#i","a",$texto);
	    $texto = preg_replace("#[ÉÈÊ]#i","E",$texto);
	    $texto = preg_replace("#[éèê]#i","e",$texto);
	    $texto = preg_replace("#[ÓÒÔÕ]#i","O",$texto);
	    $texto = preg_replace("#[óòôõº]#i","o",$texto);
	    $texto = preg_replace("#[ÚÙÛ]#i","u",$texto);
	    $texto = preg_replace("#[úùû]#i","u",$texto);
	    $texto = str_replace("#[Ç]#","c",$texto);
	    $texto = str_replace("#[ç]#","c",$texto);
	    $texto = strtolower($texto);
	    
	    $filename = str_replace(" ","_",$texto);
		imagepng($im, "fonts/images/$filename.png");
		
		if($hover){
			$im_hov = imagecreatetruecolor($comp, $alt);
					
			imagefilledrectangle($im_hov, 0, 0, $comp-1, $alt-1, $rgb[$fundo]);
			
			$bg_hov = $rgb[$fundo];
			
			if($sombra)
				imagettftext($im_hov, $tamanho, $angulo, 3, $tamanho+($tamanho/2)+1, $rgb['cinzento'], $this->font, $texto_original);
			
			imagettftext($im_hov, $tamanho, $angulo, 2, $tamanho+($tamanho/2), $rgb[$hover], $this->font, $texto_original);
			//imagecolortransparent($im, $rgb["transparente"]);
			
			$imw_hov = imagesx($im_hov);
			$imh_hov = imagesy($im_hov);
			$xmin_hov = $imw_hov;
			$xmax_hov = 0;
			for ($iy_hov=0; $iy_hov<$imh_hov; $iy_hov++){
		        $first_hov = true;
		        for ($ix_hov=0; $ix_hov<$imw_hov; $ix_hov++){
		            $ndx_hov = imagecolorat($im_hov, $ix_hov, $iy_hov);
		            if ($ndx_hov != $bg_hov){
		                if ($xmin_hov > $ix_hov){ $xmin_hov = $ix_hov; }
		                if ($xmax_hov < $ix_hov){ $xmax_hov = $ix_hov; }
		                if (!isset($ymin_hov)){ $ymin_hov = $iy_hov; }
		                $ymax_hov = $iy_hov;
		                if ($first_hov){ $ix_hov = $xmax_hov; $first_hov = false; }
		            }
		        }
			}
			$imw_hov = 1+$xmax_hov-$xmin_hov; // Image width in pixels
                        $imh_hov = 1+$ymax_hov-$ymin_hov; // Image height in pixels
		
		    // Make another image to place the trimmed version in.
		    if(preg_match("#[gjpqy]#", $texto_original))
		    	$im2_hov = imagecreatetruecolor($imw_hov+5+5, $imh_hov+3);
		    else
		    	$im2_hov = imagecreatetruecolor($imw_hov+5+5, $imh_hov+3+3);
		
		    // Make the background of the new image the same as the background of the old one.
		    //$bg2 = imagecolorallocate($im2, $bg[0], $bg[1], $bg[2]);
		    if(preg_match("#[gjpqy]#", $texto_original))
		    	imagefilledrectangle($im2_hov, 0, 0, $imw_hov+5+5, $imh_hov+3, $rgb[$fundo]);
		    else
		    	imagefilledrectangle($im2_hov, 0, 0, $imw_hov+5+5, $imh_hov+3+3, $rgb[$fundo]);
		
		    // Copy it over to the new image.
		    	imagecopy($im2_hov, $im_hov, 5, 5, $xmin_hov, $ymin_hov, $imw_hov, $imh_hov);
		
		    // To finish up, we replace the old image which is referenced.
		    $im_hov = $im2_hov;
		    
		    imagecolortransparent($im_hov, $rgb["transparente"]);
		    
		    $texto = $texto_original;
		    
		    $texto = preg_replace("#[�?ÀÂÃ]#i","A",$texto);
		    $texto = preg_replace("#[áàâãª]#i","a",$texto);
		    $texto = preg_replace("#[ÉÈÊ]#i","E",$texto);
		    $texto = preg_replace("#[éèê]#i","e",$texto);
		    $texto = preg_replace("#[ÓÒÔÕ]#i","O",$texto);
		    $texto = preg_replace("#[óòôõº]#i","o",$texto);
		    $texto = preg_replace("#[ÚÙÛ]#i","u",$texto);
		    $texto = preg_replace("#[úùû]#i","u",$texto);
		    $texto = str_replace("#[Ç]#","c",$texto);
		    $texto = str_replace("#[ç]#","c",$texto);
		    $texto = strtolower($texto);
		    
		    $filename_hov = str_replace(" ","_",$texto)."_hover";
			imagepng($im_hov, "fonts/images/$filename_hov.png");
		}
		
		imagedestroy($im);

		if($hover)
			echo "<img src='".BO_URL::obterHrefInterno("fonts/images/$filename.png")."' onmouseover='this.src=\"".BO_URL::obterHrefInterno("fonts/images/$filename_hov.png")."\"'  onmouseout='this.src=\"".BO_URL::obterHrefInterno("fonts/images/$filename.png")."\"' alt='$texto' />";
		else
			echo "<img src='".BO_URL::obterHrefInterno("fonts/images/$filename.png")."' alt='$texto' />";
	}
	
}
?>