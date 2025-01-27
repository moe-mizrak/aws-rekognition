<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * Object containing both the face metadata (stored in the backend database),
 * and facial attributes that are detected but aren't stored in the database.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-facerecord
 *
 * @class FaceRecordData
 */
final class FaceRecordData extends Data
{
    public function __construct(
        /*
         * Describes the face properties such as the bounding box, face ID, image ID of the input image, and external image ID that you assigned.
         *
         * @param FaceData|null
         */
        public ?FaceData $face = null,

        /*
         * Structure containing attributes of the face that the algorithm detected.
         *
         * @param FaceDetailData|null
         */
        public ?FaceDetailData $faceDetail = null,
    ) {}
}