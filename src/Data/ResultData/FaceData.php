<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * Describes the face properties such as the bounding box, face ID, image ID of the input image, and external image ID that you assigned.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-face
 *
 * @class FaceData
 */
final class FaceData extends Data
{
    public function __construct(
        /*
         * Confidence level that the bounding box contains a face (and not a different object such as a tree).
         *
         * @param float|null
         */
        public ?float $confidence = null,

        /*
         * Bounding box of the face.
         *
         * @param BoundingBoxData|null
         */
        public ?BoundingBoxData $boundingBox = null,

        /*
         * Unique identifier that Amazon Rekognition assigns to the face.
         *
         * @param string|null
         */
        public ?string $faceId = null,

        /*
         * Unique identifier that Amazon Rekognition assigns to the input image.
         *
         * @param string|null
         */
        public ?string $imageId = null,

        /*
         * Unique identifier assigned to the user.
         *
         * @param string|null
         */
        public ?string $userId = null,

        /*
         * Identifier that you assign to all the faces in the input image.
         *
         * @param string|null
         */
        public ?string $externalImageId = null,

        /*
         * The version of the face detect and storage model that was used when indexing the face vector.
         *
         * @param string|null
         */
        public ?string $indexFacesModelVersion = null,
    ) {}
}