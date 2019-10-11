<?php
namespace PoP\Media;
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\FieldValueResolvers\AbstractDBDataFieldValueResolver;

class FieldValueResolver_Posts extends AbstractDBDataFieldValueResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(\PoP\Posts\FieldResolver_Posts::class);
    }

    public function getFieldNamesToResolve(): array
    {
        return [
            'has-featuredimage',
            'featuredimage',
            'featuredimage-props',
        ];
    }

    public function getFieldDocumentationType($fieldResolver, string $fieldName): ?string
    {
        $types = [
			'has-featuredimage' => SchemaDefinition::TYPE_BOOL,
            'featuredimage' => SchemaDefinition::TYPE_ID,
            'featuredimage-props' => SchemaDefinition::TYPE_OBJECT,
        ];
        return $types[$fieldName] ?? parent::getFieldDocumentationType($fieldResolver, $fieldName);
    }

    public function getFieldDocumentationDescription($fieldResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'has-featuredimage' => $translationAPI->__('Does the post have a featured image?', 'pop-media'),
            'featuredimage' => $translationAPI->__('ID of the featured image DB object', 'pop-media'),
            'featuredimage-props' => $translationAPI->__('Properties (url, width and height) of the featured image', 'pop-media'),
        ];
        return $descriptions[$fieldName] ?? parent::getFieldDocumentationDescription($fieldResolver, $fieldName);
    }

    public function resolveValue($fieldResolver, $resultItem, string $fieldName, array $fieldArgs = [])
    {
        $cmsmediapostsapi = \PoP\Media\PostsFunctionAPIFactory::getInstance();
        $post = $resultItem;
        switch ($fieldName) {
            case 'has-featuredimage':
                return $cmsmediapostsapi->hasPostThumbnail($fieldResolver->getId($post));

            case 'featuredimage':
                return $cmsmediapostsapi->getPostThumbnailId($fieldResolver->getId($post));

            case 'featuredimage-props':
                if ($image_id = $cmsmediapostsapi->getPostThumbnailId($fieldResolver->getId($post))) {
                    return Utils::getAttachmentImageProperties($image_id, $fieldArgs['size']);
                }
                return null;
        }

        return parent::resolveValue($fieldResolver, $resultItem, $fieldName, $fieldArgs);
    }

    public function getFieldDocumentationArgs($fieldResolver, string $fieldName): array
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        switch ($fieldName) {
            case 'featuredimage-props':
                return [
                    [
                        'name' => 'size',
                        'type' => SchemaDefinition::TYPE_STRING,
                        'description' => $translationAPI->__('Size of the image', 'pop-media'),
                    ],
                ];
        }

        return parent::getFieldDocumentationArgs($fieldResolver, $fieldName);
    }

    public function resolveFieldDefaultDataloaderClass($fieldResolver, string $fieldName, array $fieldArgs = []): ?string
    {
        switch ($fieldName) {
            case 'featuredimage':
                return \PoP\Media\Dataloader_MediaList::class;
        }

        return parent::resolveFieldDefaultDataloaderClass($fieldResolver, $fieldName, $fieldArgs);
    }
}

// Static Initialization: Attach
FieldValueResolver_Posts::attach(\PoP\ComponentModel\AttachableExtensions\AttachableExtensionGroups::FIELDVALUERESOLVERS);
