<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use MoeMizrak\Rekognition\Data\Contracts\RekognitionDataFormatInterface;
use Spatie\LaravelData\Data;

/**
 * Searches for userIds using a supplied image.
 * It first detects the largest face in the image, and then searches a specified collection for matching userIds.
 * For more detail: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#searchusersbyimage
 *
 * @class SearchFacesByImageData
 */
final class SearchFacesByImageData extends Data implements RekognitionDataFormatInterface
{
    public function __construct(
        /*
         * The id of an existing collection containing the face.
         *
         * @param string
         */
        public string $collectionId,

        /*
         * Provides the input image either as bytes or an S3 object.
         *
         * @param ImageData
         */
        public ImageData $image,

        /*
         * Maximum number of faces to return.
         *
         * @param int|null
         */
        public ?int $maxFaces = null,

        /*
         * Specifies the minimum confidence in the face match to return.
         * Note: Default value is 80.
         *
         * @param float|null
         */
        public ?float $faceMatchThreshold = null,

        /*
         * A filter that specifies a quality bar for how much filtering is done to identify faces.
         * Filtered faces aren't searched for in the collection.
         * Note: The default value is NONE.
         *
         * @param string|null
         */
        public ?string $qualityFilter = null,
    ) {}

    /**
     * @inheritDoc
     */
    public function toRekognitionDataFormat(): array
    {
        return array_filter(
            [
                'CollectionId'       => $this->collectionId,
                'Image'              => $this->image->toRekognitionDataFormat(),
                'MaxFaces'           => $this->maxFaces,
                'FaceMatchThreshold' => $this->faceMatchThreshold,
                'QualityFilter'      => $this->qualityFilter,
            ],
            fn($value) => $value !== null
        );
    }
}