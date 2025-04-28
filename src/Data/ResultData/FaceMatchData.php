<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * FaceMatchData is the DTO for the face match details returned by the Rekognition API.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#searchfacesbyimage
 *
 * @class FaceMatchData
 */
final class FaceMatchData extends Data
{
    public function __construct(
        /*
         * Details about the face that matched.
         *
         * @param FaceData|null
         */
        public ?FaceData $face = null,

        /*
         * Similarity score (0-100) between the input face and the matched face.
         *
         * @param float|null
         */
        public ?float $similarity = null,
    ) {}
}
