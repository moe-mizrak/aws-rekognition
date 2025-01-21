<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use MoeMizrak\Rekognition\Data\Contracts\RekognitionDataFormatInterface;
use Spatie\LaravelData\Data;

/**
 * CreateCollectionData is for the data of the Rekognition API createCollection request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#createcollection
 *
 * @class CreateCollectionData
 */
final class CreateCollectionData extends Data implements RekognitionDataFormatInterface
{
    public function __construct(
        /*
         * ID for the collection that you are creating.
         *
         * @param string
         */
        public string $collectionId,

        /*
         * A set of tags (key-value pairs) that you want to attach to the collection.
         * - Associative array of custom strings keys (TagKey) to strings
         *
         * @param array|null
         */
        public ?array $tags = null,
    ) {}

    /**
     * @inheritDoc
     */
    public function toRekognitionDataFormat(): array
    {
        return array_filter(
            [
                'CollectionId' => $this->collectionId,
                'Tags'         => $this->tags,
            ],
            fn ($value) => $value !== null
        );
    }
}