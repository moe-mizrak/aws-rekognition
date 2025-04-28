<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Helpers;

use Illuminate\Support\Arr;
use MoeMizrak\Rekognition\Data\ResultData\AssociateFacesResultData;
use MoeMizrak\Rekognition\Data\ResultData\CreateCollectionResultData;
use MoeMizrak\Rekognition\Data\ResultData\DeleteFacesResultData;
use MoeMizrak\Rekognition\Data\ResultData\ListFacesResultData;
use MoeMizrak\Rekognition\Data\ResultData\ListUsersResultData;
use MoeMizrak\Rekognition\Data\ResultData\UserResultData;
use MoeMizrak\Rekognition\Data\ResultData\DeleteCollectionResultData;
use MoeMizrak\Rekognition\Data\ResultData\IndexFacesResultData;
use MoeMizrak\Rekognition\Data\ResultData\ListCollectionsResultData;
use MoeMizrak\Rekognition\Data\ResultData\DetectLabelsResultData;
use MoeMizrak\Rekognition\Data\ResultData\SearchUsersByImageResultData;
use MoeMizrak\Rekognition\Data\ResultData\SearchFacesByImageResultData;
use MoeMizrak\Rekognition\Traits\RetrieveDataTrait;

/**
 * Rekognition helper class for separating the logic of forming the response data from the Rekognition API.
 *
 * @class RekognitionHelper
 */
