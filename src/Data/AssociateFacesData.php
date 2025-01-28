<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use MoeMizrak\Rekognition\Data\Contracts\RekognitionDataFormatInterface;
use Spatie\LaravelData\Data;

/**
 * Associates one or more faces with an existing userId. Takes an array of faceIds. Each faceId that are present in the faceIds list is associated with the provided userId.
 * Note: The maximum number of total faceIds per userId is 100.
 *
 * @class AssociateFacesData
 */
final class AssociateFacesData extends Data implements RekognitionDataFormatInterface
{
    public function __construct(
        /*
         * The ID of an existing collection containing the userId.
         *
         * @var string
         */
        public string $collectionId,

        /*
         * An array of faceIds to associate with the userId.
         *
         * @var array
         */
        public array $faceIds,

        /*
         * The id for the existing userId.
         *
         * @var string
         */
        public string $userId,

        /*
         * An optional value specifying the minimum confidence in the userId match to return.
         * Note: The default value is 75.
         *
         * @var float|null
         */
        public ?float $userMatchThreshold = null,

        /*
         * Idempotent token used to identify the request to associateFaces.
         * Note: If you use the same token with multiple AssociateFaces requests, the same response is returned.
         * Use clientRequestToken to prevent the same request from being processed more than once.
         *
         * @var string|null
         */
        public ?string $clientRequestToken = null,
    ) {}


    /**
     * @inheritDoc
     */
    public function toRekognitionDataFormat(): array
    {
        return array_filter(
            [
                'CollectionId'       => $this->collectionId,
                'FaceIds'            => $this->faceIds,
                'UserId'             => $this->userId,
                'UserMatchThreshold' => $this->userMatchThreshold,
                'ClientRequestToken' => $this->clientRequestToken,
            ],
            fn($value) => $value !== null
        );
    }
}