
# AWS Rekognition API for Laravel

<br />

[![Latest Version on Packagist](https://img.shields.io/badge/packagist-v1.0-blue)](https://packagist.org/packages/moe-mizrak/aws-rekognition)
<br />

Laravel package for AWS Rekognition API (PHP 8)

## Table of Contents

- [🤖 Requirements](#-requirements)
- [🏁 Get Started](#-get-started)
- [🧩 Configuration](#-configuration)
- [🎨 Usage](#-usage)
- [💫 Contributing](#-contributing)
- [📜 License](#-license)

## 🤖 Requirements
- **PHP 8.2** or **higher**

## 🏁 Get Started
You can **install** the package via composer:
```bash
composer require moe-mizrak/aws-rekognition
```

You can **publish** the **config file** with:
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
After publishing the **aws-rekognition** config file, you'll need to add the following environment variables to your **.env** file:

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

## 💫 Contributing

> **Your contributions are welcome!** f you'd like to improve this package, simply create a pull request with your changes. Your efforts help enhance its functionality and documentation.

> If you find this package useful, please consider ⭐ it to show your support!

## 📜 License
AWS Rekognition API for Laravel is an open-sourced software licensed under the **[MIT license](LICENSE)**.