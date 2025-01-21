<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use MoeMizrak\Rekognition\Data\Contracts\RekognitionDataFormatInterface;
use Spatie\LaravelData\Data;

/**
 * DeleteCollectionData is for the data of the Rekognition API deleteCollection request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#deletecollection
 *
 * @class DeleteCollectionData
 */
final class DeleteCollectionData extends Data implements RekognitionDataFormatInterface
{
    public function __construct(
        /*
         * The ID of the collection to delete.
         *
         * @param string
         */
        public string $collectionId,
    ) {}

    /**
     * @inheritDoc
     */
    public function toRekognitionDataFormat(): array
    {
        return [
            'CollectionId' => $this->collectionId,
        ];
    }
}