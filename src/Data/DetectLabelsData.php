<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use Spatie\LaravelData\Data;

/**
 * DetectLabelsData is for detectLabels method related context data such as image, features, maxLabels, minConfidence and settings.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#detectlabels
 *
 * @class DetectLabelsData
 */
final class DetectLabelsData extends Data
{
    public function __construct(
        /*
         * The input image as base64-encoded bytes, image resource or an S3 object (Images stored in an S3 Bucket do not need to be base64-encoded).
         *
         * @param ImageData
         */
        public ImageData $image,

        /*
         * A list of the types of analysis to perform.
         * Specifying GENERAL_LABELS uses the label detection feature, while specifying IMAGE_PROPERTIES returns information regarding image color and quality.
         * default: GENERAL_LABELS
         *
         * @param array|null
         */
        public ?array $features = null,

        /*
         * Maximum number of labels you want the service to return in the response. The service returns the specified number of highest confidence labels.
         * Only valid when GENERAL_LABELS is specified as a feature type in the Feature input parameter.
         *
         * @param int|null
         */
        public ?int $maxLabels = null,

        /*
         * Specifies the minimum confidence level for the labels to return.
         * Amazon Rekognition doesn't return any labels with confidence lower than this specified value.
         * If MinConfidence is not specified, the operation returns labels with a confidence values greater than or equal to 55 percent.
         * Only valid when GENERAL_LABELS is specified as a feature type in the Feature input parameter.
         *
         * @param float|null
         */
        public ?float $minConfidence = null,

        /*
         * A list of the filters to be applied to returned detected labels and image properties.
         *
         * @param SettingsData|null
         */
        public ?SettingsData $settings = null
    ) {}

    /**
     * Convert the data to an AWS Rekognition array format, excluding null values.
     *
     * @return array
     */
    public function toRekognitionDataFormat(): array
    {
        return array_filter(
            [
                'Image'         => $this->image->toRekognitionDataFormat(),
                'Features'      => $this->features,
                'MaxLabels'     => $this->maxLabels,
                'MinConfidence' => $this->minConfidence,
                'Settings'      => $this->settings?->toRekognitionDataFormat(),
            ],
            fn ($value) => $value !== null
        );
    }
}