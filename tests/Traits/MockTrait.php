<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Tests\Traits;

use Aws\Result;

/**
 * MockTrait for mocking the AWS Rekognition API requests.
 *
 * @class MockTrait
 */
trait MockTrait
{
    /**
     * Mock the Rekognition client for testing in order to avoid making real requests.
     *
     * @param string $methodName
     *
     * @return Result
     */
    protected function mockRekognitionResponse(string $methodName): Result
    {
        return match ($methodName) {
            'detectLabels'     => $this->mockDetectLabelsBody(),
            'createCollection' => $this->mockCreateCollectionBody(),
            'deleteCollection' => $this->mockDeleteCollectionBody(),
            'listCollections'  => $this->mockListCollectionsBody(),
            default            => new Result([]),
        };
    }

    /**
     * Mock the list collections response body. This is the response that would be returned from the AWS Rekognition API listCollections call.
     *
     * @return Result
     */
    private function mockListCollectionsBody(): Result
    {
        $data = [
            'CollectionIds' => [
                'test_collection_id_0',
                'test_collection_id_1',
            ],
            'FaceModelVersions' => [
                '7.0',
                '7.0',
            ],
            "@metadata" => $this->mockMetadata(),
        ];

        return new Result($data);
    }

    /**
     * Mock the create collection response body. This is the response that would be returned from the AWS Rekognition API createCollection call.
     *
     * @return Result
     */
    private function mockCreateCollectionBody(): Result
    {
        $data = [
            "CollectionArn" => "aws:rekognition:us-east-1:605134457385:collection/test_collection_id_0",
            "FaceModelVersion" => "7.0",
            "StatusCode" => 200,
            "@metadata" => $this->mockMetadata(),
        ];

        return new Result($data);
    }

    /**
     * Mock the delete collection response body. This is the response that would be returned from the AWS Rekognition API deleteCollection call.
     *
     * @return Result
     */
    private function mockDeleteCollectionBody(): Result
    {
        $data = [
            "StatusCode" => 200,
            "@metadata" => $this->mockMetadata(),
        ];

        return new Result($data);
    }

