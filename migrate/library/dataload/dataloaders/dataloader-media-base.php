<?php
namespace PoP\Media;

abstract class Dataloader_MediaBase extends \PoP\ComponentModel\QueryDataDataloader
{
    public function getDatabaseKey()
    {
        return GD_DATABASE_KEY_MEDIA;
    }

    public function getFieldValueResolverClass(): string
    {
        return FieldValueResolver_Media::class;
    }

    public function executeGetData(array $ids)
    {
        if ($ids) {
            $cmsmediaapi = \PoP\Media\FunctionAPIFactory::getInstance();
            $query = array(
                'include' => $ids,
            );
            return $cmsmediaapi->getMediaElements($query);
        }

        return [];
    }
}
