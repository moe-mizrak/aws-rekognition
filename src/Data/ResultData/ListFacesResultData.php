<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * ListFacesResultData is for the result of the Rekognition API listFaces request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#listfaces
 *
 * @class ListFacesResultData
 */
final class ListFacesResultData extends Data
{
    public function __construct(
        /*
         * An array of faces (Describes the face properties such as the bounding box, face id, image id of the input image, and external image id that you assigned.).
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(FaceData::class)]
        public ?DataCollection $faces = null,

        /*
         * The version number of the face detection model.
         *
         * @param string|null
         */
        public ?string $faceModelVersion = null,

        /*
         * If the result is truncated, the response provides a nextToken that you can use in the subsequent request to fetch the next set of collection ids.
         *
         * @param string|null
         */
        public ?string $nextToken = null,

        /*
         * Metadata about the request.
         *
         * @param MetaData|null
         */
        public ?MetaData $metadata = null,
    ) {}
}