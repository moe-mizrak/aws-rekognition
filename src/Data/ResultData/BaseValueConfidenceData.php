<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * BaseValueConfidenceData is the base class for the data classes that have a value and confidence level.
 *
 * @class BaseValueConfidenceData
 */
abstract class BaseValueConfidenceData extends Data
{
    public function __construct(
        /*
         * Level of confidence in the determination.
         *
         * @param float|null
         */
        public ?float $confidence = null,

        /*
         * Boolean value that specifies whether the attribute is present in the face.
         *
         * @param bool|null
         */
        public ?bool $value = null,
    ) {}
}