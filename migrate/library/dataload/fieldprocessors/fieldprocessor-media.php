<?php
namespace PoP\Media;
use PoP\ComponentModel\FieldResolvers\AbstractFieldResolver;

class FieldResolver_Media extends AbstractFieldResolver
{
    public function getId($resultItem)
    {
        $cmsmediaresolver = \PoP\Media\ObjectPropertyResolverFactory::getInstance();
        $media = $resultItem;
        return $cmsmediaresolver->getMediaId($media);
    }

    public function getIdFieldDataloaderClass()
    {
        return \PoP\Media\Dataloader_MediaList::class;
    }
}

