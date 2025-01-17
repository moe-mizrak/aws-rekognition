<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * Information about the properties of an image’s foreground, including the foreground’s quality and dominant colors, including the quality and dominant colors of the image.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-detectlabelsimageforeground
 *
 * @class ForegroundData
 */
final class ForegroundData extends Data
{
    public function __construct(
        /*
         * A description of the dominant colors in an image.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(DominantColorsData::class)]
        public ?DataCollection $dominantColors = null,

        /*
         * The quality of the image foreground as defined by brightness and sharpness.
         *
         * @param QualityData|null
         */
        public ?QualityData $quality = null,
    ) {}
}