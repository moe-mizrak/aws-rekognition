<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * Contains metadata like faceId, userId, and reasons, for a face that was unsuccessfully deleted.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-unsuccessfulfacedeletion
 *
 * @class UnsuccessfulFaceDeletionsData
 */
final class UnsuccessfulFaceDeletionsData extends Data
{
    public function __construct(
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