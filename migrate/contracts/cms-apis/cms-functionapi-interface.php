<?php
namespace PoP\Media;

interface FunctionAPI
{
    public function getMediaObject($media_id);
    public function getMediaDescription($media_id);
    public function getAttachmentImageSrc($image_id, $size = null);
    public function getPostMimeType($post_thumb_id);
}
