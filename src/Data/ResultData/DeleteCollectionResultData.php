<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * DeleteCollectionResultData is for the result of the Rekognition API deleteCollection request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#deletecollection
 *
 * @class DeleteCollectionResultData
 */
final class DeleteCollectionResultData extends Data
{
    public function __construct(
        /*
         * HTTP status code that indicates the result of the operation.
         *
         * @param int|null
         */
        public ?int $statusCode = null,

        /*
         * Metadata about the request.
         *
         * @param MetaData|null
         */
        public ?MetaData $metadata = null,
    ) {}
}