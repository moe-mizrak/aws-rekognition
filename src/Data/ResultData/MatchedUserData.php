<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use JetBrains\PhpStorm\ExpectedValues;
use Spatie\LaravelData\Data;

/**
 * Contains metadata for a userId matched with a given face.
 * Or Metadata of the user stored in a collection. (It is used for both cases since the structure is the same)
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-matcheduser
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-user
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
         * (Or communicates if the userId has been updated with latest set of faces to be associated with the userId.)
         *
         * @param string|null
         */
        #[ExpectedValues(['ACTIVE', 'UPDATING', 'CREATING', 'CREATED'])]
        public ?string $userStatus = null,
    ) {}
}