    /**
     * Mock the detect labels response body. This is the response that would be returned from the AWS Rekognition API detectLabels call.
     *
     * @return Result
     */
    private function mockDetectLabelsBody(): Result
    {
        $data = [
            "Labels" => [
                [
                    "Name" => "Adult",
                    "Confidence" => 99.406089782715,
                    "Instances" => [
                        [
                            "BoundingBox" => [
                                "Width" => 0.4137507379055,
                                "Height" => 0.74068546295166,
                                "Left" => 0.0,
                                "Top" => 0.25919502973557,
                            ],
                            "Confidence" => 99.406089782715,
                        ],
                        [
                            "BoundingBox" => [
                                "Width" => 0.4726165831089,
                                "Height" => 0.55402708053589,
                                "Left" => 0.29312029480934,
                                "Top" => 0.23203137516975,
                            ],
                            "Confidence" => 98.74324798584,
                        ],
                        [
                            "BoundingBox" => [
                                "Width" => 0.29476174712181,
                                "Height" => 0.62268280982971,
                                "Left" => 0.64589500427246,
                                "Top" => 0.26460602879524,
                            ],
                            "Confidence" => 98.648498535156,
                        ],
                    ],
                    "Parents" => [
                        ["Name" => "Person"],
                    ],
                    "Aliases" => [],
                    "Categories" => [
                        ["Name" => "Person Description"],
                    ],
                ],
                [
                    "Name" => "Male",
                    "Confidence" => 99.406089782715,
                    "Instances" => [
                        [
                            "BoundingBox" => [
                                "Width" => 0.4137507379055,
                                "Height" => 0.74068546295166,
                                "Left" => 0.0,
                                "Top" => 0.25919502973557,
                            ],
                            "Confidence" => 99.406089782715,
                        ],
                        [
                            "BoundingBox" => [
                                "Width" => 0.40260022878647,
                                "Height" => 0.50842136144638,
                                "Left" => 0.5948948264122,
                                "Top" => 0.49154290556908,
                            ],
                            "Confidence" => 98.609413146973,
                        ],
                    ],
                    "Parents" => [
                        ["Name" => "Person"],
                    ],
                    "Aliases" => [],
                    "Categories" => [
                        ["Name" => "Person Description"],
                    ],
                ],
                [
                    "Name" => "Man",
                    "Confidence" => 99.406089782715,
                    "Instances" => [
                        [
                            "BoundingBox" => [
                                "Width" => 0.4137507379055,
                                "Height" => 0.74068546295166,
                                "Left" => 0.0,
                                "Top" => 0.25919502973557,
                            ],
                            "Confidence" => 99.406089782715,
                        ],
                    ],
                    "Parents" => [
                        ["Name" => "Adult"],
                        ["Name" => "Male"],
                        ["Name" => "Person"],
                    ],
                    "Aliases" => [],
                    "Categories" => [
                        ["Name" => "Person Description"],
                    ],
                ],
                [
                    "Name" => "Person",
                    "Confidence" => 99.406089782715,
                    "Instances" => [
                        [
                            "BoundingBox" => [
                                "Width" => 0.4137507379055,
                                "Height" => 0.74068546295166,
                                "Left" => 0.0,
                                "Top" => 0.25919502973557,
                            ],
                            "Confidence" => 99.406089782715,
                        ],
                        [
                            "BoundingBox" => [
                                "Width" => 0.4726165831089,
                                "Height" => 0.55402708053589,
                                "Left" => 0.29312029480934,
                                "Top" => 0.23203137516975,
                            ],
                            "Confidence" => 98.74324798584,
                        ],
                        [
                            "BoundingBox" => [
                                "Width" => 0.29476174712181,
                                "Height" => 0.62268280982971,
                                "Left" => 0.64589500427246,
                                "Top" => 0.26460602879524,
                            ],
                            "Confidence" => 98.648498535156,
                        ],
                        [
                            "BoundingBox" => [
                                "Width" => 0.40260022878647,
                                "Height" => 0.50842136144638,
                                "Left" => 0.5948948264122,
                                "Top" => 0.49154290556908,
                            ],
                            "Confidence" => 98.609413146973,
                        ],
                    ],
                    "Parents" => [],
                    "Aliases" => [
                        ["Name" => "Human"],
                    ],
                    "Categories" => [
                        ["Name" => "Person Description"],
                    ],
                ],
                [
                    "Name" => "Woman",
                    "Confidence" => 98.74324798584,
                    "Instances" => [
                        [
                            "BoundingBox" => [
                                "Width" => 0.4726165831089,
                                "Height" => 0.55402708053589,
                                "Left" => 0.29312029480934,
                                "Top" => 0.23203137516975,
                            ],
                            "Confidence" => 98.74324798584,
                        ],
                        [
                            "BoundingBox" => [
                                "Width" => 0.29476174712181,
                                "Height" => 0.62268280982971,
                                "Left" => 0.64589500427246,
                                "Top" => 0.26460602879524,
                            ],
                            "Confidence" => 98.648498535156,
                        ],
                    ],
                    "Parents" => [
                        ["Name" => "Adult"],
                        ["Name" => "Female"],
                        ["Name" => "Person"],
                    ],
                    "Aliases" => [],
                    "Categories" => [
                        ["Name" => "Person Description"],
                    ],
                ],
            ],
            "LabelModelVersion" => "3.0",
            "@metadata" => $this->mockMetadata(),
        ];

        return new Result($data);
    }

    /**
     * Mock the metadata.
     *
     * @return array
     */
    private function mockMetadata(): array
    {
        return [
            "statusCode" => 200,
            "effectiveUri" => "https://rekognition.us-east-1.amazonaws.com",
            "headers" => [
                "x-amzn-requestid" => "8dc27697-dc77-4d24-9f68-1f5080b536c2",
                "content-type" => "application/x-amz-json-1.1",
                "content-length" => "2658",
                "date" => "Fri, 17 Jan 2025 18:05:24 GMT",
            ],
            "transferStats" => [
                "http" => [
                    [],
                ],
            ],
        ];
    }
}