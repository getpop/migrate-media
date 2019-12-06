<?php
namespace PoP\Media;
use PoP\ComponentModel\TypeDataResolvers\AbstractTypeQueryableDataResolver;

class Dataloader_MediaList extends AbstractTypeQueryableDataResolver
{
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
    
    public function getDataFromIdsQuery(array $ids): array
    {
        $query = array();
        $query['include'] = $ids;
        // $query['post-status'] = [
        //     POP_POSTSTATUS_PUBLISHED,
        // ];
        $query['post-types'] = 'attachment';

        return $query;
    }

    public function executeQuery($query, array $options = [])
    {
        $cmsmediaapi = \PoP\Media\FunctionAPIFactory::getInstance();
        return $cmsmediaapi->getMediaElements($query, $options);
    }

    public function executeQueryIds($query): array
    {
        $options = [
            'return-type' => POP_RETURNTYPE_IDS,
        ];
        return (array)$this->executeQuery($query, $options);
    }
}


