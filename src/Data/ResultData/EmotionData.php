<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use JetBrains\PhpStorm\ExpectedValues;
use Spatie\LaravelData\Data;

/*
 * The emotions that appear to be expressed on the face, and the confidence level in the determination.
 * The API is only making a determination of the physical appearance of a person's face.
 * It is not a determination of the person’s internal emotional state and should not be used in such a way.
 * For example, a person pretending to have a sad face might not be sad emotionally.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-emotion
 *
 * @class EmotionData
 */
final class EmotionData extends Data
{
    public function __construct(
        /*
         * Level of confidence in the determination.
         *
         * @param float|null
         */
        public ?float $confidence = null,

        /*
         * Type of emotion detected.
         *
         * @param string|null
         */
        #[ExpectedValues([
            'HAPPY', 'SAD', 'ANGRY', 'CONFUSED', 'DISGUSTED',
            'SURPRISED', 'CALM', 'UNKNOWN', 'FEAR',
        ])]
        public ?string $type = null,
    ) {}
}