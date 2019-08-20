<?php
namespace PoP\Media;

interface PostsFunctionAPI
{
    public function hasPostThumbnail($post_id);
    public function getPostThumbnailId($post_id);
}
