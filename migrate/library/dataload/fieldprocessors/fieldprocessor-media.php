<?php
namespace PoP\Media;
use PoP\ComponentModel\TypeResolvers\AbstractTypeResolver;

class TypeResolver_Media extends AbstractTypeResolver
{
    public const TYPE_COLLECTION_NAME = 'media';

    public function getTypeCollectionName(): string
    {
        return self::TYPE_COLLECTION_NAME;
    }

    public function getId($resultItem)
    {
        $cmsmediaresolver = \PoP\Media\ObjectPropertyResolverFactory::getInstance();
        $media = $resultItem;
        return $cmsmediaresolver->getMediaId($media);
    }

    public function getIdFieldTypeDataResolverClass(): string
    {
        return \PoP\Media\Dataloader_MediaList::class;
    }
}

