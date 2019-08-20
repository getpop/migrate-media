<?php
namespace PoP\Media;

class FieldValueResolver_Posts_Unit extends \PoP\Engine\AbstractDBDataFieldValueResolverUnit
{
    public static function getClassesToAttachTo()
    {
        return array(\PoP\Posts\FieldValueResolver_Posts::class);
    }

    public function getValue($fieldValueResolver, $resultitem, string $fieldName, array $fieldArgs = [])
    {
        $cmsmediapostsapi = \PoP\Media\PostsFunctionAPIFactory::getInstance();
        $post = $resultitem;
        switch ($fieldName) {
            case 'has-thumb':
                return $cmsmediapostsapi->hasPostThumbnail($fieldValueResolver->getId($post));

            case 'featuredimage':
                return $cmsmediapostsapi->getPostThumbnailId($fieldValueResolver->getId($post));

            case 'featuredimage-props':
                if ($image_id = $cmsmediapostsapi->getPostThumbnailId($fieldValueResolver->getId($post))) {
                    $size = $fieldArgs['size'];
                    return Utils::getAttachmentImageProperties($image_id, $size);
                }
                return null;
        }

        return parent::getValue($fieldValueResolver, $resultitem, $fieldName, $fieldArgs);
    }
}

// Static Initialization: Attach
FieldValueResolver_Posts_Unit::attach();
