<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition;

use MoeMizrak\Rekognition\Data\AssociateFacesData;
use MoeMizrak\Rekognition\Data\CreateCollectionData;
use MoeMizrak\Rekognition\Data\CreateUserData;
use MoeMizrak\Rekognition\Data\DeleteCollectionData;
use MoeMizrak\Rekognition\Data\DetectLabelsData;
use MoeMizrak\Rekognition\Data\IndexFacesData;
use MoeMizrak\Rekognition\Data\ListCollectionsData;
use MoeMizrak\Rekognition\Data\ResultData\AssociateFacesResultData;
use MoeMizrak\Rekognition\Data\ResultData\CreateCollectionResultData;
use MoeMizrak\Rekognition\Data\ResultData\CreateUserResultData;
use MoeMizrak\Rekognition\Data\ResultData\DeleteCollectionResultData;
use MoeMizrak\Rekognition\Data\ResultData\IndexFacesResultData;
use MoeMizrak\Rekognition\Data\ResultData\ListCollectionsResultData;
use MoeMizrak\Rekognition\Data\ResultData\DetectLabelsResultData;

/**
 * RekognitionRequest is the class that sends requests to AWS Rekognition API.
 * For more information, see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html
 *
 * @class RekognitionRequest
 */
final readonly class RekognitionRequest extends RekognitionAPI
{
    /**
     * Detects instances of real-world entities within an image (JPEG or PNG) provided as input.
     * This includes objects like flower, tree, and table; events like wedding, graduation, and birthday party; and concepts like landscape, evening, and nature.
     *
     * @param DetectLabelsData $detectLabelsData
     *
     * @return DetectLabelsResultData
     */
    public function detectLabels(DetectLabelsData $detectLabelsData): DetectLabelsResultData
    {
        // Send the request to AWS Rekognition API for detecting labels.
        $response = $this->client->detectLabels($detectLabelsData->toRekognitionDataFormat());

        // Form the response before returning it.
        return $this->rekognitionHelper->formDetectLabelsResponse($response->toArray());
    }

    /**
     * Lists the collections in the AWS account.
     *
     * @param ListCollectionsData $listCollectionsData
     *
     * @return ListCollectionsResultData
     */
    public function listCollections(ListCollectionsData $listCollectionsData): ListCollectionsResultData
    {
        // Send the request to AWS Rekognition API for listing collections.
        $response = $this->client->listCollections($listCollectionsData->toRekognitionDataFormat());

        // Form the response before returning it.
        return $this->rekognitionHelper->formListCollectionsResponse($response->toArray());
    }

    /**
     * Creates a collection in an AWS account.
     *
     * @param CreateCollectionData $createCollectionData
     *
     * @return CreateCollectionResultData
     */
    public function createCollection(CreateCollectionData $createCollectionData): CreateCollectionResultData
    {
        // Send the request to AWS Rekognition API for creating a collection.
        $response = $this->client->createCollection($createCollectionData->toRekognitionDataFormat());

        // Form the response before returning it.
        return $this->rekognitionHelper->formCreateCollectionResponse($response->toArray());
    }

    /**
     * Deletes the specified collection with the provided collection ID.
     * Warning! Note that this operation removes all faces in the collection.
     *
     * @param DeleteCollectionData $deleteCollectionData
     *
     * @return DeleteCollectionResultData
     */
    public function deleteCollection(DeleteCollectionData $deleteCollectionData): DeleteCollectionResultData
    {
        // Send the request to AWS Rekognition API for deleting a collection.
        $response = $this->client->deleteCollection($deleteCollectionData->toRekognitionDataFormat());

        // Form the response before returning it.
        return $this->rekognitionHelper->formDeleteCollectionResponse($response->toArray());
    }

    /**
     * Creates a new User within a collection specified by collectionId.
     * Note! CreateUserData takes userId as a parameter, which is a user provided id which should be unique within the collection.
     *
     * @param CreateUserData $createUserData
     *
     * @return CreateUserResultData
     */
    public function createUser(CreateUserData $createUserData): CreateUserResultData
    {
        // Send the request to AWS Rekognition API for creating a user.
        $response = $this->client->createUser($createUserData->toRekognitionDataFormat());

        // Form the response before returning it.
        return $this->rekognitionHelper->formCreateUserResponse($response->toArray());
    }


    /**
     * Detects faces in the input image and adds them to the specified collection.
     *
     * @param IndexFacesData $indexFacesData
     *
     * @return IndexFacesResultData
     */
    public function indexFaces(IndexFacesData $indexFacesData): IndexFacesResultData
    {
        // Send the request to AWS Rekognition API for indexing faces.
        $response = $this->client->indexFaces($indexFacesData->toRekognitionDataFormat());

        // Form the response before returning it.
        return $this->rekognitionHelper->formIndexFacesResponse($response->toArray());
    }

    /**
     * Associates one or more faces with an existing userId in a collection.
     *
     * @param AssociateFacesData $associateFacesData
     *
     * @return AssociateFacesResultData
     */
    public function associateFaces(AssociateFacesData $associateFacesData): AssociateFacesResultData
    {
        // Send the request to AWS Rekognition API for associating faces.
        $response = $this->client->associateFaces($associateFacesData->toRekognitionDataFormat());

        // Form the response before returning it.
        return $this->rekognitionHelper->formAssociateFacesResponse($response->toArray());
    }
}