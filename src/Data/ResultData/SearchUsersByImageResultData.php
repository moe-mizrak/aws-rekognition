<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * SearchUsersByImageResultData is the DTO for the response of the Rekognition API searchUsersByImage request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#searchusersbyimage
 *
 * @class SearchUsersByImageResultData
 */
final class SearchUsersByImageResultData extends Data
{
    public function __construct(
        /*
         * Version number of the face detection model associated with the input collection collectionId.
         *
         * @param string|null
         */
        public ?string $faceModelVersion = null,

        /*
         * An array of userId objects that matched the input face, along with the confidence in the match.
         * The returned structure will be empty if there are no matches.
         * Returned if the search users by image action is successful.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(UserMatchData::class)]
        public ?DataCollection $userMatches = null,

        /*
         * A list of FaceDetailData objects containing the BoundingBoxData for the largest face in image, as well as the confidence in the bounding box, that was searched for matches.
         * If no valid face is detected in the image the response will contain no SearchedFaceData object.
         *
         * @param SearchedFaceData|null
         */
        public ?SearchedFaceData $searchedFace = null,

        /*
         * List of UnsearchedFaceData objects. Contains the face details inferred from the specified image but not used for search.
         * Contains reasons that describe why a face wasn't used for the search.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(UnsearchedFaceData::class)]
        public ?DataCollection $unsearchedFaces = null,

        /*
         * Metadata about the request.
         *
         * @param MetaData|null
         */
        public ?MetaData $metadata = null,
    ) {}
}