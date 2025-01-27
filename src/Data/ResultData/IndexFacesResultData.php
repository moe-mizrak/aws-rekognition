<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * IndexFacesResultData is the DTO for the response of the Rekognition API indexFaces request.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#indexfaces
 *
 * @class IndexFacesResultData
 */
final class IndexFacesResultData extends Data
{
    public function __construct(
        /*
         * The version number of the face detection model that's associated with the input collection (CollectionId).
         *
         * @param string|null
         */
        public ?string $faceModelVersion = null,

        /*
         * An array of faces in the input image that are indexed.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(FaceRecordData::class)]
        public ?DataCollection $faceRecords = null,

        /*
         * An array of faces that were detected in the image but weren't indexed.
         * They weren't indexed because the quality filter identified them as low quality, or the MaxFaces request parameter filtered them out.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(UnindexedFaceData::class)]
        public ?DataCollection $unindexedFaces = null,

        /*
         * The value of orientationCorrection is always null.
         * If the input image is in .jpeg format, it might contain exchangeable image file format (Exif) metadata that includes the image's orientation.
         * Amazon Rekognition uses this orientation information to perform image correction.
         * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#indexfaces
         *
         * @param string|null
         */
        public ?string $orientationCorrection = null,

        /*
         * Metadata about the request.
         *
         * @param MetaData|null
         */
        public ?MetaData $metadata = null,
    ) {}
}