<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * Face details inferred from the image but not used for search.
 * The response attribute contains reasons for why a face wasn't used for the search.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-unsearchedface
 *
 * @class UnsearchedFaceData
 */
final class UnsearchedFaceData extends Data
{
    public function __construct(
        /*
         * Structure containing attributes of the face that the algorithm detected.
         * Note: Although same field in different operations are 'faceDetail', here it is 'faceDetails' (plural).
         *
         * @param FaceDetailData|null
         */
        public ?FaceDetailData $faceDetail = null,

        /*
         * Reasons why a face wasn't used for the search.
         *
         * @param array|null
         */
        public ?array $reasons = null,
    ) {}
}