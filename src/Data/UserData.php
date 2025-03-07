<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use MoeMizrak\Rekognition\Data\Contracts\RekognitionDataFormatInterface;
use Spatie\LaravelData\Data;

/**
 * UserData is for the data of the Rekognition API createUser/deleteUser request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#createuser
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#deleteuser
 *
 * @class UserData
 */
final class UserData extends Data implements RekognitionDataFormatInterface
{
    public function __construct(
        /*
         * The ID of an existing collection to which the new userID needs to be created/deleted.
         *
         * @param string
         */
        public string $collectionId,

        /*
         * ID for the user id to be created/deleted. This user id needs to be unique within the collection.
         *
         * @param string
         */
        public string $userId,

        /*
         * Idempotent token used to identify the request to createUser/deleteUser.
         * If you use the same token with multiple createUser/deleteUser requests, the same response is returned.
         * Use clientRequestToken to prevent the same request from being processed more than once.
         *
         * @param string|null
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
                'UserId'             => $this->userId,
                'ClientRequestToken' => $this->clientRequestToken,
            ],
            fn ($value) => $value !== null
        );
    }
}