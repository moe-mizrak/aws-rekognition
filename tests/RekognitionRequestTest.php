<?php

namespace MoeMizrak\Rekognition\Tests;

use MoeMizrak\Rekognition\Data\AssociateFacesData;
use MoeMizrak\Rekognition\Data\CreateCollectionData;
use MoeMizrak\Rekognition\Data\DeleteFacesData;
use MoeMizrak\Rekognition\Data\ListFacesData;
use MoeMizrak\Rekognition\Data\ListUsersData;
use MoeMizrak\Rekognition\Data\ResultData\BoundingBoxData;
use MoeMizrak\Rekognition\Data\SearchFacesByImageData;
use MoeMizrak\Rekognition\Data\UserData;
use MoeMizrak\Rekognition\Data\DeleteCollectionData;
use MoeMizrak\Rekognition\Data\DetectLabelsData;
use MoeMizrak\Rekognition\Data\ImageData;
use MoeMizrak\Rekognition\Data\IndexFacesData;
use MoeMizrak\Rekognition\Data\ListCollectionsData;
use MoeMizrak\Rekognition\Data\ResultData\SearchedFaceData;
use MoeMizrak\Rekognition\Data\S3ObjectData;
use MoeMizrak\Rekognition\Data\SearchUsersByImageData;
use MoeMizrak\Rekognition\Facades\Rekognition;
use PHPUnit\Framework\Attributes\Test;
use Spatie\LaravelData\DataCollection;

class RekognitionRequestTest extends TestCase
{
    /**
     * Assertions for metadata such as status code, effective uri, and headers.
     *
     * @param $response
     *
     * @return void
     */
    private function metadataAssertions($response): void
    {
        $this->assertEquals(200, $response->metadata->statusCode);
        $this->assertNotNull($response->metadata->effectiveUri);
        $this->assertIsArray($response->metadata->headers);
    }

    #[Test]
    public function it_test_detect_labels_request_of_image_sent()
    {
        /* SETUP */
        $imagePath = __DIR__.'/resources/images/test_labels.jpg';
        $methodName = 'detectLabels';
        $image = file_get_contents($imagePath);
        $imageData = new ImageData(
            bytes: $image,
        );
        $detectLabelsData = new DetectLabelsData(
            image: $imageData,
            maxLabels: 5,
        );
        $this->mockRekognitionClient($methodName);

        /* EXECUTE */
        $response = Rekognition::detectLabels($detectLabelsData);

        /* ASSERT */
        $this->metaDataAssertions($response);
        $this->assertInstanceOf(DataCollection::class, $response->labels);
        $this->assertNotNull($response->labelModelVersion);
    }

    #[Test]
    public function it_test_detect_labels_request_of_s3_image()
    {
        /* SETUP */
        $methodName = 'detectLabels';
        $s3Object = new S3ObjectData(
            bucket: 'test_bucket_name',
            name: 'test_image_key_name.jpg',
            version: 'v3',
        );
        $imageData = new ImageData(
            s3Object: $s3Object,
        );
        $detectLabelsData = new DetectLabelsData(
            image: $imageData,
            maxLabels: 5,
        );
        $this->mockRekognitionClient($methodName);

        /* EXECUTE */
        $response = Rekognition::detectLabels($detectLabelsData);

        /* ASSERT */
        $this->metaDataAssertions($response);
        $this->assertInstanceOf(DataCollection::class, $response->labels);
        $this->assertNotNull($response->labelModelVersion);
    }

    #[Test]
    public function it_tests_create_collection_request_for_given_collection_id_and_tags()
    {
        /* SETUP */
        $methodName = 'createCollection';
        $collectionId = 'test_collection_id';
        $createCollectionData = new CreateCollectionData(
            collectionId: $collectionId,
        );
        $this->mockRekognitionClient($methodName);

        /* EXECUTE */
        $response = Rekognition::createCollection($createCollectionData);

        /* ASSERT */
        $this->metaDataAssertions($response);
        $this->assertNotNull($response->collectionArn);
        $this->assertNotNull($response->faceModelVersion);
        $this->assertEquals(200, $response->statusCode);
        $this->assertStringContainsString($collectionId, $response->collectionArn);
    }

