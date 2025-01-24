<?php

namespace MoeMizrak\Rekognition\Tests;

use MoeMizrak\Rekognition\Data\CreateCollectionData;
use MoeMizrak\Rekognition\Data\CreateUserData;
use MoeMizrak\Rekognition\Data\DeleteCollectionData;
use MoeMizrak\Rekognition\Data\DetectLabelsData;
use MoeMizrak\Rekognition\Data\ImageData;
use MoeMizrak\Rekognition\Data\ListCollectionsData;
use MoeMizrak\Rekognition\Data\S3ObjectData;
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
        $collectionId = 'test_collection_id_0';
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
        $deleteCollectionId = 'test_collection_id_2';
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
        $createUserData = new CreateUserData(
            collectionId: $collectionId,
            userId: $userId,
        );
        $this->mockRekognitionClient($methodName);

        /* EXECUTE */
        $response = Rekognition::createUser($createUserData);

        /* ASSERT */
        $this->metaDataAssertions($response);
    }
}