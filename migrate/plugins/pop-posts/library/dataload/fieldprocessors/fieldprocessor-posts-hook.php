<?php
namespace PoP\Media;
use PoP\Translation\Facades\TranslationAPIFacade;

class FieldValueResolver_Posts extends \PoP\ComponentModel\AbstractDBDataFieldValueResolver
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

    public function getFieldDocumentationType(string $fieldName): ?string
    {
        $types = [
			'has-featuredimage' => TYPE_BOOL,
            'featuredimage' => TYPE_ID,
            'featuredimage-props' => TYPE_OBJECT,
        ];
        return $types[$fieldName];
    }

    public function getFieldDocumentationDescription(string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'has-featuredimage' => $translationAPI->__('Does the post have a featured image?', 'pop-media'),
            'featuredimage' => $translationAPI->__('ID of the featured image DB object', 'pop-media'),
            'featuredimage-props' => $translationAPI->__('Properties (url, width and height) of the featured image', 'pop-media'),
        ];
        return $descriptions[$fieldName];
    }

    public function getValue($fieldResolver, $resultitem, string $fieldName, array $fieldArgs = [])
    {
        $cmsmediapostsapi = \PoP\Media\PostsFunctionAPIFactory::getInstance();
        $post = $resultitem;
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

        return parent::getValue($fieldResolver, $resultitem, $fieldName, $fieldArgs);
    }

    public function getFieldDocumentationArgs(string $fieldName): ?array
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        switch ($fieldName) {
            case 'featuredimage-props':
                return [
                    [
                        'name' => 'size',
                        'type' => TYPE_STRING,
                        'description' => $translationAPI->__('Size of the image', 'pop-media'),
                    ],
                ];
        }

        return parent::getFieldDocumentationArgs($fieldName);
    }

    public function getFieldDefaultDataloaderClass(string $fieldName, array $fieldArgs = []): ?string
    {
        switch ($fieldName) {
            case 'featuredimage':
                return \PoP\Media\Dataloader_MediaList::class;
        }

        return parent::getFieldDefaultDataloaderClass($fieldName, $fieldArgs);
    }
}

// Static Initialization: Attach
FieldValueResolver_Posts::attach(POP_ATTACHABLEEXTENSIONGROUP_FIELDVALUERESOLVERUNITS);
