<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * The category that applies to a given label.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-labelcategory
 *
 * @class CategoryData
 */
final class CategoryData extends Data
{
    public function __construct(
        /*
         * The name of a category that applies to a given label.
         *
         * @param string|null
         */
        public ?string $name = null,
    ) {}
}