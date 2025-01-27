<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * Structure containing attributes of the face that the algorithm detected.
 * A FaceDetail object contains either the default facial attributes or all facial attributes.
 * The default attributes are BoundingBox, Confidence, Landmarks, Pose, and Quality.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-facedetail
 *
 * @class FaceDetailData
 */
final class FaceDetailData extends Data
{
    public function __construct(
        /*
         * Confidence level that the bounding box contains a face (and not a different object such as a tree).
         *
         * @param float|null
         */
        public ?float $confidence = null,

        /*
         * Bounding box of the face.
         *
         * @param BoundingBoxData|null
         */
        public ?BoundingBoxData $boundingBox = null,

        /*
         * The estimated age range, in years, for the face.
         *  'low' represents the lowest estimated age and 'high' represents the highest estimated age.
         *
         * @param AgeRangeData|null
         */
        public ?AgeRangeData $ageRange = null,

        /*
         * The emotions that appear to be expressed on the face, and the confidence level in the determination.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(EmotionData::class)]
        public ?DataCollection $emotions = null,

        /*
         * Indicates the direction the eyes are gazing in, as defined by pitch and yaw.
         *
         * @param SmileData|null
         */
        public ?EyeDirectionData $eyeDirection = null,

        /*
         * Indicates whether the face is wearing eyeglasses, and the confidence level in the determination.
         *
         * @param EyeglassesData|null
         */
        public ?EyeglassesData $eyeglasses = null,

        /*
         * Indicates whether the eyes on the face are open, and the confidence level in the determination.
         *
         * @param EyesOpenData|null
         */
        public ?EyesOpenData $eyesOpen = null,

        /*
         * FaceOccluded should return "true" with a high confidence score if a detected face’s eyes, nose, and mouth are partially captured or if they are covered by masks, dark sunglasses, cell phones, hands, or other objects.
         * You can use FaceOccluded to determine if an obstruction on a face negatively impacts using the image for face matching.
         *
         * @param FaceOccludedData|null
         */
        public ?FaceOccludedData $faceOccluded = null,

        /*
         * The predicted gender of a detected face.
         *
         * @param GenderData|null
         */
        public ?GenderData $gender = null,

        /*
         * Indicates the location of landmarks on the face. Default attribute.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(LandmarkData::class)]
        public ?DataCollection $landmarks = null,

        /*
         * Indicates whether the mouth on the face is open, and the confidence level in the determination.
         *
         * @param MouthOpenData|null
         */
        public ?MouthOpenData $mouthOpen = null,

        /*
         * Indicates whether or not the face has a beard, and the confidence level in the determination.
         *
         * @param BeardData|null
         */
        public ?BeardData $beard = null,

        /*
         * Indicates whether or not the face has a mustache, and the confidence level in the determination.
         *
         * @param MustacheData|null
         */
        public ?MustacheData $mustache = null,

        /*
         * Indicates the pose of the face as determined by its pitch, roll, and yaw.
         *
         * @param PoseData|null
         */
        public ?PoseData $pose = null,

        /*
         * Identifies image brightness and sharpness.
         *
         * @param QualityData|null
         */
        public ?QualityData $quality = null,

        /*
         * Indicates whether or not the face is smiling, and the confidence level in the determination.
         *
         * @param SmileData|null
         */
        public ?SmileData $smile = null,

        /*
         * Indicates whether or not the face is wearing sunglasses, and the confidence level in the determination.
         *
         * @param SunglassesData|null
         */
        public ?SunglassesData $sunglasses = null,
    ) {}
}