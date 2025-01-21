<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * ListCollectionsResultData is for the result of the Rekognition API listCollections request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#listcollections
 *
 * @class ListCollectionsResultData
 */
final class ListCollectionsResultData extends Data
{
    public function __construct(
        /*
         * An array of collection IDs.
         *
         * @param array|null
         */
        public ?array $collectionIds = null,

        /*
         * Version numbers of the face detection models associated with the collections in the array CollectionIds.
         * For example, the value of FaceModelVersions[2] is the version number for the face detection model used by the collection in CollectionId[2].
         *
         * @param string|null
         */
        public ?array $faceModelVersions = null,

        /*
         * If the result is truncated, the response provides a NextToken that you can use in the subsequent request to fetch the next set of collection IDs.
         *
         * @param string|null
         */
        public ?string $nextToken = null,

        /*
         * Metadata about the request.
         *
         * @param MetaData|null
         */
        public ?MetaData $metadata = null,
    ) {}
}