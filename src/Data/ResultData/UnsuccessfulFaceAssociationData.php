<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * Contains metadata like faceId, userId, and reasons, for a face that was unsuccessfully associated.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-unsuccessfulfaceassociation
 *
 * @class UnsuccessfulFaceAssociationData
 */
final class UnsuccessfulFaceAssociationData extends Data
{
    public function __construct(
        /*
         * Match confidence with the userID, provides information regarding if a face association was unsuccessful because it didn't meet userMatchThreshold.
         *
         * @param float|null
         */
        public ?float $confidence = null,

        /*
         * A unique identifier assigned to the face.
         *
         * @param string|null
         */
        public ?string $faceId = null,

        /*
         * The reason why the association was unsuccessful.
         *
         * @param array|null
         */
        public ?array $reasons = null,

        /*
         * A provided id for the userId. Unique within the collection.
         *
         * @param string|null
         */
        public ?string $userId = null,
    ) {}
}