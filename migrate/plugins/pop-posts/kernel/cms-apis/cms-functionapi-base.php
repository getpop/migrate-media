<?php
namespace PoP\Media;

abstract class PostsFunctionAPI_Base implements PostsFunctionAPI
{
    public function __construct()
    {
        PostsFunctionAPIFactory::setInstance($this);
    }
}
