<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * The dominant colors found in the background of an image, defined with RGB values, CSS color name, simplified color name, and PixelPercentage (the percentage of image pixels that have a particular color).
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-dominantcolor
 *
 * @class DominantColorsData
 */
final class DominantColorsData extends Data
{
    public function __construct(
        /*
         * The Blue RGB value for a dominant color.
         *
         * @param int|null
         */
        public ?int $blue = null,

        /*
         * The CSS color name of a dominant color.
         *
         * @param string|null
         */
        public ?string $cssColor = null,

        /*
         * The Green RGB value for a dominant color.
         *
         * @param int|null
         */
        public ?int $green = null,

        /*
         * The Hex code equivalent of the RGB values for a dominant color.
         *
         * @param string|null
         */
        public ?string $hexCode = null,

        /*
         * The percentage of image pixels that have a given dominant color.
         *
         * @param float|null
         */
        public ?float $pixelPercent = null,

        /*
         * The Red RGB value for a dominant color.
         *
         * @param int|null
         */
        public ?int $red = null,

        /*
         * One of 12 simplified color names applied to a dominant color.
         *
         * @param string|null
         */
        public ?string $simplifiedColor = null,
    ) {}
}