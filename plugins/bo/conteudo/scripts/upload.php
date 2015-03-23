<?php

function json_enc($a=false)
  {
    if (is_null($a)) return 'null';
    if ($a === false) return 'false';
    if ($a === true) return 'true';
    if (is_scalar($a))
    {
      if (is_float($a))
      {
        // Always use "." for floats.
        return floatval(str_replace(",", ".", strval($a)));
      }

      if (is_string($a))
      {
        static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
        return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
      }
      else
        return $a;
    }
    $isList = true;
    for ($i = 0, reset($a); $i < count($a); $i++, next($a))
    {
      if (key($a) !== $i)
      {
        $isList = false;
        break;
      }
    }
    $result = array();
    if ($isList)
    {
      foreach ($a as $v) $result[] = json_enc($v);
      return '[' . join(',', $result) . ']';
    }
    else
    {
      foreach ($a as $k => $v) $result[] = json_enc($k).':'.json_enc($v);
      return '{' . join(',', $result) . '}';
    }
  }


function _resize($_w, $max_w, $_h, $max_h) {
	global $new_w, $new_h;
	
	if ($_w>$max_w || $_h>$max_h) {
		$x_ratio = $max_w / $_w;
		$y_ratio = $max_h / $_h;
		if (($x_ratio * $_h) < $max_h) {
			$new_h = ceil($x_ratio * $_h);
			$new_w =$max_w;
		}
		else {
			$new_w = ceil($y_ratio * $_w);
			$new_h=$max_h;
		}
	}
	else {
		$new_w = $_w;
		$new_h=$_h;
	}
}

