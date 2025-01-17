<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * A parent label for a label. A label can have 0, 1, or more parents.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-parent
 *
 * @class ParentData
 */
final class ParentData extends Data
{
    public function __construct(
        /*
         * The name of the parent label.
         *
         * @param string|null
         */
        public ?string $name = null,
    ) {}
}