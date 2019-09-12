<?php
namespace PoP\Media;
use PoP\Translation\Facades\TranslationAPIFacade;

class FieldValueResolver_Media_Unit extends \PoP\ComponentModel\AbstractDBDataFieldValueResolverUnit
{
    public static function getClassesToAttachTo()
    {
        return array(\PoP\Media\FieldValueResolver_Media::class);
    }

    public function getFieldNamesToResolve(): array
    {
        return [
            'author',
            'src',
        ];
    }

    public function getFieldDocumentationType(string $fieldName): ?string
    {
        $types = [
			'author' => TYPE_ID,
            'src' => TYPE_STRING,
        ];
        return $types[$fieldName];
    }

    public function getFieldDocumentationDescription(string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'author' => $translationAPI->__('ID of the media element\'s author', 'pop-media'),
            'src' => $translationAPI->__('Media element URL source', 'pop-media'),
        ];
        return $descriptions[$fieldName];
    }

    public function getValue($fieldValueResolver, $resultitem, string $fieldName, array $fieldArgs = [])
    {
        $cmsmediaapi = \PoP\Media\FunctionAPIFactory::getInstance();
        $media = $resultitem;
        switch ($fieldName) {
            case 'author':
                return $cmsmediaapi->getMediaAuthorId($media);
            case 'src':
                $properties = Utils::getAttachmentImageProperties($fieldValueResolver->getId($media), $fieldArgs['size']);
                return $properties['src'];
        }

        return parent::getValue($fieldValueResolver, $resultitem, $fieldName, $fieldArgs);
    }

    public function getFieldDocumentationArgs(string $fieldName): ?array
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        switch ($fieldName) {
            case 'src':
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
            case 'author':
                return \PoP\Users\Dataloader_ConvertibleUserList::class;
        }

        return parent::getFieldDefaultDataloaderClass($fieldName, $fieldArgs);
    }
}

// Static Initialization: Attach
FieldValueResolver_Media_Unit::attach();
