<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * UserResultData is for the result of the Rekognition API createUser request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#createuser
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#deleteuser
 *
 * @class UserResultData
 */
final class UserResultData extends Data
{
    public function __construct(
        /*
         * Metadata about the request.
         *
         * @param MetaData|null
         */
        public ?MetaData $metadata = null,
    ) {}
}