<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * Structure containing the estimated age range, in years, for a face.
 * Amazon Rekognition estimates an age range for faces detected in the input image. Estimated age ranges can overlap.
 * A face of a 5-year-old might have an estimated range of 4-6, while the face of a 6-year-old might have an estimated range of 4-8.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-agerange
 *
 * @class AgeRangeData
 */
final class AgeRangeData extends Data
{
    public function __construct(
        /*
         * The lowest estimated age.
         *
         * @param int|null
         */
        public ?int $low = null,

        /*
         * The highest estimated age.
         *
         * @param int|null
         */
        public ?int $high = null,
    ) {}
}