<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * ResultData is for the result of the Rekognition API detectLabels request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#detectlabels
 *
 * @class ResultData
 */
final class ResultData extends Data
{
    public function __construct(
        /*
         * An array of labels for the real-world objects detected.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(LabelData::class)]
        public ?DataCollection $labels = null,

        /*
         * Version number of the label detection model that was used to detect labels.
         *
         * @param string|null
         */
        public ?string $LabelModelVersion = null,

        /*
         * The value of orientationCorrection is always null.
         * If the input image is in .jpeg format, it might contain exchangeable image file format (Exif) metadata that includes the image's orientation.
         * Amazon Rekognition uses this orientation information to perform image correction.
         * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#detectlabels
         *
         * @param string|null
         */
        public ?string $orientationCorrection = null,

        /*
         * Information about the properties of the input image, such as brightness, sharpness, contrast, and dominant colors.
         *
         * @param ImagePropertiesData|null
         */
        public ?ImagePropertiesData $imageProperties = null,

        /*
         * Metadata about the request.
         *
         * @param MetaData|null
         */
        public ?MetaData $metadata = null,
    ) {}
}