final readonly class RekognitionHelper
{
    use RetrieveDataTrait;

    /**
     * Forms the Rekognition listCollections response to ListCollectionsResultData including collection ids, face model versions, next token, and metadata.
     *
     * @param array $response
     *
     * @return ListCollectionsResultData
     */
    public function formListCollectionsResponse(array $response): ListCollectionsResultData
    {
        return new ListCollectionsResultData(
            collectionIds    : Arr::get($response, 'CollectionIds'),
            faceModelVersions: Arr::get($response, 'FaceModelVersions'),
            nextToken        : Arr::get($response, 'NextToken'),
            metadata         : $this->retrieveMetaData($response),
        );
    }

    /**
     * Forms the Rekognition listUsers response to ListUsersResultData including users, next token, and metadata.
     *
     * @param array $response
     *
     * @return ListUsersResultData
     */
    public function formListUsersResponse(array $response): ListUsersResultData
    {
        return new ListUsersResultData(
            users    : $this->retrieveUsers($response),
            nextToken: Arr::get($response, 'NextToken'),
            metadata : $this->retrieveMetaData($response),
        );
    }

    /**
     * Forms the Rekognition deleteCollection response to DeleteCollectionResultData including status code and metadata.
     *
     * @param array $response
     *
     * @return DeleteCollectionResultData
     */
    public function formDeleteCollectionResponse(array $response): DeleteCollectionResultData
    {
        return new DeleteCollectionResultData(
            statusCode: Arr::get($response, 'StatusCode'),
            metadata  : $this->retrieveMetaData($response),
        );
    }

    /**
     * Forms the Rekognition createCollection response to CreateCollectionResultData including collection arn, face model version, status code, and metadata.
     *
     * @param array $response
     *
     * @return CreateCollectionResultData
     */
    public function formCreateCollectionResponse(array $response): CreateCollectionResultData
    {
        return new CreateCollectionResultData(
            collectionArn   : Arr::get($response, 'CollectionArn'),
            faceModelVersion: Arr::get($response, 'FaceModelVersion'),
            statusCode      : Arr::get($response, 'StatusCode'),
            metadata        : $this->retrieveMetaData($response),
        );
    }

    /**
     * Forms the Rekognition detect labels response to DetectLabelsResultData including labels, label model version, orientation correction, image properties, and metadata.
     *
     * @param array $response
     *
     * @return DetectLabelsResultData
     */
    public function formDetectLabelsResponse(array $response): DetectLabelsResultData
    {
        return new DetectLabelsResultData(
            labels               : $this->retrieveLabels($response),
            labelModelVersion    : Arr::get($response, 'LabelModelVersion'),
            orientationCorrection: Arr::get($response, 'OrientationCorrection'),
            imageProperties      : $this->retrieveImageProperties($response),
            metadata             : $this->retrieveMetaData($response),
        );
    }

    /**
     * Forms the Rekognition create user response to UserResultData including metadata.
     * Note: The results for this operation are always empty, only metadata is returned.
     *
     * @param array $response
     *
     * @return UserResultData
     */
    public function formUserResponse(array $response): UserResultData
    {
        return new UserResultData(
            metadata: $this->retrieveMetaData($response),
        );
    }

    /**
     * Forms the Rekognition index faces response to IndexFacesResultData including face model version, face records, unindexed faces, orientation correction, and metadata.
     *
     * @param array $response
     *
     * @return IndexFacesResultData
     */
    public function formIndexFacesResponse(array $response): IndexFacesResultData
    {
        return new IndexFacesResultData(
            faceModelVersion     : Arr::get($response, 'FaceModelVersion'),
            faceRecords          : $this->retrieveFaceRecords($response),
            unindexedFaces       : $this->retrieveUnindexedFaces($response),
            orientationCorrection: Arr::get($response, 'OrientationCorrection'),
            metadata             : $this->retrieveMetaData($response),
        );
    }

    /**
     * Forms the Rekognition associate faces response to AssociateFacesResultData including associated faces, unsuccessful face associations, user status, and metadata.
     *
     * @param array $response
     *
     * @return AssociateFacesResultData
     */
    public function formAssociateFacesResponse(array $response): AssociateFacesResultData
    {
        return new AssociateFacesResultData(
            associatedFaces             : $this->retrieveAssociatedFaces($response),
            unsuccessfulFaceAssociations: $this->retrieveUnsuccessfulFaceAssociations($response),
            userStatus                  : Arr::get($response, 'UserStatus'),
            metadata                    : $this->retrieveMetaData($response),
        );
    }

    /**
     * Forms the Rekognition listFaces response to ListFacesResultData including faces, face model version, next token, and metadata.
     *
     * @param array $response
     *
     * @return ListFacesResultData
     */
    public function formListFacesResponse(array $response): ListFacesResultData
    {
        return new ListFacesResultData(
            faces           : $this->retrieveFaces($response),
            faceModelVersion: Arr::get($response, 'FaceModelVersion'),
            nextToken       : Arr::get($response, 'NextToken'),
            metadata        : $this->retrieveMetaData($response),
        );
    }

    /**
     * Forms the Rekognition deleteFaces response to DeleteFacesResultData including deleted faces, unsuccessful face deletions, and metadata.
     *
     * @param array $response
     *
     * @return DeleteFacesResultData
     */
    public function formDeleteFacesResponse(array $response): DeleteFacesResultData
    {
        return new DeleteFacesResultData(
            deletedFaces             : Arr::get($response, 'DeletedFaces'),
            unsuccessfulFaceDeletions: $this->retrieveUnsuccessfulFaceDeletions($response),
            metadata                 : $this->retrieveMetaData($response),
        );
    }

    /**
     * Forms the Rekognition search users by image response to SearchUsersByImageResultData including face model version, user matches, searched face, unsearched faces, and metadata.
     *
     * @param array $response
     *
     * @return SearchUsersByImageResultData
     */
    public function formSearchUsersByImageResponse(array $response): SearchUsersByImageResultData
    {
        return new SearchUsersByImageResultData(
            faceModelVersion: Arr::get($response, 'FaceModelVersion'),
            userMatches     : $this->retrieveUserMatches($response),
            searchedFace    : $this->retrieveSearchedFace($response),
            unsearchedFaces : $this->retrieveUnsearchedFaces($response),
            metadata        : $this->retrieveMetaData($response),
        );
    }

    /**
     * Forms the Rekognition search users by image response to SearchUsersByImageResultData including face model version, user matches, searched face, unsearched faces, and metadata.
     *
     * @param array $response
     *
     * @return SearchFacesByImageResultData
     */
    public function formSearchFacesByImageResponse(array $response): SearchFacesByImageResultData
    {
        return new SearchFacesByImageResultData(
            faceModelVersion       : Arr::get($response, 'FaceModelVersion'),
            faceMatches            : $this->retrieveFaceMatches($response),
            searchedFaceBoundingBox: $this->retrieveSearchedFaceBoundingBox($response),
            searchedFaceConfidence : Arr::get($response, 'SearchedFaceConfidence'),
        );
    }
}