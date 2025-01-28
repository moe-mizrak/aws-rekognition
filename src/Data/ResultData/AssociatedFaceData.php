<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * Provides face metadata for the faces that are associated to a specific userId.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-associatedface
 *
 * @class AssociatedFaceData
 */
final class AssociatedFaceData extends Data
{
    public function __construct(
        /*
         * Unique identifier assigned to the face.
         *
         * @param string|null
         */
        public ?string $faceId,
    ) {}
}