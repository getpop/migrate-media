<?php
namespace PoP\Media;

class FieldValueResolver_Media extends \PoP\ComponentModel\FieldValueResolverBase
{
    public function getId($resultitem)
    {
        $cmsmediaresolver = \PoP\Media\ObjectPropertyResolverFactory::getInstance();
        $media = $resultitem;
        return $cmsmediaresolver->getMediaId($media);
    }

    public function getIdFieldDataloaderClass()
    {
        return \PoP\Media\Dataloader_MediaList::class;
    }
}

