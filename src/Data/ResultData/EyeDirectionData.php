<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * Indicates the direction the eyes are gazing in (independent of the head pose) as determined by its pitch and yaw.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-eyedirection
 *
 * @class EyeDirectionData
 */
final class EyeDirectionData extends Data
{
    public function __construct(
        /*
         * The confidence that the service has in its predicted eye direction.
         *
         * @param float|null
         */
        public ?float $confidence = null,

        /*
         * Value representing eye direction on the yaw axis.
         *
         * @param float|null
         */
        public ?float $yaw = null,

        /*
         * Value representing eye direction on the pitch axis.
         *
         * @param float|null
         */
        public ?float $pitch = null,
    ) {}
}