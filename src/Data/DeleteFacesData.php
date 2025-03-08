<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use MoeMizrak\Rekognition\Data\Contracts\RekognitionDataFormatInterface;
use Spatie\LaravelData\Data;

/**
 * DeleteFacesData is for the data of the Rekognition API deleteFaces request.
 *
 * @class DeleteFacesData
 */
final class DeleteFacesData extends Data implements RekognitionDataFormatInterface
{
    public function __construct(
        /*
         * The ID of an existing collection where faces will be deleted.
         *
         * @var string
         */
        public string $collectionId,

        /*
         * An array of faceIds.
         *
         * @var array
         */
        public array $faceIds,
    ) {}

    /**
     * @inheritDoc
     */
    public function toRekognitionDataFormat(): array
    {
        return array_filter(
            [
                'CollectionId' => $this->collectionId,
                'FaceIds'      => $this->faceIds,
            ],
            fn($value) => $value !== null
        );
    }
}