    #[Test]
    public function it_tests_list_collections_request()
    {
        /* SETUP */
        $methodName = 'listCollections';
        $listCollectionsData = new ListCollectionsData();
        $this->mockRekognitionClient($methodName);

        /* EXECUTE */
        $response = Rekognition::listCollections($listCollectionsData);

        /* ASSERT */
        $this->metaDataAssertions($response);
        $this->assertIsArray($response->collectionIds);
        $this->assertIsArray($response->faceModelVersions);
        $this->assertContains('test_collection_id_0', $response->collectionIds);
        $this->assertContains('test_collection_id_1', $response->collectionIds);
    }

    #[Test]
    public function it_tests_delete_collection_request_for_given_collection_id()
    {
        /* SETUP */
        $methodName = 'deleteCollection';
        $deleteCollectionId = 'test_collection_id';
        $deleteCollectionData = new DeleteCollectionData(
            collectionId: $deleteCollectionId,
        );
        $this->mockRekognitionClient($methodName);

        /* EXECUTE */
        $response = Rekognition::deleteCollection($deleteCollectionData);

        /* ASSERT */
        $this->metaDataAssertions($response);
        $this->assertEquals(200, $response->statusCode);
    }

    #[Test]
    public function it_tests_create_user_request()
    {
        /* SETUP */
        $methodName = 'createUser';
        $collectionId = 'test_collection_id';
        $userId = 'test_user_id';
        $createUserData = new UserData(
            collectionId: $collectionId,
            userId: $userId,
        );
        $this->mockRekognitionClient($methodName);

        /* EXECUTE */
        $response = Rekognition::createUser($createUserData);

        /* ASSERT */
        $this->metaDataAssertions($response);
    }

    #[Test]
    public function it_tests_delete_user_request()
    {
        /* SETUP */
        $methodName = 'deleteUser';
        $collectionId = 'test_collection_id';
        $userId = 'test_user_id';
        $deleteUserData = new UserData(
            collectionId: $collectionId,
            userId: $userId,
        );
        $this->mockRekognitionClient($methodName);

        /* EXECUTE */
        $response = Rekognition::deleteUser($deleteUserData);

        /* ASSERT */
        $this->metaDataAssertions($response);
    }

    #[Test]
    public function it_tests_list_users_request()
    {
        /* SETUP */
        $methodName = 'listUsers';
        $this->mockRekognitionClient($methodName);
        $listUsersData = new ListUsersData(
            collectionId: 'test_collection_id',
            maxResults: 10,
        );

        /* EXECUTE */
        $response = Rekognition::listUsers($listUsersData);

        /* ASSERT */
        $this->metaDataAssertions($response);
        $this->assertNotNull($response->users);
        $this->assertInstanceOf(DataCollection::class, $response->users);
    }

    #[Test]
    public function it_tests_index_faces_request()
    {
        /* SETUP */
        $methodName = 'indexFaces';
        $this->mockRekognitionClient($methodName);
        $imagePath = __DIR__.'/resources/images/test_labels.jpg';
        $image = file_get_contents($imagePath);
        $imageData = new ImageData(
            bytes: $image,
        );
        $indexFacesData = new IndexFacesData(
            collectionId: 'test_collection_id',
            image: $imageData,
            maxFaces: 2,
            externalImageId: 'test_external_image_id',
            qualityFilter: 'AUTO',
            detectionAttributes: ['ALL'],
        );

        /* EXECUTE */
        $response = Rekognition::indexFaces($indexFacesData);

        /* ASSERT */
        $this->metaDataAssertions($response);
        $this->assertNotNull($response->faceModelVersion);
        $this->assertNotNull($response->faceRecords);
        $this->assertInstanceOf(DataCollection::class, $response->faceRecords);
        $this->assertNotNull($response->unindexedFaces);
        $this->assertInstanceOf(DataCollection::class, $response->unindexedFaces);
    }

    #[Test]
    public function it_tests_associate_faces_request()
    {
        /* SETUP */
        $methodName = 'associateFaces';
        $this->mockRekognitionClient($methodName);
        $associateFacesData = new AssociateFacesData(
            collectionId: 'test_collection_id',
            faceIds: ['8e2ad714-4d23-43c0-b9ad-9fab136bef13', 'ed49afb4-b45b-468e-9614-d652c924cd4a'],
            userId: 'test_user_id',
            userMatchThreshold: 80.0, // default is 75.0
            clientRequestToken: 'test_client_request_token',
        );

        /* EXECUTE */
        $response = Rekognition::associateFaces($associateFacesData);

        /* ASSERT */
        $this->metaDataAssertions($response);
        $this->assertNotNull($response->associatedFaces);
        $this->assertInstanceOf(DataCollection::class, $response->associatedFaces);
        $this->assertNotNull($response->unsuccessfulFaceAssociations);
        $this->assertInstanceOf(DataCollection::class, $response->unsuccessfulFaceAssociations);
        $this->assertEquals("UPDATING", $response->userStatus);
    }

