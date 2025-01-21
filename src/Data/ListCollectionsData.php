<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use MoeMizrak\Rekognition\Data\Contracts\RekognitionDataFormatInterface;
use Spatie\LaravelData\Data;

/**
 * ListCollectionsData is for listCollections method related context data such as maxResults and nextToken.
 * For more detail: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#listcollections
 *
 * @class ListCollectionsData
 */
final class ListCollectionsData extends Data implements RekognitionDataFormatInterface
{
    public function __construct(
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
                'MaxResults' => $this->maxResults,
                'NextToken'  => $this->nextToken,
            ],
            fn ($value) => $value !== null
        );
    }
}