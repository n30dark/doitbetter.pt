<?php
	/*****************************************************************************************************
	* @author	Michael Conroy (mconroy@buffalo.edu)
	* @class	myImageFilter
	* @version	0.2.2
	* @language	PHP 5
	* @description	class for manipulating the pixels of an image directly
	* @requirements	myimagefilter constants (folder - constants)
	* 
	* @created	May 18, 2004
	* @updated	April 26, 2005
	* 	-added
	* 		* kalidescope
	* 	-altered
	* 		* added exception support
	* 		* addRandomNoise is now just "noise"
	* 		* made all filter functions static
	* @updated	April 27, 2005
	* 	-added
	* 		* about function
	* 		* about private variables
	*
	* ***************************************************************************************************/

	include_once('constants/imagefilter_const.inc');  //defined constants
	
	class imageFilter{
	  	
	    /***** OBJECT VARS *****/
		
		//about variables
		private $a_created = 'May 18, 2004';
		private $a_updated = 'April 27, 2005';
		private	$a_version = '0.2.2';
		
		
	    /***** PUBLIC METHODS *****/
		
		/**
		* Gives information about this class object.
		* 
		* @return	string
		*/
		public function about(){
			return "Created by:  Michael Conroy (mconroy@buffalo.edu)\nDate:  " . $this->a_created . "\nLast Updated: " . $this->a_updated . "\nLang:  PHP5\nVersion:  " . $this->a_version;
		}//end about
		
		/**
		* Converts color images to black and white.
		* 
		* @param	img	a myImage object
		* @return	mixed	returns true if the operation is successful otherwise returns a string explaining what error occurred
		*/
		public static function desaturate(image $img = NULL){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){ //covers all pixels horizontally
							for($y=0;$y<=$h;$y++){
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
								$pixel = @round(($rgb['red'] + $rgb['green'] + $rgb['blue'])/3);
								$color = @imagecolorallocate($data,$pixel,$pixel,$pixel);
								@imagesetpixel($data,$x,$y,$color);
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage()); //throw image's exception as the filter exception
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end desaturate
		
		/**
		* Alters the red channel of an image by a user defined factor.  If the user does not define a factor the predefined factor of 1.5 will be used.  Factors of more than 1 will increase the red value of an image, less than 1 will decrease the red value of an image.
		* 
		* @param	img	a myImage object
		* 			factor	number by which to multiple each pixel's red channel value by
		* @return	returns true if the operation succeeds, else an error message is returned
		*/
		public static function altRed(image $img = NULL,$factor = 1.5){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){
							for($y=0;$y<=$h;$y++){
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
								$rgb['red'] *= abs($factor);
								if($rgb['red'] > 255){
									$rgb['red'] = 255;
								}
								$color = @imagecolorallocate($data,@round($rgb['red']),$rgb['green'],$rgb['blue']);
								@imagesetpixel($data,$x,$y,$color);
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end addRed
		
		/**
		* Alters the green channel of an image by a user defined factor.  If the user does not define a factor the predefined factor of 1.5 will be used.  Factors of more than 1 will increase the green value of an image, less than 1 will decrease the green value of an image.
		* 
		* @param	img	a myImage object
		* 			factor	number by which to multiple each pixel's green channel value by
		* @return	returns true if the operation succeeds, else an error message is returned
		*/
		public static function altGreen(image $img = NULL,$factor = 1.5){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){
							for($y=0;$y<=$h;$y++){
								$rgb = imagecolorsforindex($data,imagecolorat($data,$x,$y));
								$rgb['green'] *= abs($factor);
								if($rgb['green'] > 255){
									$rgb['green'] = 255;
								}
								$color = imagecolorallocate($data,$rgb['red'],@round($rgb['green']),$rgb['blue']);
								imagesetpixel($data,$x,$y,$color);
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end addGreen
		
		/**
		* Alters the blue channel of an image by a user defined factor.  If the user does not define a factor the predefined factor of 1.5 will be used.  Factors of more than 1 will increase the blue value of an image, less than 1 will decrease the blue value of an image.
		* 
		* @param	img	a myImage object
		* 			factor	number by which to multiple each pixel's blue channel value by
		* @return	returns true if the operation succeeds, else an error message is returned
		*/
		public static function altBlue(image $img = NULL,$factor = 1.5){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){
							for($y=0;$y<=$h;$y++){
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
								$rgb['blue'] *= abs($factor);
								if($rgb['blue'] > 255){
									$rgb['blue'] = 255;
								}
								$color = @imagecolorallocate($data,$rgb['red'],$rgb['green'],@round($rgb['blue']));
								@imagesetpixel($data,$x,$y,$color);
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end addBlue
		
		/**
		* Deletes the green and blue values of each pixel in the image, thus returning the red channel of the image.
		* 
		* @param	img	myImage object
		* @return	true if operation is successful, an error message on failure
		*/
		public static function redChannel(image $img = NULL){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){
							for($y=0;$y<=$h;$y++){
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
								$color = @imagecolorallocate($data,$rgb['red'],0,0);
								@imagesetpixel($data,$x,$y,$color);
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end redChannel
		
		/**
		* Deletes the red and blue values of each pixel in the image, thus returning the green channel of the image.
		* 
		* @param	img	myImage object
		* @return	true if operation is successful, an error message on failure
		*/
		public static function greenChannel(image $img = NULL){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){
							for($y=0;$y<=$h;$y++){
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
								$color = @imagecolorallocate($data,0,$rgb['green'],0);
								@imagesetpixel($data,$x,$y,$color);
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end greenChannel
		
		/**
		* Deletes the red and green values of each pixel in the image, thus returning the blue channel of the image.
		* 
		* @param	img	myImage object
		* @return	true if operation is successful, an error message on failure
		*/
		public static function blueChannel(image $img = NULL){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){
							for($y=0;$y<=$h;$y++){
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
								$color = @imagecolorallocate($data,0,0,$rgb['blue']);
								@imagesetpixel($data,$x,$y,$color);
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end blueChannel
		
		/**
		* Does a pure black and pure white posterization of an image.
		* 
		* @param	img	a myImage object
		* 			threshold	defines the percentage by which a pixel is to be considered black, 50% is default
		* @return	true if operation succeeds, and error message otherwise
		*/
		public static function bwPosterize(image $img = NULL,$threshold = 50){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){ //covers all pixels horizontally
							for($y=0;$y<=$h;$y++){
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
								$pixel = round(($rgb['red'] + $rgb['green'] + $rgb['blue'])/3);
								//b&w conversion
								if($pixel < ((255 * $threshold)/100)){
									$pixel = 0;
								}else{
									$pixel = 255;
								}
							
								$color = @imagecolorallocate($data,$pixel,$pixel,$pixel);
								@imagesetpixel($data,$x,$y,$color);
							}
						}	
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end bwPoster
		
		/**
		* Does a gray scale posterization of an image, the amount of colors (levels) of posterization is determined by the number of divisions the users wishes.
		* 
		* @param	img	a myImage object
		* 			divisions	integer value defining the number of levels of gray that should be defined in the resulting image
		* @return	true if the operation succeeds, otherwise return an error message
		*/
		public static function grayScalePosterize(image $img = NULL,$divisions = 4){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						$step = 255 / $divisions;  //amount of color is decided by the number of divisions set
						for($x=0;$x<=$w;$x++){ //covers all pixels horizontally
							for($y=0;$y<=$h;$y++){
								$rgb = @imagecolorsforindex($data,imagecolorat($data,$x,$y));
								$pixel = @round(($rgb['red'] + $rgb['green'] + $rgb['blue'])/3);
							
								//gray scale conversion (default 4 scales)
								if($pixel <= $step){
									$pixel = 0;
								}elseif($pixel >= (255 - $step)){
									$pixel = 255;
								}else{
									$i = $step;
									while($i < 255){
										if($pixel <= $i){
											$pixel = $i;
											break;
										}
										$i += $step;
									}
								}
							
								$color = @imagecolorallocate($data,$pixel,$pixel,$pixel);
								@imagesetpixel($data,$x,$y,$color);
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end grayScalePosterize
		
		/**
		* Shifts the channel values of each pixel in an image over to a different channel.  The value jump from one channel to the next is defined by the user, a value of one shifts the channels one spot, a value of two shifts the channels two spots.
		* 
		* @param	img	a myImage object
		* 			shift	integer, either 1 or 2 defining the number of jumps a channel should move over by
		* @return	true if the operation succeeds, otherwise an error message is returned
		*/
		public static function colorShift(image $img = NULL,$shift = 1){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){ //covers all pixels horizontally
							for($y=0;$y<=$h;$y++){
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
							
								//do color shift, $shift is either 1 or 2
								switch($shift){
									case 2:
										$color = @imagecolorallocate($data,$rgb['green'],$rgb['blue'],$rgb['red']);
										break;
									case 1:
									default:
										$color = @imagecolorallocate($data,$rgb['blue'],$rgb['red'],$rgb['green']);
										break;
								}
								@imagesetpixel($data,$x,$y,$color);
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end colorShift
		
		/**
		* Increases or reduces the contrast value of an image by a user defined factor.
		* 
		* @param	img	myImage object
		* 			factor	integer by which each channel of an image pixel will be multipled by
		* @return	true if the operation succeeds, otherwise an error message is returned
		*/
		public static function contrast(image $img = NULL,$factor = 2){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){ //covers all pixels horizontally
							for($y=0;$y<=$h;$y++){
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
								
								if($rgb['red'] > 128){
									if(($rgb['red'] = 128 + @round(($rgb['red'] - 128) * $factor)) > 255){
										$rgb['red'] = 255;
									}
								}else{
									if(($rgb['red'] = 128 - @round((128 - $rgb['red']) * $factor)) < 0){
										$rgb['red'] = 0;
									}
								}
								if($rgb['green'] > 128){
									if(($rgb['green'] = 128 + @round(($rgb['green'] - 128) * $factor)) > 255){
										$rgb['green'] = 255;
									}
								}else{
									if(($rgb['green'] = 128 - @round((128 - $rgb['green']) * $factor)) < 0){
										$rgb['green'] = 0;
									}
								}
								if($rgb['blue'] > 128){
									if(($rgb['blue'] = 128 + @round(($rgb['blue'] - 128) * $factor)) > 255){
										$rgb['blue'] = 255;
									}
								}else{
									if(($rgb['blue'] = 128 - @round((128 - $rgb['blue']) * $factor)) < 0){
										$rgb['blue'] = 0;
									}
								}
								$color = @imagecolorallocate($data,$rgb['red'],$rgb['green'],$rgb['blue']);
								@imagesetpixel($data,$x,$y,$color);
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end contrast
		
		/**
		* Inverts an image by subtracting each pixel's channel values from the highest possible channel value.
		* 
		* @param	img	myImage object
		* @return	true if the operation succeeds, otherwise an error message is returned
		*/
		public static function invert(image $img = NULL){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){
							for($y=0;$y<=$h;$y++){
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
								$color = @imagecolorallocate($data,(255 - $rgb['red']),(255 - $rgb['green']),(255 - $rgb['blue']));
								@imagesetpixel($data,$x,$y,$color);
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end invert
		
		/**
		* Increases or decreases the image's brightness based on a user defined factor.
		* 
		* @param	img	myImage object
		* 			factor	float value by which each pixel's channel values will be multplied by.  1.5 is the default, values of greater than 1 will increase an image's brightness, values of less than 1 will decrease an image's brightness
		* @return	true if the operation succeeds, otherwise an error message is returned
		*/
		public static function brightness(image $img = NULL, $factor = 1.5){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){
							for($y=0;$y<=$h;$y++){
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
								
								if(($rgb['red'] *= $factor) > 255){
									$rgb['red'] = 255;
								}elseif($rgb['red'] < 0){
									$rgb['red'] = 0;
								}
								if(($rgb['green'] *= $factor) > 255){
									$rgb['green'] = 255;
								}elseif($rgb['green'] < 0){
									$rgb['green'] = 0;
								}
								if(($rgb['blue'] *= $factor) > 255){
									$rgb['blue'] = 255;
								}elseif($rgb['blue'] < 0){
									$rgb['blue'] = 0;
								}
								$color = @imagecolorallocate($data,$rgb['red'],$rgb['green'],$rgb['blue']);
								@imagesetpixel($data,$x,$y,$color);
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end brightness
		
		/**
		* Attempts to create a masking image out of the original.  A fill color and an edge fill color are supplied by the user in the form of RGB values.  The complexity value is for the call to the grayScalePosterize function, the threshold value determines the range at which pixels next to each other should be colored the same way.
		* 
		* @param	img	myImage object
		* 			redfill	integer 0-255, determines the red value of the fill color
		* 			greenfill	integer 0-255, determines the green value of the fill color
		* 			bluefill	integer 0-255, determines the blue value of the fill color
		* 			rededge	integer 0-255, determines the red value of the opposing fill color
		* 			greenedge	integer 0-255, determines the green value of the opposing fill color
		* 			blueedge	integer 0-255, determines the blue value of the opposing fill color
		* 			complexity	float, see grayScalePosterize method for the definition of 'divisions'
		* 			threshold	integer, determines the range value that pixel next to one another are colored the same.
		* @return	true if the operation succeeds, or an error message if method has failed
		*/
		public static function mask(image $img = NULL,$redfill = 255,$greenfill = 255,$bluefill = 255,$rededge = 0,$greenedge = 0,$blueedge = 0,$complexity = 3,$threshold = 10){
			if($img !== NULL){
				if($img->isImageSet()){
					if(imageFilter::grayScalePosterize(&$img,$complexity)){
						try{
							$data =& $img->getImageData();
							$w = $img->getImageWidth();
							$h = $img->getImageHeight();
							$fill = @imagecolorallocate($data,$redfill,$greenfill,$bluefill);
							$edge = @imagecolorallocate($data,$rededge,$greenedge,$blueedge);
							for($y=0;$y<=$h;$y++){
								$pixel = NULL;
								for($x=0;$x<=$w;$x++){
									$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
								
									if($pixel !== NULL){
										$current = @round(($rgb['red'] + $rgb['green'] + $rgb['blue'])/3);
										if(($pixel <= 0)){
											if($current > $threshold){
												@imagesetpixel($data,$x,$y,$edge);
											}else{
												@imagesetpixel($data,$x,$y,$fill);
											}
										}elseif((($current * 100)/$pixel) > $threshold){
											@imagesetpixel($data,$x,$y,$edge);
										}else{
											@imagesetpixel($data,$x,$y,$fill);
										}
										$pixel = $current;
									}else{
										$pixel = @round(($rgb['red'] + $rgb['green'] + $rgb['blue'])/3);
									}
								}
							}
							return true;
						}catch(Exception $e){
							throw new Exception($e->getMessage());
						}
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end mask
		
		/**
		* Creates a faded overlay of the second image onto the first with user defined position offsets.
		* 
		* @param	img	myImage object
		* 			ghost	myImage object
		* 			xoffset	integer, locates the top of the ghost image relative to the original image
		* 			yoffset integer, locates the left side of the ghost image relative ot the original image
		* 			amount	percentage of transparency for the ghost image
		* @return	return true on successful operation, an error message is returned all other times
		*/
		public static function ghost(image $img = NULL,image $ghost = NULL,$xoffset = 10, $yoffset = 10,$amount = 25){
			if(($img !== NULL)&&($ghost !== NULL)){
				if(($img->isImageSet())&&($ghost->isImageSet())){
					try{
						//check to see if the ghost is the right size for the image, if not resize
						if(!(($img->getImageWidth() == $ghost->getImageWidth())&&($img->getImageHeight() == $ghost->getImageHeight()))){
							$ghost->resize($img->getImageWidth(),$img->getImageHeight());
						}
					
						$data =& $img->getImageData();
						$gdata =& $ghost->getImageData();
					
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						$startx = 0;
						$starty = 0;
						$xoff = 0;
						$yoff = 0;
					
						if($xoffset < 0){
							$startx = abs($xoffset);
						}
						if($yoffset < 0){
							$starty = abs($yoffset);
						}
						
						for($x=$startx;$x<=$w;$x++){
							if($xoffset > 0){
								$xoff = $x + $xoffset;
							}else{
								$xoff++;
							}
							$yoff = 0;
							for($y=$starty;$y<=$h;$y++){
								
								if($yoffset > 0){
									$yoff = $y + $yoffset;
								}else{
									$yoff++;
								}
							
								if(($xoff <= $w)&&($yoff <= $h)){
									//do ghosting for this pixel
									$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
									$grgb = @imagecolorsforindex($data,@imagecolorat($data,$xoff,$yoff));
									
									$rgb['red'] += ($amount * $grgb['red']) / 100;
									if($rgb['red'] > 255){
										$rgb['red'] = 255;
									}
									$rgb['green'] += ($amount * $grgb['green']) / 100;
									if($rgb['green'] > 255){
										$rgb['green'] = 255;
									}
									$rgb['blue'] += ($amount * $grgb['blue']) / 100;
									if($rgb['blue'] > 255){
										$rgb['blue'] = 255;
									}
									
									$color = @imagecolorallocate($data,$rgb['red'],$rgb['green'],$rgb['blue']);
									@imagesetpixel($data,$x,$y,$color);
								}
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end ghost
		
		/**
		* Adds random color pixels to an image.
		* 
		* @param	img	myImage object
		* 			coverage	integer 0-10, default is 5, determines the amount of pixels that should be added to the image.  5 is roughly 50% coverage.
		* @return	true if operation is successful, an error message if operation fails
		*/
		public static function noise(image $img = NULL,$coverage = 5){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();	
						for($x=0;$x<=$w;$x++){
							for($y=0;$y<=$h;$y++){
								if(rand(0,10) < $coverage){
									$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
									$random = @rand(0,255);
									$color = @imagecolorallocate($data,(($rgb['red'] * $random)%256),(($rgb['green'] * $random)%256),(($rgb['blue'] * $random)%256));
									@imagesetpixel($data,$x,$y,$color);
								}
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end noise
		
		/**
		* Given user values for RGB it will add the user color as an overlay to the original image.
		* 
		* @param	img	myImage object
		* 			red	integer 0-255, red value of overlay color
		* 			green	integer 0-255, green value of overlay color
		* 			blue	integer 0-255, blue value of overlay color
		* @return	true on successful operation, an error message on failure
		*/
		public static function colorOverlay(image $img = NULL,$red = 64,$green = 64,$blue = 64){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){
							for($y=0;$y<=$h;$y++){
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
								
								if(($rgb['red'] += $red) > 255){
									$rgb['red'] = 255;
								}
								
								if(($rgb['green'] += $green) > 255){
									$rgb['green'] = 255;
								}
								
								if(($rgb['blue'] += $blue) > 255){
									$rgb['blue'] = 255;
								}
								$color = @imagecolorallocate($data,$rgb['red'],$rgb['green'],$rgb['blue']);
								@imagesetpixel($data,$x,$y,$color);
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end colorOverlay
		
		/**
		* Creates an image from the original that when viewed appears to have been mirrored at a 45 degree angle through the middle of the original image.
		* 
		* @param	img	myImage object
		* @return	true if operation is successful, an error message on failure
		*/
		public static function diagonalMirror(image $img = NULL){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$data =& $img->getImageData();
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){
							for($y=0;$y<=$h;$y++){
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
								$color = @imagecolorallocate($data,$rgb['red'],$rgb['green'],$rgb['blue']);
								@imagesetpixel($data,$y,$x,$color);
							}
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end diagonalMirror
		
		/**
		* Posterizes and does a pixel streaking effect, like wind blown pixels.
		* 
		* @param	img	myImage object
		* 			copy	myImage object
		* 			divisions	integer, describes the amount of posterization for the grayScalePosterize method
		* 			orientation	string (horizontal,vertical), determines the direction of the pixel streaks
		* @return	true if the operation is successful, an error message on failure
		*/
		public static function posterStreaks(image $img = NULL,image $copy = NULL,$divisions = 4,$orientation = 'horizontal'){
			if($img !== NULL){
				if($img->isImageSet()){
					if(imageFilter::grayScalePosterize($copy,$divisions)){
						try{
							$data =& $img->getImageData();
							$cdata =& $copy->getImageData();
						
							if($orientation == 'vertical'){
								$h = $img->getImageWidth();
								$w = $img->getImageHeight();	
							}else{					
								$w = $img->getImageWidth();
								$h = $img->getImageHeight();					
							}
							$pixel = NULL;
							$savedcolor = NULL;
							for($y=0;$y<=$h;$y++){
								for($x=0;$x<=$w;$x++){
									if($orientation == 'vertical'){
										$crgb = @imagecolorsforindex($cdata,@imagecolorat($cdata,$y,$x));
										$rgb = @imagecolorsforindex($data,@imagecolorat($data,$y,$x));
									}else{
										$crgb = @imagecolorsforindex($cdata,@imagecolorat($cdata,$x,$y));
										$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
									}
									switch($pixel){
										case @round(($crgb['red'] + $crgb['green'] + $crgb['blue'])/3):
											if($orientation == 'vertical'){
												@imagesetpixel($data,$y,$x,$savedcolor);
											}else{
												@imagesetpixel($data,$x,$y,$savedcolor);
											}
											break;
										case NULL:
										default:
											$pixel = @round(($crgb['red'] + $crgb['green'] + $crgb['blue'])/3);
											$savedcolor = imagecolorallocate($data,$rgb['red'],$rgb['green'],$rgb['blue']);
											break;									
									}
								}
							}
							$copy->clean();
							return true;
						}catch(Exception $e){
							throw new Exception($e->getMessage());
						}
					}
					throw new Exception(FAILEDFILTER);
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end colorPosterize
		
		/**
		* Does a black and white posterization of the second image then uses that to block the original image pixels whereever there is black.  In other words it uses the second image to create a mask over the first image.
		* 
		* @param	img	myImage object
		* 			map	myImage object
		* 			red	integer 0-255, defines the red value of the mask fill
		* 			green	integer 0-255, defines the green value of the mask fill
		* 			blue	integer 0-255, defines the blue value of the mask fill
		* @return	true on successful operation, an error message on failure
		*/
		public static function maskMap(image $img = NULL,image $map = NULL,$red = 255,$green = 255,$blue = 255){
			if(($img !== NULL)&&($map !== NULL)){
				if(($img->isImageSet())&&($map->isImageSet())){
					try{
						//check to see if the map is the right size for the image, if not resize
						if(!(($img->getImageWidth() == $map->getImageWidth())&&($img->getImageHeight() == $map->getImageHeight()))){
							$map->resize($img->getImageWidth(),$img->getImageHeight());
						}
						
						//make the contrast map
						imageFilter::bwPosterize(&$map);
					
						$mdata =& $map->getImageData();
						$data =& $img->getImageData();
					
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){
							for($y=0;$y<=$h;$y++){
								$mrgb = @imagecolorsforindex($mdata,@imagecolorat($mdata,$x,$y));
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
							
								if($mrgb['red'] == 255){ //white = show through
									$color = @imagecolorallocate($data,$rgb['red'],$rgb['green'],$rgb['blue']);
								}else{ //black = block
									$color = @imagecolorallocate($data,$red,$green,$blue);
								}
								@imagesetpixel($data,$x,$y,$color);
							}
						}
						$map->clean();
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end maskMap
		
		/**
		* Uses another image to formulate where to add contrast to the original image, by doing a black and white posterization first then using the white areas to cue additions to contrast and black areas as a negation to contrast.
		* 
		* @param	img	myImage object
		* 			map	myImage object
		* 			threshold	determines the amount of contrast to add.
		* @return	true if operation is successful, an error message upon failure
		*/
		public static function contrastMap(image $img = NULL,image $map = NULL,$threshold = 50){
			if(($img !== NULL)&&($map !== NULL)){
				if(($img->isImageSet())&&($map->isImageSet())){
					try{
						//check to see if the map is the right size for the image, if not resize
						if(!(($img->getImageWidth() == $map->getImageWidth())&&($img->getImageHeight() == $map->getImageHeight()))){
							$map->resize($img->getImageWidth(),$img->getImageHeight());
						}
					
						//make the contrast map
						imageFilter::bwPosterize($map);
					
						$mdata = $map->getImageData();
						$data = $img->getImageData();
						
						$w = $img->getImageWidth();
						$h = $img->getImageHeight();
						for($x=0;$x<=$w;$x++){
							for($y=0;$y<=$h;$y++){
								$mrgb = @imagecolorsforindex($mdata,@imagecolorat($mdata,$x,$y));
								$rgb = @imagecolorsforindex($data,@imagecolorat($data,$x,$y));
							
								if($mrgb['red'] == 255){ //white
									$rgb['red'] += (($rgb['red'] * $threshold)/100);
									if($rgb['red'] > 255){
										$rgb['red'] = 255;
									}
									$rgb['green'] += (($rgb['green'] * $threshold)/100);
									if($rgb['green'] > 255){
										$rgb['green'] = 255;
									}
									$rgb['blue'] += (($rgb['blue'] * $threshold)/100);
									if($rgb['blue'] > 255){
										$rgb['blue'] = 255;
									}
								}else{ //black
									$rgb['red'] -= (($rgb['red'] * $threshold)/100);
									if($rgb['red'] < 0){
										$rgb['red'] = 0;
									}
									$rgb['green'] -= (($rgb['green'] * $threshold)/100);
									if($rgb['green'] < 0){
										$rgb['green'] = 0;
									}
									$rgb['blue'] -= (($rgb['blue'] * $threshold)/100);
									if($rgb['blue'] < 0){
										$rgb['blue'] = 0;
									}
								}
								
								$color = @imagecolorallocate($data,$rgb['red'],$rgb['green'],$rgb['blue']);
								@imagesetpixel($data,$x,$y,$color);
							}
						}
						$map->clean();
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end contrastMap
		
		/**
		* 
		*/
		public static function kaleidoscope(image $img = NULL, $rotations = 3){
			if($img !== NULL){
				if($img->isImageSet()){
					try{
						$width = $img->getImageWidth();
						$height = $img->getImageHeight();
						$degrees = 360 / $rotations;
						for($x=0;$x<$rotations;$x++){
							imageFilter::diagonalMirror(&$img);
							$img->rotate($degrees);
							//$img->crop(0,0,$width,$height);
						}
						return true;
					}catch(Exception $e){
						throw new Exception($e->getMessage());
					}
				}
				throw new Exception(NOIMAGELOADED);
			}
			throw new Exception(NOIMAGEOBJECT);
		}//end kaleidoscope
		
		
		/***** PRIVATE METHODS *****/
		
		
		/***** CONSTRUCTOR *****/
		
		/**
		* Object's constructor method, called when object is created.
		*/
		function __construct(){
			//empty
		}//end construct
		
		
		/***** DESTRUCTOR *****/
		
		/**
		* Object's destructor method, called when object is dead and being garbage collected
		*/
		function __destruct(){
			//empty
		}//end destruct
		
	}//end class imageFilter
?>