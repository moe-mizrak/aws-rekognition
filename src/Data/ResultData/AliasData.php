<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * A potential alias of for a given label.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-labelalias
 *
 * @class LabelData
 */
final class AliasData extends Data
{
    public function __construct(
        /*
         * The name of an alias for a given label.
         *
         * @param string|null
         */
        public ?string $name = null,
    ) {}
}