if ($_FILES) {
	
	foreach ($_FILES as $f) {

			// get actual image type
			$aux = getimagesize($f['tmp_name']);
			$ext = strtolower(str_replace("image/", "", image_type_to_mime_type($aux[2])));
			// get image type from file extension
			$ext_file = strtolower(str_replace("image/", "", $f['type']));
			// adjustment for IE mime types
			$ext_adjust = array("pjpeg" => "jpeg", "x-png" => "png");
			$ext_file = (array_key_exists($ext_file, $ext_adjust)) ? $ext_adjust[$ext_file] : $ext_file;
			
			// check if file actual and ext file types match
			if ( ($ext_file != $ext) )  {
				$pst = array("problem" => array("name" =>$f['name'], "ext" => $ext, "ext_actual" => $ext_file));
			}
			else {
				
				$stat = stat($f['tmp_name']);
				$renamed = md5(microtime()).".$ext_file";//($_POST['mode']=='demo') ? $stat[9].'.'. substr(strrchr($f['name'], "."),1) : $f['name'];

                                //echo "tmpname".chmod($f['tmp_name'], 0755);
                                //echo "thum_folder".chmod($_SERVER['DOCUMENT_ROOT'] .'/'. $_POST['thumb'], 0777);
                                //echo "upload_folder".chmod($_SERVER['DOCUMENT_ROOT'] .'/'. $_POST['upload'], 0777);

				// set path for upload directory
				$f['_upload'] = $_SERVER['DOCUMENT_ROOT'] .'/restaurantesenhorabade/'. $_POST['upload'] .'/'. $renamed;
                                //echo "is_dir: ".(is_dir($_POST['upload']));
                                //echo "is_writable: ".(is_writable($_SERVER['DOCUMENT_ROOT'] .'/'. $_POST['upload']));
                                //echo $_SERVER['DOCUMENT_ROOT'] .'/'. $_POST['upload'];
				// set path for image thumbnail directory
				$f['_thumb'] = $_SERVER['DOCUMENT_ROOT'] .'/restaurantesenhorabade/'.$_POST['upload'] .'/'. $renamed;
                                //echo "is_dir: ".(is_dir($_SERVER['DOCUMENT_ROOT'] .'/'. $_POST['thumb']));
                                //echo "is_writable: ".(is_writable($_SERVER['DOCUMENT_ROOT'] .'/'. $_POST['thumb']));
                                //echo $_SERVER['DOCUMENT_ROOT'] .'/'. $_POST['thumb'];

				$f['src'] = 'http://'.$_SERVER['SERVER_NAME'] .'/restaurantesenhorabade/'. str_replace('\\','/',$_POST['upload']) .'/'. $renamed;

                                

                                if(move_uploaded_file($f['tmp_name'], $f['_upload'])){
                                    //echo "uploaded";
                                    /*if(copy($f['_upload'], $f['thumb'])){
                                        echo "copied";*/
										
										/*include_once '../../../../lib/basedados.php'										
										
										$bd = &new BaseDados();
										$pst = array ("problem" => array("name" =>$f['name'], "error" =>) );*/
										//echo "var pst = " . json_enc($pst);
										/*if(is_numeric($qs->Segmentos[count($qs->Segmentos)-1]))
											$id = $_POST['id'];
											$tabela = $_POST['tabela'];
										}else{
											$tabela = $_POST['tabela'];
											$aux = $bd->obterObjecto("SELECT * FROM $tabela ORDER BY id DESC");
											$id = $aux->id;
										}
										$bd->executar("INSERT INTO ".$tabela."_imagens (parent, imagem) VALUES ($id, $renamed)");*/
                                        $pst = array ("img" => array("alt" => $f['_thumb'], "src" => $f['src'], "name" => $f['name'],  "rename" => $renamed, "width" => $new_w, "height" => $new_h));
                                        //echo "var pst = " . json_enc($pst);
                                        /*echo "var pst = " . json_enc($pst);
                                    }else{
                                        echo "error copy";
                                        $pst = array ("problem" => array("name" =>$f['name'], "error" => $e->__toString()) );
                                        echo "var pst = " . json_enc($pst);
                                    }*/
                                }else{
                                    //echo "error upload";
                                    $pst = array ("problem" => array("name" =>$f['name'], "error" => $e->__toString()) );
                                    //echo "var pst = " . json_enc($pst);
                                }
								echo "var pst = " . json_enc($pst);

				/*chmod($f['tmp_name'], 0755);
				
				// get image size - requires GD ../../../../library
				list($width, $height) = getimagesize($f['tmp_name']);

					
				$max_width = 600;
				$max_height = 400;
				_resize($width, $max_width, $height, $max_height);

				// create thumbnail with image_class (files included in download)
				include_once('imageClass/image_class.inc'); 
				//set_time_limit(140);
                                try{
					// create new image from posted $_FILES
					//$image= &new image($f['tmp_name']);
                                        //echo $f['_upload'];
					//$image->resize(round($new_w),round($new_h));
					// save image to thumbnail directory                                       
					//$image->saveImage($f['_upload'],$image->getImageData());
					//$image->clean();
					// move actual posted $_FILES to upload directory
					$moved = move_uploaded_file($f['tmp_name'], $f['_upload']);

				}
				catch(Exception $e){
                                        $pst = array ("problem" => array("name" =>$f['name'], "error" => $e->__toString()) );
                                        
				}	 		

				$max_width = 100;
				$max_height = 60;
				_resize($width, $max_width, $height, $max_height);


				// create thumbnail with image_class (files included in download) 
				//set_time_limit(140);
				try{
					// create new image from posted $_FILES
					//$image= &new image($f['_upload']);
					//$image->resize(round($new_w),round($new_h));
					// save image to thumbnail directory
					//$image->saveImage($f['_thumb'],$image->getImageData());
					//$image->clean();
					// move actual posted $_FILES to upload directory
					$moved = copy($f['_upload'], $f['thumb']);
					$pst = array ("img" => array("alt" => $f['_thumb'], "src" => $f['src'], "name" => $f['name'],  "rename" => $renamed, "width" => $new_w, "height" => $new_h));
				}
				catch(Exception $e){
                                        $pst = array ("problem" => array("name" =>$f['name'], "error" => $e->__toString()) );
                                        
				}*/
			}                       

//			echo "var pst = " . json_enc($pst);
			
	}
}
else if ($_POST['deleteFile']) {
	$_file = ($_POST['mode']=='demo') ? urldecode($_POST['deleteFile']) : urldecode($_POST['deleteFile']);
	// delete tmp file
	
	$bd = &new BaseDados();
	$bd->executar("DELETE FROM ".$tabela."_imagens WHERE imagem='".$_POST['deleteFile']."'");
	
	$_unlink_upload = unlink($_SERVER['DOCUMENT_ROOT'] .'/restaurantesenhorabade/'. $_POST['upload'] .'/'. urldecode($_POST['deleteFile']));
	// delete thumb file
	/*$_unlink_thumb = unlink($_SERVER['DOCUMENT_ROOT'] .'/'. $_POST['uplo'].'/'. $_file);*/
	
	if ($_unlink_upload) echo "Ficheiro <span>" . $_POST['origName'] . "</span> Eliminado.";
	else echo "Problem deleting file " . $_file . ".";
}else if($_POST['editFile']){
	echo "success";
}
?>

