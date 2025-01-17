<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * Information about the quality and dominant colors of an input image.
 * Quality and color information is returned for the entire image, foreground, and background.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-detectlabelsimageproperties
 *
 * @class ImagePropertiesData
 */
final class ImagePropertiesData extends Data
{
    public function __construct(
        /*
         * The background of the image with regard to image quality and dominant colors.
         *
         * @param BackgroundData|null
         */
        public ?BackgroundData $background = null,

        /*
         * Information about the dominant colors found in an image, described with RGB values, CSS color name, simplified color name, and PixelPercentage (the percentage of image pixels that have a particular color).
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(DominantColorsData::class)]
        public ?DataCollection $dominantColors = null,

        /*
         * The foreground of the image with regard to image quality and dominant colors.
         *
         * @param ForegroundData|null
         */
        public ?ForegroundData $foreground = null,

        /*
         * The quality of the image foreground as defined by brightness and sharpness.
         *
         * @param QualityData|null
         */
        public ?QualityData $quality = null,
    ) {}
}