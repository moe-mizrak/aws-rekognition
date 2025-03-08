<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use MoeMizrak\Rekognition\Data\Contracts\RekognitionDataFormatInterface;
use Spatie\LaravelData\Data;

/**
 * ListFacesData is for listFaces request.
 * For more detail: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#listfaces
 *
 * @class ListFacesData
 */
final class ListFacesData extends Data implements RekognitionDataFormatInterface
{
    public function __construct(
        /*
         * The ID of an existing collection containing the faces.
         *
         * @param string
         */
        public string $collectionId,

        /*
         * An array of user ids to filter results with when listing faces in a collection.
         *
         * @param string|null
         */
        public ?string $userId = null,

        /*
         * An array of face ids to filter results with when listing faces in a collection.
         *
         * @param array|null
         */
        public ?array $faceIds = null,

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
                'UserId'       => $this->userId,
                'FaceIds'      => $this->faceIds,
                'MaxResults'   => $this->maxResults,
                'NextToken'    => $this->nextToken,
            ],
            fn ($value) => $value !== null
        );
    }
}