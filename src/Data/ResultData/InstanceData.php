<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * An instance of a label returned by Amazon Rekognition Image (DetectLabels) or by Amazon Rekognition Video (GetLabelDetection).
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-instance
 *
 * @class InstanceData
 */
final class InstanceData extends Data
{
    public function __construct(
        /*
         * The confidence that Amazon Rekognition has in the accuracy of the bounding box.
         *
         * @param float|null
         */
        public ?float $confidence = null,

        /*
         * The position of the label instance on the image.
         *
         * @param BoundingBoxData|null
         */
        public ?BoundingBoxData $boundingBox = null,

        /*
         * The dominant colors found in an individual instance of a label.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(DominantColorsData::class)]
        public ?DataCollection $dominantColors = null,
    ) {}
}