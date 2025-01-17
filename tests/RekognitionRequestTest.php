<?php

namespace MoeMizrak\Rekognition\Tests;

use MoeMizrak\Rekognition\Data\DetectLabelsData;
use MoeMizrak\Rekognition\Data\ImageData;
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
        $image = file_get_contents('resources/images/test_labels.jpg');
        $imageData = new ImageData(
            bytes: $image,
        );
        $detectLabelsData = new DetectLabelsData(
            image: $imageData,
            maxLabels: 5,
        );
        $this->mockDetectLabelsRequest();

        /* EXECUTE */
        $response = Rekognition::detectLabels($detectLabelsData);

        /* ASSERT */
        $this->metaDataAssertions($response);
        $this->assertInstanceOf(DataCollection::class, $response->labels);
        $this->assertNotNull($response->LabelModelVersion);
    }

    #[Test]
    public function it_test_detect_labels_request_of_s3_image()
    {
        /* SETUP */
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
        $this->mockDetectLabelsRequest();

        /* EXECUTE */
        $response = Rekognition::detectLabels($detectLabelsData);

        /* ASSERT */
        $this->metaDataAssertions($response);
        $this->assertInstanceOf(DataCollection::class, $response->labels);
        $this->assertNotNull($response->LabelModelVersion);
    }
}