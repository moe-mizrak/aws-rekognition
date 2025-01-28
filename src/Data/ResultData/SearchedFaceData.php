<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * Contains data regarding the input face used for a search.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-searchedfacedetails
 *
 * @class SearchedFaceData
 */
final class SearchedFaceData extends Data
{
    public function __construct(
        /*
         * Structure containing attributes of the face that the algorithm detected.
         *
         * @param FaceDetailData|null
         */
        public ?FaceDetailData $faceDetail = null,
    ) {}
}