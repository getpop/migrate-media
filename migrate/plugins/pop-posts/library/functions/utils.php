<?php
namespace PoP\Media;
use PoP\Hooks\Facades\HooksAPIFacade;

class PostsUtils {

	public static function getThumbId($post_id)
	{
	    $cmsmediapostsapi = PostsFunctionAPIFactory::getInstance();
	    if ($thumb_id = $cmsmediapostsapi->getPostThumbnailId($post_id)) {
	        return $thumb_id;
	    }

	    // Default
	    return HooksAPIFacade::getInstance()->applyFilters('getThumbId:default', POP_MEDIA_IMAGE_NOFEATUREDIMAGEPOST, $post_id);
	}
}