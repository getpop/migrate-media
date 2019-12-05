<?php
namespace PoP\Media;

abstract class Dataloader_MediaBase extends \PoP\ComponentModel\Dataloader
{
    public function getDatabaseKey()
    {
        return GD_DATABASE_KEY_MEDIA;
    }

    public function getTypeResolverClass(): string
    {
        return TypeResolver_Media::class;
    }

    public function resolveObjectsFromIDs(array $ids): array
    {
        $cmsmediaapi = \PoP\Media\FunctionAPIFactory::getInstance();
        $query = array(
            'include' => $ids,
        );
        return $cmsmediaapi->getMediaElements($query);
    }
}
