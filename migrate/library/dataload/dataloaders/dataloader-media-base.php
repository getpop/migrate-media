<?php
namespace PoP\Media;

abstract class Dataloader_MediaBase extends \PoP\ComponentModel\QueryDataDataloader
{
    public function getDatabaseKey()
    {
        return GD_DATABASE_KEY_MEDIA;
    }

    public function getTypeResolverClass(): string
    {
        return TypeResolver_Media::class;
    }

    protected function executeGetData(array $ids): array
    {
        $cmsmediaapi = \PoP\Media\FunctionAPIFactory::getInstance();
        $query = array(
            'include' => $ids,
        );
        return $cmsmediaapi->getMediaElements($query);
    }
}
