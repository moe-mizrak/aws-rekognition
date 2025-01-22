
# AWS Rekognition API for Laravel

<br />

[![Latest Version on Packagist](https://img.shields.io/badge/packagist-v1.0-blue)](https://packagist.org/packages/moe-mizrak/aws-rekognition)
<br />

Laravel package for AWS Rekognition API (PHP 8)

---

## Table of Contents

- [🤖 Requirements](#-requirements)
- [🏁 Get Started](#-get-started)
- [🧩 Configuration](#-configuration)
- [🎨 Usage](#-usage)
  - [Detect Labels](#detect-labels)
  - [Collections](#collections)
    - [Create Collection](#create-collection)
    - [Delete Collection](#delete-collection)
    - [List Collections](#list-collections)
- [💫 Contributing](#-contributing)
- [📜 License](#-license)

## 🤖 Requirements
- **PHP 8.2** or **higher**

## 🏁 Get Started
You can **install** the package via composer:
```bash
composer require moe-mizrak/aws-rekognition
```

You can **publish** the [`aws-rekognition`](config/aws-rekognition.php) **config file** with:
```bash
php artisan vendor:publish --tag=aws-rekognition
```

<details>
<summary>This is the contents of the published config file:</summary>

```php
return [
    'credentials' => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
    ],
    'region'      => env('AWS_REGION', 'us-east-1'),
    'version'     => env('AWS_VERSION', 'latest'),
];
```
</details>

## 🧩 Configuration
After publishing the [`aws-rekognition`](config/aws-rekognition.php) config file, you'll need to add the following environment variables to your **.env** file:

```env
AWS_ACCESS_KEY_ID=your_aws_access_key_id
AWS_SECRET_ACCESS_KEY=your_aws_secret_access_key
AWS_REGION=your_aws_region
AWS_VERSION=your_aws_version
```

- credentials: AWS credentials for accessing the Rekognition API. Please refer to the 
[Get Access Key ID and Secret Access Key for AWS](https://bobbyhadz.com/blog/aws-get-aws-access-key-id#get-access-key-id-and-secret-access-key-for-an-iam-account):
    - **AWS_ACCESS_KEY_ID**: The AWS access key ID.
    - **AWS_SECRET_ACCESS_KEY**: The AWS secret access key.

> [!IMPORTANT]
> Give following **Permissions** to the IAM user for accessing the **Rekognition API**:
> - `AmazonRekognitionFullAccess`
> - `AmazonS3FullAccess`

- **AWS_REGION**: The AWS region where the Rekognition API is located (default: us-east-1).

> [!CAUTION]
> The region for the **S3 bucket** containing the S3 object **must match** the **region** you use for Amazon **Rekognition** operations.

- **AWS_VERSION**: The version of the Rekognition API (default: latest).

For more info, please refer to [AWS Client](https://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.AwsClient.html#method___construct).

## 🎨 Usage
The `Rekognition` facade offers a convenient way to make **AWS Rekognition API** requests.

> [!NOTE]
> **AWS Rekognition API** offers **over 10** primary operations across various categories for **image** and **video analysis**, but this package currently supports **only a handful of them**.
> 
> **Contributions** are highly **encouraged**! If you'd like to add support for more operations, feel free to contribute to the package.
> 
> Check out the full list of **Rekognition** operations [Amazon Rekognition](https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html).

Following **Rekognition API** operations are supported:
- [Detect Labels](#detect-labels)
- [Collections](#collections)
  - [Create Collection](#create-collection)
  - [Delete Collection](#delete-collection)
  - [List Collections](#list-collections)

> [!TIP]
> All classes include **comprehensive** DocBlock **comments** and **detailed documentation** to enhance readability and understanding.
> 
> Refer to the class definitions for a complete overview of **methods**, **parameters**, and **their usage**.

### Detect Labels
Detects instances of **real-world entities** within an **image** (**JPEG** or **PNG**) provided as input.
This includes objects like flower, tree, and table; events like wedding, graduation, and birthday party; and concepts like landscape, evening, and nature.

Labels supported by **Rekognition** label detection operations can be found in [Detecting Objects and Concepts](https://docs.aws.amazon.com/rekognition/latest/dg/labels.html).

First of all, you need to create an instance of [`ImageData`](src/Data/ImageData.php) object by providing the **image bytes** of an image file.
```php
// Path to the image file
$imagePath = __DIR__.'/resources/images/test_labels.jpg';
// Read the image file into bytes
$image = file_get_contents($imagePath);
// Create an ImageData object
$imageData = new ImageData(
    bytes: $image,
);
```

<details>
<summary>Alternatively, you can use S3 as the image source:</summary>

```php
// Create an S3ObjectData object
$s3Object = new S3ObjectData(
    bucket: 'your_bucket_name',
    name  : 'your_image_name.jpg',
);
// Create an ImageData object by providing the S3 object
$imageData = new ImageData(
    s3Object: $s3Object,
);
```

For more details, see [S3Object](https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-s3object) section.
</details>

To send a **detect labels** request, you need to create an instance of [`DetectLabelsData`](src/Data/DetectLabelsData.php) object.
```php
// Create a DetectLabelsData object
$detectLabelsData = new DetectLabelsData(
    image: $imageData,
);
```

<details>
<summary>More optional parameters can be provided to the DetectLabelsData object:</summary>

```php
// Create a DetectLabelsData object with optional parameters
$detectLabelsData = new DetectLabelsData(
    image        : $imageData,
    maxLabels    : 10, // Maximum number of labels to return
    minConfidence: 80.0, // Minimum confidence level for the labels to return
    settings     : new SettingsData(
        generalLabels: new GeneralLabelsSettingsData(
            labelCategoryExclusionFilters: ['Person Description'],
            labelCategoryInclusionFilters: ['Animals and Pets'],
            labelExclusionFilters        : ['Man', 'Woman'],
            labelInclusionFilters        : ['Dog', 'Cat'],
        ),
    ),
);
```

Check out [`DetectLabelsData`](src/Data/DetectLabelsData.php) class for optional parameters and their descriptions.

For more details, see [DetectLabels](https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#detectlabels) section.
</details>

Then, you can send the request using the `Rekognition` facade `detectLabels` method.

```php
$response = Rekognition::detectLabels($detectLabelsData);
```

Response will be an instance of [`DetectLabelsResultData`](src/Data/ResultData/DetectLabelsResultData.php) object.

<details>
<summary>This is the sample DetectLabelsResultData:</summary>

```php
DetectLabelsResultData(
    labels: DataCollection([
        LabelData(
            name: 'Adult',
            parents: DataCollection([
                ParentData(name: 'Person'),
            ]),
            categories: DataCollection([
                CategoryData(name: 'Person Description'),
            ]),
            confidence: 99.406089782715,
            instances: DataCollection([
                InstanceData(
                    boundingBox: BoundingBoxData(
                        width: 0.4137507379055,
                        height: 0.74068546295166,
                        left: 0.0,
                        top: 0.25919502973557,
                    ),
                    confidence: 99.406089782715,
                ),
                InstanceData(
                    boundingBox: BoundingBoxData(
                        width: 0.4726165831089,
                        height: 0.55402708053589,
                        left: 0.29312029480934,
                        top: 0.23203137516975,
                    ),
                    confidence: 98.74324798584,
                ),
                InstanceData(
                    boundingBox: BoundingBoxData(
                        width: 0.29476174712181,
                        height: 0.62268280982971,
                        left: 0.64589500427246,
                        top: 0.26460602879524,
                    ),
                    confidence: 98.648498535156,
                ),
            ]),
        ),
        LabelData(
            name: 'Male',
            parents: DataCollection([
                ParentData(name: 'Person'),
            ]),
            categories: DataCollection([
                CategoryData(name: 'Person Description'),
            ]),
            confidence: 99.406089782715,
            instances: DataCollection([
                InstanceData(
                    boundingBox: BoundingBoxData(
                        width: 0.4137507379055,
                        height: 0.74068546295166,
                        left: 0.0,
                        top: 0.25919502973557,
                    ),
                    confidence: 99.406089782715,
                ),
                InstanceData(
                    boundingBox: BoundingBoxData(
                        width: 0.40260022878647,
                        height: 0.50842136144638,
                        left: 0.5948948264122,
                        top: 0.49154290556908,
                    ),
                    confidence: 98.609413146973,
                ),
            ]),
        ),
        LabelData(
            name: 'Man',
            parents: DataCollection([
                ParentData(name: 'Adult'),
                ParentData(name: 'Male'),
                ParentData(name: 'Person'),
            ]),
            categories: DataCollection([
                CategoryData(name: 'Person Description'),
            ]),
            confidence: 99.406089782715,
            instances: DataCollection([
                InstanceData(
                    boundingBox: BoundingBoxData(
                        width: 0.4137507379055,
                        height: 0.74068546295166,
                        left: 0.0,
                        top: 0.25919502973557,
                    ),
                    confidence: 99.406089782715,
                ),
            ]),
        ),
        LabelData(
            name: 'Person',
            categories: DataCollection([
                CategoryData(name: 'Person Description'),
            ]),
            confidence: 99.406089782715,
            instances: DataCollection([
                InstanceData(
                    boundingBox: BoundingBoxData(
                        width: 0.4137507379055,
                        height: 0.74068546295166,
                        left: 0.0,
                        top: 0.25919502973557,
                    ),
                    confidence: 99.406089782715,
                ),
                InstanceData(
                    boundingBox: BoundingBoxData(
                        width: 0.4726165831089,
                        height: 0.55402708053589,
                        left: 0.29312029480934,
                        top: 0.23203137516975,
                    ),
                    confidence: 98.74324798584,
                ),
                InstanceData(
                    boundingBox: BoundingBoxData(
                        width: 0.29476174712181,
                        height: 0.62268280982971,
                        left: 0.64589500427246,
                        top: 0.26460602879524,
                    ),
                    confidence: 98.648498535156,
                ),
                InstanceData(
                    boundingBox: BoundingBoxData(
                        width: 0.40260022878647,
                        height: 0.50842136144638,
                        left: 0.5948948264122,
                        top: 0.49154290556908,
                    ),
                    confidence: 98.609413146973,
                ),
            ]),
        ),
        LabelData(
            name: 'Woman',
            parents: DataCollection([
                ParentData(name: 'Adult'),
                ParentData(name: 'Female'),
                ParentData(name: 'Person'),
            ]),
            categories: DataCollection([
                CategoryData(name: 'Person Description'),
            ]),
            confidence: 98.74324798584,
            instances: DataCollection([
                InstanceData(
                    boundingBox: BoundingBoxData(
                        width: 0.4726165831089,
                        height: 0.55402708053589,
                        left: 0.29312029480934,
                        top: 0.23203137516975,
                    ),
                    confidence: 98.74324798584,
                ),
                InstanceData(
                    boundingBox: BoundingBoxData(
                        width: 0.29476174712181,
                        height: 0.62268280982971,
                        left: 0.64589500427246,
                        top: 0.26460602879524,
                    ),
                    confidence: 98.648498535156,
                ),
            ]),
        ),
    ]),
    labelModelVersion: "3.0",
    metadata: MetadataData(
        statusCode: 200,
        effectiveUri: "https://rekognition.us-east-1.amazonaws.com/",
        headers: [
                "x-amzn-requestid" => "8dc27697-dc77-4d24-9f68-1f5080b536c9",
                "content-type" => "application/x-amz-json-1.1",
                "content-length" => "2658",
                "date" => "Fri, 17 Jan 2025 18:05:24 GMT",
        ],
        transferStats: [
            "http" => [
                [],
            ],
        ],
    ),
);
```
</details>

---
### Collections
The **face collection** is the primary Amazon Rekognition resource. A collection is a **container for faces** that you want to **search**, **compare**, or **store**.

Check out [Managing Face Collections, Faces, and Users](https://docs.aws.amazon.com/rekognition/latest/dg/managing-face-collections.html#managing-collections) for more details.

#### Create Collection
Creates a collection in an AWS Region.

To create a collection, you need to create an instance of [`CreateCollectionData`](src/Data/CreateCollectionData.php) object:
```php
// Create a CreateCollectionData object
$createCollectionData = new CreateCollectionData(
    collectionId: 'your_collection_id', // Unique identifier for the collection
    tags        : ['tag_key' => 'tag_value'], // Optional tags for the collection (A set of tags key-value pairs that you want to attach to the collection)
);
```

Then, you can send the request using the `Rekognition` facade `createCollection` method:
```php
$response = Rekognition::createCollection($createCollectionData);
```

Response will be an instance of [`CreateCollectionResultData`](src/Data/ResultData/CreateCollectionResultData.php) object.
> [!TIP]
> `CreateCollectionResultData` contains the `collectionArn` - **Amazon Resource Name (ARN)** of the collection. You can use this to manage **permissions** on your resources.
> 
> Please refer to [Identify AWS resources with Amazon Resource Names (ARNs)](https://docs.aws.amazon.com/IAM/latest/UserGuide/reference-arns.html) for more details.

<details>
<summary>This is the sample CreateCollectionResultData:</summary>

```php
CreateCollectionResultData(
    collectionArn: "arn:aws:rekognition:us-east-1:123456789010:collection/your_collection_id",
    faceModelVersion: "7.0",
    statusCode: 200,
    metadata: MetadataData(
        statusCode: 200,
        effectiveUri: "https://rekognition.us-east-1.amazonaws.com/",
        headers: [
            "x-amzn-requestid" => "8dc27697-dc77-4d24-9f68-1f5080b536c9",
            "content-type" => "application/x-amz-json-1.1",
            "content-length" => "2658",
            "date" => "Fri, 17 Jan 2025 18:05:24 GMT",
        ],
        transferStats: [
            "http" => [
                [],
            ],
        ],
    ),
);
```
</details>

#### Delete Collection
Deletes the specified collection with the provided `collectionId`.

> [!WARNING]
> **Deleting a collection** also **removes all faces** in the collection.

To delete a collection, you need to create an instance of [`DeleteCollectionData`](src/Data/DeleteCollectionData.php) object:
```php
// Create a DeleteCollectionData object
$deleteCollectionData = new DeleteCollectionData(
    collectionId: 'your_collection_id', // Unique identifier for the collection
);
```

Then, you can send the request using the `Rekognition` facade `deleteCollection` method:
```php
$response = Rekognition::deleteCollection($deleteCollectionData);
```

Response will be an instance of [`DeleteCollectionResultData`](src/Data/ResultData/DeleteCollectionResultData.php) object.

<details>
<summary>This is the sample DeleteCollectionResultData:</summary>

```php
DeleteCollectionResultData(
    statusCode: 200,
    metadata: MetadataData(
        statusCode: 200,
        effectiveUri: "https://rekognition.us-east-1.amazonaws.com/",
        headers: [
            "x-amzn-requestid" => "8dc27697-dc77-4d24-9f68-1f5080b536c9",
            "content-type" => "application/x-amz-json-1.1",
            "content-length" => "2658",
            "date" => "Fri, 17 Jan 2025 18:05:24 GMT",
        ],
        transferStats: [
            "http" => [
                [],
            ],
        ],
    ),
);
```
</details>

#### List Collections
Returns the list of collections in the AWS account.

To list collections, you need to create an instance of [`ListCollectionsData`](src/Data/ListCollectionsData.php) object:
```php
// Create a ListCollectionsData object.
$listCollectionsData = new ListCollectionsData(
    maxResults: 10, // Maximum number of collection IDs to return - optional
    nextToken : 'your_next_token', // Pagination token from the previous response - optional
);
```

Then, you can send the request using the `Rekognition` facade `listCollections` method:
```php
$response = Rekognition::listCollections($listCollectionsData);
```

Response will be an instance of [`ListCollectionsResultData`](src/Data/ResultData/ListCollectionsResultData.php) object.

<details>
<summary>This is the sample ListCollectionsResultData:</summary>

```php
ListCollectionsResultData(
    collectionIds: [
        "your_collection_id_0",
        "your_collection_id_1",
    ],
    faceModelVersions: [
        "7.0",
        "7.0",
    ],
    nextToken: "your_next_token",
    metadata: MetadataData(
        statusCode: 200,
        effectiveUri: "https://rekognition.us-east-1.amazonaws.com/",
        headers: [
            "x-amzn-requestid" => "8dc27697-dc77-4d24-9f68-1f5080b536c9",
            "content-type" => "application/x-amz-json-1.1",
            "content-length" => "2658",
            "date" => "Fri, 17 Jan 2025 18:05:24 GMT",
        ],
        transferStats: [
            "http" => [
                [],
            ],
        ],
    ),
);
```
</details>

---
## 💫 Contributing

> **Your contributions are welcome!** If you'd like to improve this package, simply create a pull request with your changes. Your efforts help enhance its functionality and documentation.

> If you find this package useful, please consider ⭐ it to show your support!

## 📜 License
AWS Rekognition API for Laravel is an open-sourced software licensed under the **[MIT license](LICENSE)**.