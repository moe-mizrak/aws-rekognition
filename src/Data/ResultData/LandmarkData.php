<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use JetBrains\PhpStorm\ExpectedValues;
use Spatie\LaravelData\Data;

/**
 * Indicates the location of landmarks on the face. Default attribute.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-landmark
 *
 * @class LandmarkData
 */
final class LandmarkData extends Data
{
    public function __construct(
        /*
         * Type of the landmark.
         *
         * @param string|null
         */
        #[ExpectedValues([
            'eyeLeft', 'eyeRight', 'nose', 'mouthLeft', 'mouthRight',
            'leftEyeBrowLeft', 'leftEyeBrowRight', 'leftEyeBrowUp',
            'rightEyeBrowLeft', 'rightEyeBrowRight', 'rightEyeBrowUp',
            'leftEyeLeft', 'leftEyeRight', 'leftEyeUp', 'leftEyeDown',
            'rightEyeLeft', 'rightEyeRight', 'rightEyeUp', 'rightEyeDown',
            'noseLeft', 'noseRight', 'mouthUp', 'mouthDown',
            'leftPupil', 'rightPupil', 'upperJawlineLeft', 'midJawlineLeft',
            'chinBottom', 'midJawlineRight', 'upperJawlineRight'
        ])]
        public ?string $type = null,

        /*
         * The x-coordinate of the landmark expressed as a ratio of the width of the image.
         *
         * @param float|null
         */
        public ?float $x = null,

        /*
         * The y-coordinate of the landmark expressed as a ratio of the height of the image.
         *
         * @param float|null
         */
        public ?float $y = null,
    ) {}
}