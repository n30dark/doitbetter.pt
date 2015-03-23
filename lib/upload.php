<?php
if (!defined('BO_LOADED')) exit('Acesso directo ao script negado.');
/**
 * CMS dib
 *
 * Framework Open Source de desenvolvimento
 * 
 * Classe de Upload
 * 
 * @author		Sérgio Paulino - sergiopaulino@dibconsulting.com
 * @since		Version 2.0
 */

class Upload{
    var $dirbase='';
    var $nomeFicheiroAleatorio = false;
    var $novoNomeFicheiro = '';
    var $permFicheiro = 0744;
    var $erro = 0 ;
    var $nomeItemPost = '';
    var $mimesAutorizados = array();
    var $ficheiroupload = '';
    
    /**
     * Obter o erro de upload
     * 
     * @return O erro de upload
     */
    function obterErro(){
        return $this->erro ;
    }
    
    /**
     * Adicionar um novo mime autorizado
     * 
     * @param $mime O mime a adicionar
     */
    function adicionarMime($mime){
        $this->mimesAutorizados[]=$mime;
    }
    
    /**
     * Fazer um upload
     * 
     */
    function fazerUpload(){

        $erro = false ;
        
        if(!array_key_exists($this->nomeItemPost,$_FILES )){
            $this->erro = 667;
            return false;
        }
        
        $ficheiro = $_FILES[$this->nomeItemPost];

        //check alowed mimes        
        if ($ficheiro['error'] == 0) {
              if(count($this->mimesAutorizados) > 0){
                foreach($this->mimesAutorizados as $mime){
               
                    $mime_ficheiro = explode('/', $ficheiro['type']);
                    $mime_ficheiro = @$mime_ficheiro[1];

                    if (preg_match($mime,$mime_ficheiro  )===false ){
                        $erro = true ;
                    }else{
                        $erro = false ;
                    }
                    
                    if(! $erro ) break ;
                }
            }
            //mime type check                
            if($erro){
                $this->erro = 12;
                return false;
            }
            
            if(strlen($this->novoNomeFicheiro) == 0){
                $nomeficheiro = $ficheiro['name'];
            }else{
                $nomeficheiro = $this->novoNomeFicheiro;
            }
            
            
            
            
            if($this->nomeFicheiroAleatorio){
                //generate a new unique name (md5 hash from current time)
                //we assume that the extention is everything after the first .
                $tmp =explode('.', $ficheiro['name']);
                
                $ext = $tmp[count($tmp)-1];
                if (count($tmp) == 1) $ext='' ;
                
                $nomeficheiro = md5(microtime()) .'.' . $ext;
            }
                
            $this->novoNomeFicheiro = $nomeficheiro;    
            
            
            $this->ficheiroupload = $this->dirbase .'\\' . $nomeficheiro; 
            
                
            if (move_uploaded_file($ficheiro['tmp_name'], $this->ficheiroupload)) {
            	echo "ficheiro enviado";
                chmod($this->ficheiroupload, $this->permFicheiro);
                $this->erro = 0 ;
            }else{
    
                $this->erro ='666' ;
                return false;
            }

        }else {
                $this->erro = $ficheiro['error'] ;
                return false;
        }
        return true ;
               
    }
    
    /**
     * redimensior uma imagem
     * 
     * @param $largura_maxima A largura máxima a redimensionar
     * @param $altura_maxima A altura maxima a redimensionar
     */
    function redimensionar($largura_maxima, $altura_maxima){
    	
    	
    // if uploaded image was JPG/JPEG
		if($_FILES[$this->nomeItemPost]["type"] == "image/jpeg" || $_FILES["frmimagem"]["type"] == "image/pjpeg"){	
			$fonte_imagem = imagecreatefromjpeg($this->ficheiroupload);
		}		
		// if uploaded image was GIF
		if($_FILES[$this->nomeItemPost]["type"] == "image/gif"){	
			$fonte_imagem = imagecreatefromgif($this->ficheiroupload);
		}
		// if uploaded image was PNG
		if($_FILES[$this->nomeItemPost]["type"] == "image/x-png"){
			$fonte_imagem = imagecreatefrompng($this->ficheiroupload);
		}
		
    	
    	$ficheiro_remoto = $this->ficheiroupload;
		imagejpeg($fonte_imagem,$ficheiro_remoto,100);
		chmod($ficheiro_remoto,0644);
	
	

		// get width and height of original image
		list($largura_imagem, $altura_imagem) = getimagesize($ficheiro_remoto);
	
		if($largura_imagem>$largura_maxima || $altura_imagem >$altura_maxima){
			$proporcoes = $largura_imagem/$altura_imagem;
			
			if($largura_imagem>$altura_imagem){
				$nova_largura = $largura_maxima;
				$nova_altura = round($largura_maxima/$proporcoes);
			}		
			else{
				$nova_altura = $altura_maxima;
				$nova_largura = round($altura_maxima*$proporcoes);
			}		
			
			
			$nova_imagem = imagecreatetruecolor($nova_largura , $nova_altura);
			$fonte_imagem = imagecreatefromjpeg($ficheiro_remoto);
			
			imagecopyresampled($nova_imagem, $fonte_imagem, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_imagem, $altura_imagem);
			imagejpeg($nova_imagem,$ficheiro_remoto,100);
			
			imagedestroy($nova_imagem);
		}
		
		imagedestroy($fonte_imagem);	
    }
    
}
?>