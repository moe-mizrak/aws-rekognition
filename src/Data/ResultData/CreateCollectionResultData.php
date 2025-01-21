<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * CreateCollectionResultData is for the result of the Rekognition API createCollection request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#createcollection
 *
 * @class CreateCollectionResultData
 */
final class CreateCollectionResultData extends Data
{
    public function __construct(
        /*
         * Amazon Resource Name (ARN) of the collection. You can use this to manage permissions on your resources.
         *
         * @param string|null
         */
        public ?string $collectionArn = null,

        /*
         * Version number of the face detection model associated with the collection you are creating.
         *
         * @param string|null
         */
        public ?string $faceModelVersion = null,

        /*
         * HTTP status code indicating the result of the operation.
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