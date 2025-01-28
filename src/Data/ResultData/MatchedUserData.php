<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * Contains metadata for a userId matched with a given face.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-matcheduser
 *
 * @class MatchedUserData
 */
final class MatchedUserData extends Data
{
    public function __construct(
        /*
         * A provided id for the userId.
         * Unique within the collection.
         *
         * @param string|null
         */
        public ?string $userId = null,

        /*
         * The status of the user matched to a provided faceId.
         *
         * @param float|null
         */
        public ?string $userStatus = null,
    ) {}
}