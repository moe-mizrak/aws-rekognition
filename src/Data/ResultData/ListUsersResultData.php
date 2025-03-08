<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * ListUsersResultData is for the result of the Rekognition API listUsers request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#listusers
 *
 * @class ListUsersResultData
 */
final class ListUsersResultData extends Data
{
    public function __construct(
        /*
         * A collection of users which consists of the user id and user status.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(MatchedUserData::class)]
        public ?DataCollection $users = null,

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