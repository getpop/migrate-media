<?php
namespace PoP\Media;

class Utils {
	public static function getAttachmentImageProperties($imageid, $size = null)
	{
	    $cmsmediaapi = FunctionAPIFactory::getInstance();
	    $img = $cmsmediaapi->getMediaSrc($imageid, $size);
	    return array(
	        'src' => $img[0],
	        'width' => $img[1],
	        'height' => $img[2]
	    );
	}
}