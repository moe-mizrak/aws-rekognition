<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use JetBrains\PhpStorm\ExpectedValues;
use MoeMizrak\Rekognition\Data\Contracts\RekognitionDataFormatInterface;
use Spatie\LaravelData\Data;

/**
 * IndexFacesData is for the data of the Rekognition API indexFaces request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#indexfaces
 *
 * @class IndexFacesData
 */
final class IndexFacesData extends Data implements RekognitionDataFormatInterface
{
    public function __construct(
        /*
         * The ID of an existing collection to which you want to add the faces that are detected in the input images.
         *
         * @param string
         */
        public string $collectionId,

        /*
         * The input image as base64-encoded bytes or an S3 object.
         *
         * @param ImageData
         */
        public ImageData $image,

        /*
         * The maximum number of faces to index.
         * The value of MaxFaces must be greater than or equal to 1
         * Note: IndexFaces returns no more than 100 detected faces in an image, even if you specify a larger value for MaxFaces.
         *
         * @param int|null
         */
        public ?int $maxFaces = null,

        /*
         * The ID you want to assign to all the faces detected in the image.
         *
         * @param string|null
         */
        public ?string $externalImageId = null,

        /*
         * A filter that specifies a quality bar for how much filtering is done to identify faces.
         * Filtered faces aren't indexed.
         * If you specify AUTO, Amazon Rekognition chooses the quality bar.
         * If you specify LOW, MEDIUM, or HIGH, filtering removes all faces that don’t meet the chosen quality bar.
         * If you specify NONE, no filtering is performed.
         *
         * @param string|null
         */
        #[ExpectedValues(['NONE', 'AUTO', 'LOW', 'MEDIUM', 'HIGH'])]
        public ?string $qualityFilter = null,

        /*
         * An array of facial attributes you want to be returned.
         * A DEFAULT subset of facial attributes - BoundingBox, Confidence, Pose, Quality, and Landmarks - will always be returned.
         * You can request for all facial attributes by using ["ALL"].
         * Note: Requesting more attributes may increase response time.
         *
         * @param array|null
         */
        public ?array $detectionAttributes = null,
    ) {}


    /**
     * @inheritDoc
     */
    public function toRekognitionDataFormat(): array
    {
        return array_filter(
            [
                'CollectionId'        => $this->collectionId,
                'Image'               => $this->image->toRekognitionDataFormat(),
                'MaxFaces'            => $this->maxFaces,
                'ExternalImageId'     => $this->externalImageId,
                'QualityFilter'       => $this->qualityFilter,
                'DetectionAttributes' => $this->detectionAttributes,
            ],
            fn($value) => $value !== null
        );
    }
}