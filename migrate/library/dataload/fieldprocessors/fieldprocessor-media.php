<?php
namespace PoP\Media;
use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;

class TypeResolver_Media extends AbstractTypeResolver
{
    public const DATABASE_KEY = 'media';

    public function getDatabaseKey(): string
    {
        return self::DATABASE_KEY;
    }

    public function getId($resultItem)
    {
        $cmsmediaresolver = \PoP\Media\ObjectPropertyResolverFactory::getInstance();
        $media = $resultItem;
        return $cmsmediaresolver->getMediaId($media);
    }

    public function getIdFieldTypeDataResolverClass()
    {
        return \PoP\Media\Dataloader_MediaList::class;
    }
}

