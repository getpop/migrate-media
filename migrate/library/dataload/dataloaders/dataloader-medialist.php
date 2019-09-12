<?php
namespace PoP\Media;

class Dataloader_MediaList extends Dataloader_MediaListBase
{
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

    public function executeQueryIds($query)
    {
        $options = [
            'return-type' => POP_RETURNTYPE_IDS,
        ];
        return $this->executeQuery($query, $options);
    }
}


