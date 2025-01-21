<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use MoeMizrak\Rekognition\Data\Contracts\RekognitionDataFormatInterface;
use Spatie\LaravelData\Data;

/**
 * Contains filters for the object labels returned by DetectLabels. Filters can be inclusive, exclusive, or a combination of both and can be applied to individual labels or entire label categories.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-generallabelssettings
 * To see a list of label categories: https://docs.aws.amazon.com/rekognition/latest/dg/labels.html
 *
 * @class GeneralLabelsSettingsData
 */
final class GeneralLabelsSettingsData extends Data implements RekognitionDataFormatInterface
{
    public function __construct(
        /*
         * The label categories that should be excluded from the return from DetectLabels.
         *
         * @param array|null
         */
        public ?array $labelCategoryExclusionFilters = null,

        /*
         * The label categories that should be included in the return from DetectLabels.
         *
         * @param array|null
         */
        public ?array $labelCategoryInclusionFilters = null,

        /*
         * The labels that should be excluded from the return from DetectLabels.
         *
         * @param array|null
         */
        public ?array $labelExclusionFilters = null,

        /*
         * The labels that should be included in the return from DetectLabels.
         *
         * @param array|null
         */
        public ?array $labelInclusionFilters = null,
    ) {}

    /**
     * @inheritDoc
     */
    public function toRekognitionDataFormat(): array
    {
        return array_filter(
            [
                'LabelCategoryExclusionFilters' => $this->labelCategoryExclusionFilters,
                'LabelCategoryInclusionFilters' => $this->labelCategoryInclusionFilters,
                'LabelExclusionFilters'         => $this->labelExclusionFilters,
                'LabelInclusionFilters'         => $this->labelInclusionFilters,
            ],
            fn ($value) => $value !== null
        );
    }
}