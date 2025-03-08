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
            'detectLabels'       => $this->mockDetectLabelsBody(),
            'createCollection'   => $this->mockCreateCollectionBody(),
            'deleteCollection'   => $this->mockDeleteCollectionBody(),
            'listCollections'    => $this->mockListCollectionsBody(),
            'createUser', 'deleteUser' => $this->mockUserBody(),
            'listUsers'          => $this->mockListUsersBody(),
            'indexFaces'         => $this->mockIndexFacesBody(),
            'associateFaces'     => $this->mockAssociateFacesBody(),
            'searchUsersByImage' => $this->mockSearchUsersByImageBody(),
            default              => new Result([]),
        };
    }

    /**
     * Mock the create/delete user response body. This is the response that would be returned from the AWS Rekognition API createUser/deleteUser call.
     * The results for this operation are always empty, it only returns metadata.
     *
     * @return Result
     */
    private function mockUserBody(): Result
    {
        $data = [
            "@metadata" => $this->mockMetadata(),
        ];

        return new Result($data);
    }

    /**
     * Mock the list users response body. This is the response that would be returned from the AWS Rekognition API listUsers call.
     *
     * @return Result
     */
    private function mockListUsersBody(): Result
    {
        $data = [
            'Users' => [
                [
                    'UserId' => 'test_user_id_0',
                    'UserStatus' => 'ACTIVE',
                ],
                [
                    'UserId' => 'test_user_id_1',
                    'UserStatus' => 'UPDATING',
                ],
            ],
            "@metadata" => $this->mockMetadata(),
        ];

        return new Result($data);
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
     * Mock the index faces response body. This is the response that would be returned from the AWS Rekognition API indexFaces call.
     *
     * @return Result
     */
    private function mockIndexFacesBody(): Result
    {
        $data = [
            "FaceModelVersion" => "7.0",
            "FaceRecords" => [
                [
                    "Face" => [
                        "FaceId" => "038388f6-221a-4f3f-aab5-1ccd8256f7e8",
                        "BoundingBox" => [
                            "Width" => 0.076543763279915,
                            "Height" => 0.15887394547462,
                            "Left" => 0.18118159472942,
                            "Top" => 0.32549938559532,
                        ],
                        "ImageId" => "8d0575de-6fc3-3762-8644-3b393cef2741",
                        "ExternalImageId" => "test_external_image_id",
                        "Confidence" => 99.99772644043,
                    ],
                    "FaceDetail" => [
                        "BoundingBox" => [
                            "Width" => 0.076543763279915,
                            "Height" => 0.15887394547462,
                            "Left" => 0.18118159472942,
                            "Top" => 0.32549938559532,
                        ],
                        "AgeRange" => [
                            "Low" => 24,
                            "High" => 30,
                        ],
                        "Smile" => [
                            "Value" => true,
                            "Confidence" => 97.648254394531,
                        ],
                        "Eyeglasses" => [
                            "Value" => false,
                            "Confidence" => 99.553993225098,
                        ],
                        "Sunglasses" => [
                            "Value" => false,
                            "Confidence" => 98.928367614746,
                        ],
                        "Gender" => [
                            "Value" => "Male",
                            "Confidence" => 99.368766784668,
                        ],
                        "Beard" => [
                            "Value" => true,
                            "Confidence" => 98.687347412109,
                        ],
                        "Mustache" => [
                            "Value" => false,
                            "Confidence" => 75.454139709473,
                        ],
                        "EyesOpen" => [
                            "Value" => true,
                            "Confidence" => 76.802764892578,
                        ],
                        "MouthOpen" => [
                            "Value" => true,
                            "Confidence" => 98.060775756836,
                        ],
                        "Emotions" => [
                            ["Type" => "HAPPY", "Confidence" => 100.0],
                            ["Type" => "SURPRISED", "Confidence" => 0.013403594493866],
                            ["Type" => "CALM", "Confidence" => 0.0030219554901123],
                            ["Type" => "ANGRY", "Confidence" => 0.0003814697265625],
                            ["Type" => "CONFUSED", "Confidence" => 0.0003129243850708],
                            ["Type" => "DISGUSTED", "Confidence" => 0.00022053718566895],
                            ["Type" => "SAD", "Confidence" => 7.7486038208008E-5],
                            ["Type" => "FEAR", "Confidence" => 5.6624412536621E-5],
                        ],
                        "Landmarks" => [
                            ["Type" => "eyeLeft", "X" => 0.22872689366341, "Y" => 0.39220499992371],
                            ["Type" => "eyeRight", "X" => 0.24664263427258, "Y" => 0.39123106002808],
                            ["Type" => "mouthLeft", "X" => 0.21839706599712, "Y" => 0.442053347826],
                            ["Type" => "mouthRight", "X" => 0.23332993686199, "Y" => 0.44056829810143],
                            ["Type" => "nose", "X" => 0.24793295562267, "Y" => 0.42651760578156],
                            ["Type" => "leftEyeBrowLeft", "X" => 0.21753597259521, "Y" => 0.37879517674446],
                            ["Type" => "leftEyeBrowRight", "X" => 0.24070672690868, "Y" => 0.38105350732803],
                            ["Type" => "leftEyeBrowUp", "X" => 0.23274937272072, "Y" => 0.3769496679306],
                        ],
                        "Pose" => [
                            "Roll" => 21.813585281372,
                            "Yaw" => -72.741149902344,
                            "Pitch" => -12.293618202209,
                        ],
                        "Quality" => [
                            "Brightness" => 99.99772644043,
                            "Sharpness" => 99.99772644043,
                        ],
                        "Confidence" => 99.99772644043,
                        "FaceOcclusion" => [
                            "Value" => true,
                            "Confidence" => 54.401691436768,
                        ],
                        "EyeDirection" => [
                            "Yaw" => -51.8623046875,
                            "Pitch" => -5.367908000946,
                            "Confidence" => 5.3211221840264E-27,
                        ],
                    ],
                ],
            ],
            "UnindexedFaces" => [
                [
                    "Reasons" => [
                        "EXCEEDS_MAX_FACES",
                    ],
                    "FaceDetail" => [
                        "BoundingBox" => [
                            "Width" => 0.076543763279915,
                            "Height" => 0.15887394547462,
                            "Left" => 0.18118159472942,
                            "Top" => 0.32549938559532,
                        ],
                        "AgeRange" => [
                            "Low" => 24,
                            "High" => 30,
                        ],
                        "Smile" => [
                            "Value" => true,
                            "Confidence" => 97.648254394531,
                        ],
                        "Eyeglasses" => [
                            "Value" => false,
                            "Confidence" => 99.553993225098,
                        ],
                        "Sunglasses" => [
                            "Value" => false,
                            "Confidence" => 98.928367614746,
                        ],
                        "Gender" => [
                            "Value" => "Female",
                            "Confidence" => 99.368766784668,
                        ],
                        "Beard" => [
                            "Value" => false,
                            "Confidence" => 98.687347412109,
                        ],
                        "Confidence" => 99.99772644043,
                    ]
                ],
            ],
            "@metadata" => $this->mockMetadata(),
        ];

        return new Result($data);
    }

    /**
     * Mock the associate faces response body. This is the response that would be returned from the AWS Rekognition API associateFaces call.
     *
     * @return Result
     */
    private function mockAssociateFacesBody(): Result
    {
        $data = [
            "AssociatedFaces" => [
                [
                    "FaceId" => "8e2ad714-4d23-43c0-b9ad-9fab136bef13"
                ],
                [
                    "FaceId" => "ed49afb4-b45b-468e-9614-d652c924cd4a"
                ],
            ],
            "UnsuccessfulFaceAssociations" => [
                [
                    "Confidence" => 70.0,
                    "FaceId" => "2e2ad714-4d23-43c0-b9ad-9fab136bef10",
                    "Reason" => ["LOW_CONFIDENCE"],
                    "UserId" => "test_user_id",
                ],
                [
                    "Confidence" => 85.0,
                    "FaceId" => "4e2ad714-4d23-43c0-b9ad-9fab136bef103",
                    "Reason" => ["LOW_QUALITY"],
                    "UserId" => "test_user_id",
                ],
            ],
            "UserStatus" => "UPDATING",
            "@metadata" => $this->mockMetadata(),
        ];

        return new Result($data);
    }

    /**
     * Mock the search users by image response body. This is the response that would be returned from the AWS Rekognition API searchUsersByImage call.
     *
     * @return Result
     */
    private function mockSearchUsersByImageBody(): Result
    {
        $data = [
            'FaceModelVersion' => '7.0',
            'SearchedFace' => [
                'FaceDetail' => [
                    'BoundingBox' => [
                        'Height' => 0.075100161135197,
                        'Left' => 0.35986787080765,
                        'Top' => 0.53915268182755,
                        'Width' => 0.036928374320269,
                    ],
                ],
            ],
            'UnsearchedFaces' => [
                [
                    'FaceDetails' => [
                        'BoundingBox' => [
                            'Height' => 0.068217702209949,
                            'Left' => 0.610256254673,
                            'Top' => 0.5593535900116,
                            'Width' => 0.031677018851042,
                        ],
                    ],
                    'Reasons' => [
                        'FACE_NOT_LARGEST',
                    ],
                ],
                [
                    'FaceDetails' => [
                        'BoundingBox' => [
                            'Height' => 0.063479974865913,
                            'Left' => 0.51606231927872,
                            'Top' => 0.60803580284119,
                            'Width' => 0.032544497400522,
                        ],
                    ],
                    'Reasons' => [
                        'FACE_NOT_LARGEST',
                    ],
                ],
            ],
            'UserMatches' => [
                [
                    'Similarity' => 99.881866455078,
                    'User' => [
                        'UserId' => 'test_user_id',
                        'UserStatus' => 'ACTIVE',
                    ],
                ],
            ],
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