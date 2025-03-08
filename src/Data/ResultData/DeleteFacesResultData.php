<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * DeleteFacesResultData is for the result of the Rekognition API deleteFaces request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#deletefaces
 *
 * @class DeleteFacesResultData
 */
final class DeleteFacesResultData extends Data
{
    public function __construct(
        /*
         * An array of strings (face ids) of the faces that were deleted.
         *
         * @param array|null
         */
        public ?array $deletedFaces = null,

        /*
         * An array of any faces that weren't deleted.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(UnsuccessfulFaceDeletionsData::class)]
        public ?DataCollection $unsuccessfulFaceDeletions = null,

        /*
         * Metadata about the request.
         *
         * @param MetaData|null
         */
        public ?MetaData $metadata = null,
    ) {}
}