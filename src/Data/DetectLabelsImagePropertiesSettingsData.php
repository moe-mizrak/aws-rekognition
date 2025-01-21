<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use MoeMizrak\Rekognition\Data\Contracts\RekognitionDataFormatInterface;
use Spatie\LaravelData\Data;

/**
 * DetectLabelsImagePropertiesSettingsData is settings for the IMAGE_PROPERTIES feature type.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-detectlabelsimagepropertiessettings
 *
 * @class DetectLabelsImagePropertiesSettingsData
 */
final class DetectLabelsImagePropertiesSettingsData extends Data implements RekognitionDataFormatInterface
{
    public function __construct(
        /*
         * The maximum number of dominant colors to return when detecting labels in an image.
         * The default value is 10.
         *
         * @param int|null
         */
        public ?int $maxDominantColors = null,
    ) {}

    /**
     * @inheritDoc
     */
    public function toRekognitionDataFormat(): array
    {
        return array_filter(
            [
                'MaxDominantColors' => $this->maxDominantColors,
            ],
            fn ($value) => $value !== null
        );
    }
}