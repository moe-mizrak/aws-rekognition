<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * Structure containing details about the detected label, including the name, detected instances, parent labels, and level of confidence.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-label
 *
 * @class LabelData
 */
final class LabelData extends Data
{
    public function __construct(
        /*
         * Level of confidence.
         *
         * @param float|null
         */
        public ?float $confidence = null,

        /*
         * A list of potential aliases for a given label.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(AliasData::class)]
        public ?DataCollection $aliases = null,

        /*
         * A list of the categories associated with a given label.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(CategoryData::class)]
        public ?DataCollection $categories = null,

        /*
         * The name of the label.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(InstanceData::class)]
        public ?DataCollection $instances = null,

        /*
         * The name (label) of the object or scene.
         *
         * @param string|null
         */
        public ?string $name = null,

        /*
         * The parent labels for a label. The response includes all ancestor labels.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(ParentData::class)]
        public ?DataCollection $parents = null,
    ) {}
}