<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * Indicates the pose of the face as determined by its pitch, roll, and yaw.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-pose
 *
 * @class PoseData
 */
final class PoseData extends Data
{
    public function __construct(
        /*
         * Value representing the face rotation on the roll axis.
         *
         * @param float|null
         */
        public ?float $roll = null,

        /*
         * Value representing the face rotation on the yaw axis.
         *
         * @param float|null
         */
        public ?float $yaw = null,

        /*
         * Value representing the face rotation on the pitch axis.
         *
         * @param float|null
         */
        public ?float $pitch = null,
    ) {}
}