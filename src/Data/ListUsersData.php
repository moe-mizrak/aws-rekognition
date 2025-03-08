<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use MoeMizrak\Rekognition\Data\Contracts\RekognitionDataFormatInterface;
use Spatie\LaravelData\Data;

/**
 * ListUsersData is for listUsers request.
 * For more detail: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#listusers
 *
 * @class ListUsersData
 */
final class ListUsersData extends Data implements RekognitionDataFormatInterface
{
    public function __construct(
        /*
         * The ID of an existing collection containing the users.
         *
         * @param string
         */
        public string $collectionId,

        /*
         * Maximum number of collection IDs to return.
         *
         * @param int|null
         */
        public ?int $maxResults = null,

        /*
         * Pagination token from the previous response.
         *
         * @param string|null
         */
        public ?string $nextToken = null,
    ) {}

    /**
     * @inheritDoc
     */
    public function toRekognitionDataFormat(): array
    {
        return array_filter(
            [
                'CollectionId' => $this->collectionId,
                'MaxResults' => $this->maxResults,
                'NextToken'  => $this->nextToken,
            ],
            fn ($value) => $value !== null
        );
    }
}