<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use JetBrains\PhpStorm\ExpectedValues;
use Spatie\LaravelData\Data;

/**
 * The predicted gender of a detected face.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-gender
 *
 * @class GenderData
 */
final class GenderData extends Data
{
    public function __construct(
        /*
         * Level of confidence in the prediction.
         *
         * @param float|null
         */
        public ?float $confidence = null,

        /*
         * The predicted gender of the face.
         * NOTE: Does NOT extend BaseValueConfidenceData because value is string here - not boolean as in BaseValueConfidenceData.
         *
         * @param string|null
         */
        #[ExpectedValues(['Male', 'Female'])]
        public ?string $value = null,
    ) {}
}