    #[Test]
    public function it_tests_list_faces_request()
    {
        /* SETUP */
        $methodName = 'listFaces';
        $this->mockRekognitionClient($methodName);
        $listFacesData = new ListFacesData(
            collectionId: 'test_collection_id',
            userId: 'test_user_id',
            maxResults: 10,
        );

        /* EXECUTE */
        $response = Rekognition::listFaces($listFacesData);

        /* ASSERT */
        $this->metaDataAssertions($response);
        $this->assertNotNull($response->faces);
        $this->assertInstanceOf(DataCollection::class, $response->faces);
        $this->assertNotNull($response->faceModelVersion);
    }

    #[Test]
    public function it_tests_delete_faces_request()
    {
        /* SETUP */
        $methodName = 'deleteFaces';
        $this->mockRekognitionClient($methodName);
        $deleteFacesData = new DeleteFacesData(
            collectionId: 'test_collection_id',
            faceIds: ['8e2ad714-4d23-43c0-b9ad-9fab136bef13', 'ed49afb4-b45b-468e-9614-d652c924cd4a'],
        );

        /* EXECUTE */
        $response = Rekognition::deleteFaces($deleteFacesData);

        /* ASSERT */
        $this->metaDataAssertions($response);
        $this->assertNotNull($response->deletedFaces);
        $this->assertNotNull($response->unsuccessfulFaceDeletions);
        $this->assertInstanceOf(DataCollection::class, $response->unsuccessfulFaceDeletions);
    }

    #[Test]
    public function it_tests_search_users_by_image_request()
    {
        /* SETUP */
        $methodName = 'searchUsersByImage';
        $this->mockRekognitionClient($methodName);
        $imagePath = __DIR__.'/resources/images/test_labels.jpg';
        $image = file_get_contents($imagePath);
        $imageData = new ImageData(
            bytes: $image,
        );
        $searchUsersByImageData = new SearchUsersByImageData(
            collectionId: 'test_collection_id',
            image: $imageData,
            maxUsers: 2,
            userMatchThreshold: 80.0,
            qualityFilter: 'MEDIUM',
        );

        /* EXECUTE */
        $response = Rekognition::searchUsersByImage($searchUsersByImageData);

        /* ASSERT */
        $this->metaDataAssertions($response);
        $this->assertNotNull($response->faceModelVersion);
        $this->assertNotNull($response->userMatches);
        $this->assertInstanceOf(DataCollection::class, $response->userMatches);
        $this->assertNotNull($response->searchedFace);
        $this->assertInstanceOf(SearchedFaceData::class, $response->searchedFace);
        $this->assertNotNull($response->unsearchedFaces);
        $this->assertInstanceOf(DataCollection::class, $response->unsearchedFaces);
    }

    #[Test]
    public function it_tests_search_faces_by_image_request()
    {
        /* SETUP */
        $methodName = 'searchFacesByImage';
        $this->mockRekognitionClient($methodName);
        $imagePath = __DIR__.'/resources/images/test_labels.jpg';
        $image = file_get_contents($imagePath);
        $imageData = new ImageData(
            bytes: $image,
        );
        $searchFacesByImageData = new SearchFacesByImageData(
            collectionId: 'test_collection_id',
            image: $imageData,
            maxFaces: 2,
            faceMatchThreshold: 80.0,
            qualityFilter: 'MEDIUM',
        );

        /* EXECUTE */
        $response = Rekognition::searchFacesByImage($searchFacesByImageData);

        /* ASSERT */
        $this->metaDataAssertions($response);
        $this->assertNotNull($response->faceModelVersion);
        $this->assertNotNull($response->faceMatches);
        $this->assertInstanceOf(DataCollection::class, $response->faceMatches);
        $this->assertNotNull($response->searchedFaceBoundingBox);
        $this->assertInstanceOf(BoundingBoxData::class, $response->searchedFaceBoundingBox);
        $this->assertNotNull($response->searchedFaceConfidence);
        $this->assertIsFloat($response->searchedFaceConfidence);
    }
}