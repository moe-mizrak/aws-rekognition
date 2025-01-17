<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * Identifies the bounding box around the label, face, text, object of interest, or personal protective equipment.
 * The left (x-coordinate) and top (y-coordinate) are coordinates representing the top and left sides of the bounding box.
 * Note that the upper-left corner of the image is the origin (0,0).
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-boundingbox
 *
 * @class BoundingBoxData
 */
final class BoundingBoxData extends Data
{
    public function __construct(
        /*
         * Height of the bounding box as a ratio of the overall image height.
         *
         * @param float|null
         */
        public ?float $height = null,

        /*
         * Left coordinate of the bounding box as a ratio of overall image width.
         *
         * @param float|null
         */
        public ?float $left = null,

        /*
         * Top coordinate of the bounding box as a ratio of overall image height.
         *
         * @param float|null
         */
        public ?float $top = null,

        /*
         * Width of the bounding box as a ratio of the overall image width.
         *
         * @param float|null
         */
        public ?float $width = null,
    ) {}
}