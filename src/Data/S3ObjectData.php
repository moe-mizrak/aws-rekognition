<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use Spatie\LaravelData\Data;

/**
 * Identifies an S3 object as the image source.
 * WARNING: The region for the S3 bucket containing the S3 object must match the region you use for Amazon Rekognition operations.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-s3object
 *
 * @class S3ObjectData
 */
final class S3ObjectData extends Data
{
    public function __construct(
        /*
         * Name of the S3 bucket.
         *
         * @param string|null
         */
        public ?string $bucket = null,

        /*
         * S3 object key name.
         *
         * @param string|null
         */
        public ?string $name = null,

        /*
         * If the bucket is versioning enabled, you can specify the object version.
         *
         * @param string|null
         */
        public ?string $version = null
    ) {}

    /**
     * Convert the data to an AWS Rekognition array format, excluding null values.
     *
     * @return array
     */
    public function toRekognitionDataFormat(): array
    {
        return array_filter(
            [
                'Bucket'  => $this->bucket,
                'Name'    => $this->name,
                'Version' => $this->version,
            ],
            fn ($value) => $value !== null
        );
    }
}