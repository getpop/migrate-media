<?php
namespace PoP\Media;

class FieldResolver_Media extends \PoP\ComponentModel\FieldResolverBase
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

