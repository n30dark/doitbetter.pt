<?php
/** returns gd stream from movie file on a relatively given timestamp in movie
 * @param   $file       Path to file
 * @param   $reltimepos Relative time position in percent
 * @return  $gdstream   GD-Stream picture of given moviefile  */
function imagecreatefromvideo($file,$reltimepos=10)
{
	// Try to load movie file
	if($movie=@new ffmpeg_movie($file))
	{
		// Create emtpy image with given dimensions
		$gdim=imagecreatetruecolor( $movie->getFrameWidth(),$movie->getFrameHeight() );
		imagefill($gdim,0,0,hexdec("ffffff"));		// Weiss bef�llen
		$frame =new ffmpeg_frame($gdim);
                $framepos= min(max(1,round($movie->getFrameCount()/100*$reltimepos)),$movie->getFrameCount()-1);
                
                $frame=$movie->getFrame($framepos);
		if($frame)
		{
			/*$gd=$frame->toGDImage();
			imagestring($gd,5,4,4,$reltimepos,hexdec('ffffff'));
			return $gd; /**/
			return $frame->toGDImage();
		}
		elseif( $frame=$movie->getFrame(1) )
				return $frame->toGDImage();
	}
	return NULL;
}
?>