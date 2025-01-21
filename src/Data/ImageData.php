<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data;

use MoeMizrak\Rekognition\Data\Contracts\RekognitionDataFormatInterface;
use Spatie\LaravelData\Data;

/**
 * Provides the input image either as bytes or an S3 object.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-image
 * Also check: https://docs.aws.amazon.com/rekognition/latest/dg/images-information.html
 *
 * @class ImageData
 */
final class ImageData extends Data implements RekognitionDataFormatInterface
{
    public function __construct(
        /*
         * Blob of image bytes up to 5 MBs.
         *
         * @param string|resource|StreamInterface|null
         */
        public mixed $bytes = null,

        /*
         * Identifies an S3 object as the image source.
         *
         * @param S3ObjectData|null
         */
        public ?S3ObjectData $s3Object = null
    ) {}

    /**
     * @inheritDoc
     */
    public function toRekognitionDataFormat(): array
    {
        return array_filter(
            [
                'Bytes'    => $this->bytes,
                'S3Object' => $this->s3Object?->toRekognitionDataFormat(),
            ],
            fn ($value) => $value !== null
        );
    }
}