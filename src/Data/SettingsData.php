<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use MoeMizrak\Rekognition\Data\Contracts\RekognitionDataFormatInterface;
use Spatie\LaravelData\Data;

/**
 * SettingsData is for a list of the filters to be applied to returned detected labels and image properties.
 * Specified filters can be inclusive, exclusive, or a combination of both.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-detectlabelssettings
 *
 * @class SettingsData
 */
final class SettingsData extends Data implements RekognitionDataFormatInterface
{
    public function __construct(
        /*
         * Contains the specified filters when feature = GENERAL_LABELS in DetectLabelsData.
         *
         * @param GeneralLabelsSettingsData|null
         */
        public ?GeneralLabelsSettingsData $generalLabels = null,

        /*
         * Contains the chosen number of maximum dominant colors in an image when feature = IMAGE_PROPERTIES in DetectLabelsData
         *
         * @param DetectLabelsImagePropertiesSettingsData|null
         */
        public ?DetectLabelsImagePropertiesSettingsData $imageProperties = null
    ) {}

    /**
     * @inheritDoc
     */
    public function toRekognitionDataFormat(): array
    {
        return array_filter(
            [
                'GeneralLabels'   => $this->generalLabels?->toRekognitionDataFormat(),
                'ImageProperties' => $this->imageProperties?->toRekognitionDataFormat(),
            ],
            fn ($value) => $value !== null
        );
    }
}