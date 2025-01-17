<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * The quality of an image provided for label detection, with regard to brightness, sharpness, and contrast.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-detectlabelsimagequality
 *
 * @class QualityData
 */
final class QualityData extends Data
{
    public function __construct(
        /*
         * The brightness of an image provided for label detection.
         *
         * @param float|null
         */
        public ?float $brightness = null,

        /*
         * The contrast of an image provided for label detection.
         *
         * @param float|null
         */
        public ?float $contrast = null,

        /*
         * The sharpness of an image provided for label detection.
         *
         * @param float|null
         */
        public ?float $sharpness = null,
    ) {}
}