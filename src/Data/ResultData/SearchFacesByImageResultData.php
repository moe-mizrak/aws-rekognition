<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * SearchFacesByImageResultData is the DTO for the response of the Rekognition API searchFacesByImage request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#searchfacesbyimage
 *
 * @class SearchFacesByImageResultData
 */
final class SearchFacesByImageResultData extends Data
{
    public function __construct(
        /*
         * Version number of the face detection model associated with the input collection collectionId.
         *
         * @param string|null
         */
        public ?string $faceModelVersion = null,

        /*
         * An array of face matches found in the input image.
         * Each face match includes face details and the similarity confidence.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(FaceMatchData::class)]
        public ?DataCollection $faceMatches = null,

        /*
         * The bounding box around the face that was searched for matches.
         * Contains coordinates (height, width, left, top).
         *
         * @param BoundingBoxData|null
         */
        public ?BoundingBoxData $searchedFaceBoundingBox = null,

        /*
         * Confidence that the bounding box contains a face (float 0-100).
         *
         * @param float|null
         */
        public ?float $searchedFaceConfidence = null,
    ) {}
}
