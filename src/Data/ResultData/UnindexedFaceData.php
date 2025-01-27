<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * An array of faces that were detected in the image but weren't indexed. They weren't indexed because the quality filter identified them as low quality,
 * or the MaxFaces request parameter filtered them out. To use the quality filter, you specify the QualityFilter request parameter.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#indexfaces
 *
 * @class UnindexedFaceData
 */
final class UnindexedFaceData extends Data
{
    public function __construct(
        /*
         * The structure that contains attributes of a face that IndexFaces detected, but didn't index.
         *
         * @param FaceDetailData|null
         */
        public ?FaceDetailData $faceDetail = null,

        /*
         * An array of reasons that specify why a face wasn't indexed.
         * Such as: EXCEEDS_MAX_FACES, EXTREME_POSE, LOW_BRIGHTNESS, LOW_SHARPNESS, LOW_CONFIDENCE, SMALL_BOUNDING_BOX
         *
         * @param array|null
         */
        public ?array $reasons = null,
    ) {}
}