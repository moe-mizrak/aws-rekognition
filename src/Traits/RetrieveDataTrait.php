<?php

namespace MoeMizrak\Rekognition\Traits;

use Illuminate\Support\Arr;
use MoeMizrak\Rekognition\Data\ResultData\AgeRangeData;
use MoeMizrak\Rekognition\Data\ResultData\AliasData;
use MoeMizrak\Rekognition\Data\ResultData\AssociatedFaceData;
use MoeMizrak\Rekognition\Data\ResultData\BackgroundData;
use MoeMizrak\Rekognition\Data\ResultData\BeardData;
use MoeMizrak\Rekognition\Data\ResultData\BoundingBoxData;
use MoeMizrak\Rekognition\Data\ResultData\CategoryData;
use MoeMizrak\Rekognition\Data\ResultData\DominantColorsData;
use MoeMizrak\Rekognition\Data\ResultData\EmotionData;
use MoeMizrak\Rekognition\Data\ResultData\EyeDirectionData;
use MoeMizrak\Rekognition\Data\ResultData\EyeglassesData;
use MoeMizrak\Rekognition\Data\ResultData\EyesOpenData;
use MoeMizrak\Rekognition\Data\ResultData\FaceData;
use MoeMizrak\Rekognition\Data\ResultData\FaceDetailData;
use MoeMizrak\Rekognition\Data\ResultData\FaceOccludedData;
use MoeMizrak\Rekognition\Data\ResultData\FaceRecordData;
use MoeMizrak\Rekognition\Data\ResultData\ForegroundData;
use MoeMizrak\Rekognition\Data\ResultData\GenderData;
use MoeMizrak\Rekognition\Data\ResultData\ImagePropertiesData;
use MoeMizrak\Rekognition\Data\ResultData\InstanceData;
use MoeMizrak\Rekognition\Data\ResultData\LabelData;
use MoeMizrak\Rekognition\Data\ResultData\LandmarkData;
use MoeMizrak\Rekognition\Data\ResultData\MatchedUserData;
use MoeMizrak\Rekognition\Data\ResultData\MetaData;
use MoeMizrak\Rekognition\Data\ResultData\MouthOpenData;
use MoeMizrak\Rekognition\Data\ResultData\MustacheData;
use MoeMizrak\Rekognition\Data\ResultData\ParentData;
use MoeMizrak\Rekognition\Data\ResultData\PoseData;
use MoeMizrak\Rekognition\Data\ResultData\QualityData;
use MoeMizrak\Rekognition\Data\ResultData\SearchedFaceData;
use MoeMizrak\Rekognition\Data\ResultData\SmileData;
use MoeMizrak\Rekognition\Data\ResultData\SunglassesData;
use MoeMizrak\Rekognition\Data\ResultData\UnindexedFaceData;
use MoeMizrak\Rekognition\Data\ResultData\UnsearchedFaceData;
use MoeMizrak\Rekognition\Data\ResultData\UnsuccessfulFaceAssociationData;
use MoeMizrak\Rekognition\Data\ResultData\UserMatchData;
use Spatie\LaravelData\DataCollection;

/**
 * Trait RetrieveDataTrait for retrieving the data from the response of the Rekognition API in order to populate the data objects.
 *
 * @class RetrieveDataTrait
 */
trait RetrieveDataTrait
{
    /**
     * Retrieves the unindexed faces of the response including face detail and reasons.
     *
     * @param array $response
     *
     * @return DataCollection
     */
    protected function retrieveUnindexedFaces(array $response): DataCollection
    {
        $unindexedFaces = [];
        $returnedUnindexedFaces = Arr::get($response, 'UnindexedFaces', []);

        foreach ($returnedUnindexedFaces as $returnedUnindexedFace) {
            $reasons = Arr::get($returnedUnindexedFace, 'Reasons');

            $unindexedFace = new UnindexedFaceData(
                faceDetail: $this->retrieveFaceDetailData($returnedUnindexedFace),
                reasons   : $reasons,
            );

            $unindexedFaces[] = $unindexedFace;
        }

        return new DataCollection(UnindexedFaceData::class, $unindexedFaces);
    }

    /**
     * Retrieves the face records of the response including face and face detail data.
     *
     * @param array $response
     *
     * @return DataCollection
     */
    protected function retrieveFaceRecords(array $response): DataCollection
    {
        $faceRecords = [];
        $returnedFaceRecords = Arr::get($response, 'FaceRecords', []);

        foreach ($returnedFaceRecords as $returnedFaceRecord) {
            // Create a face record data object and add it to the face records array.
            $faceRecord = new FaceRecordData(
                face      : $this->retrieveFaceData($returnedFaceRecord),
                faceDetail: $this->retrieveFaceDetailData($returnedFaceRecord),
            );

            $faceRecords[] = $faceRecord;
        }

        return new DataCollection(FaceRecordData::class, $faceRecords);
    }

    /**
     * Retrieves the face detail data including:
     * confidence, bounding box, age range, emotions, eye direction, eyeglasses, eyes open, face occluded, gender, landmarks, mouth open, beard, mustache, pose, quality, smile, and sunglasses.
     *
     * @param array|null $returnedArray
     *
     * @return FaceDetailData
     */
    private function retrieveFaceDetailData(?array $returnedArray): FaceDetailData
    {
        // Retrieve the face detail data.
        $returnedFaceDetail = Arr::get($returnedArray, 'FaceDetail');

        return new FaceDetailData(
            confidence  : Arr::get($returnedFaceDetail, 'Confidence'),
            boundingBox : $this->retrieveBoundingBoxData($returnedFaceDetail),
            ageRange    : $this->retrieveAgeRangeData($returnedFaceDetail),
            emotions    : $this->retrieveEmotions($returnedFaceDetail),
            eyeDirection: $this->retrieveEyeDirectionData($returnedFaceDetail),
            eyeglasses  : $this->retrieveEyeglassesData($returnedFaceDetail),
            eyesOpen    : $this->retrieveEyesOpenData($returnedFaceDetail),
            faceOccluded: $this->retrieveFaceOccludedData($returnedFaceDetail),
            gender      : $this->retrieveGenderData($returnedFaceDetail),
            landmarks   : $this->retrieveLandmarks($returnedFaceDetail),
            mouthOpen   : $this->retrieveMouthOpenData($returnedFaceDetail),
            beard       : $this->retrieveBeardData($returnedFaceDetail),
            mustache    : $this->retrieveMustacheData($returnedFaceDetail),
            pose        : $this->retrievePoseData($returnedFaceDetail),
            quality     : $this->retrieveQualityData($returnedFaceDetail),
            smile       : $this->retrieveSmileData($returnedFaceDetail),
            sunglasses  : $this->retrieveSunglassesData($returnedFaceDetail),
        );
    }

    /**
     * Retrieves the face data including confidence, bounding box, face id, image id, user id, external image id, and index faces model version.
     *
     * @param array|null $returnedArray
     *
     * @return FaceData
     */
    private function retrieveFaceData(?array $returnedArray): FaceData
    {
        // Retrieve the face data.
        $returnedFace = Arr::get($returnedArray, 'Face');

        return new FaceData(
            confidence            : Arr::get($returnedFace, 'Confidence'),
            boundingBox           : $this->retrieveBoundingBoxData($returnedFace),
            faceId                : Arr::get($returnedFace, 'FaceId'),
            imageId               : Arr::get($returnedFace, 'ImageId'),
            userId                : Arr::get($returnedFace, 'UserId'),
            externalImageId       : Arr::get($returnedFace, 'ExternalImageId'),
            indexFacesModelVersion: Arr::get($returnedFace, 'IndexFacesModelVersion'),
        );
    }

    /**
     * Retrieves the emotions data including confidence and type.
     *
     * @param array|null $returnedArray
     *
     * @return DataCollection
     */
    protected function retrieveEmotions(?array $returnedArray): DataCollection
    {
        $emotions = [];
        $returnedEmotions = Arr::get($returnedArray, 'Emotions', []);

        foreach ($returnedEmotions as $returnedEmotion) {
            $emotion = new EmotionData(
                confidence: Arr::get($returnedEmotion, 'Confidence'),
                type      : Arr::get($returnedEmotion, 'Type'),
            );

            $emotions[] = $emotion;
        }

        return new DataCollection(EmotionData::class, $emotions);
    }

    /**
     * Retrieves the landmarks data including type, x, and y.
     *
     * @param array|null $returnedArray
     *
     * @return DataCollection
     */
    protected function retrieveLandmarks(?array $returnedArray): DataCollection
    {
        $landmarks = [];
        $returnedLandmarks = Arr::get($returnedArray, 'Landmarks', []);

        foreach ($returnedLandmarks as $returnedLandmark) {

            $landmark = new LandmarkData(
                type: Arr::get($returnedLandmark, 'Type'),
                x   : Arr::get($returnedLandmark, 'X'),
                y   : Arr::get($returnedLandmark, 'Y'),
            );

            $landmarks[] = $landmark;
        }

        return new DataCollection(LandmarkData::class, $landmarks);
    }

    /**
     * Retrieves the age range data including low and high.
     *
     * @param array|null $returnedArray
     *
     * @return AgeRangeData
     */
    protected function retrieveAgeRangeData(?array $returnedArray): AgeRangeData
    {
        $returnedAgeRange = Arr::get($returnedArray, 'AgeRange');

        return new AgeRangeData(
            low : Arr::get($returnedAgeRange, 'Low'),
            high: Arr::get($returnedAgeRange, 'High'),
        );
    }

    /**
     * Retrieves the beard data including confidence and value.
     *
     * @param array|null $returnedArray
     *
     * @return BeardData
     */
    protected function retrieveBeardData(?array $returnedArray): BeardData
    {
        $returnedBeard = Arr::get($returnedArray, 'Beard');

        return new BeardData(
            confidence: Arr::get($returnedBeard, 'Confidence'),
            value     : Arr::get($returnedBeard, 'Value'),
        );
    }

    /**
     * Retrieves the eye direction data including confidence, yaw, and pitch.
     *
     * @param array|null $returnedArray
     *
     * @return EyeDirectionData
     */
    protected function retrieveEyeDirectionData(?array $returnedArray): EyeDirectionData
    {
        $returnedEyeDirection = Arr::get($returnedArray, 'EyeDirection');

        return new EyeDirectionData(
            confidence: Arr::get($returnedEyeDirection, 'Confidence'),
            yaw       : Arr::get($returnedEyeDirection, 'Yaw'),
            pitch     : Arr::get($returnedEyeDirection, 'Pitch'),
        );
    }

    /**
     * Retrieves the eyeglasses data including confidence and value.
     *
     * @param array|null $returnedArray
     *
     * @return EyeglassesData
     */
    protected function retrieveEyeglassesData(?array $returnedArray): EyeglassesData
    {
        $returnedEyeglasses = Arr::get($returnedArray, 'Eyeglasses');

        return new EyeglassesData(
            confidence: Arr::get($returnedEyeglasses, 'Confidence'),
            value     : Arr::get($returnedEyeglasses, 'Value'),
        );
    }

    /**
     * Retrieves the eyes open data including confidence and value.
     *
     * @param array|null $returnedArray
     *
     * @return EyesOpenData
     */
    protected function retrieveEyesOpenData(?array $returnedArray): EyesOpenData
    {
        $returnedEyesOpen = Arr::get($returnedArray, 'EyesOpen');

        return new EyesOpenData(
            confidence: Arr::get($returnedEyesOpen, 'Confidence'),
            value     : Arr::get($returnedEyesOpen, 'Value'),
        );
    }

    /**
     * Retrieves the face occluded data including confidence and value.
     *
     * @param array|null $returnedArray
     *
     * @return FaceOccludedData
     */
    protected function retrieveFaceOccludedData(?array $returnedArray): FaceOccludedData
    {
        $returnedFaceOccluded = Arr::get($returnedArray, 'FaceOccluded');

        return new FaceOccludedData(
            confidence: Arr::get($returnedFaceOccluded, 'Confidence'),
            value     : Arr::get($returnedFaceOccluded, 'Value'),
        );
    }

    /**
     * Retrieves the gender data including confidence and value.
     *
     * @param array|null $returnedArray
     *
     * @return GenderData
     */
    protected function retrieveGenderData(?array $returnedArray): GenderData
    {
        $returnedGender = Arr::get($returnedArray, 'Gender');

        return new GenderData(
            confidence: Arr::get($returnedGender, 'Confidence'),
            value     : Arr::get($returnedGender, 'Value'),
        );
    }

    /**
     * Retrieves the mouth open data including confidence and value.
     *
     * @param array|null $returnedArray
     *
     * @return MouthOpenData
     */
    protected function retrieveMouthOpenData(?array $returnedArray): MouthOpenData
    {
        $returnedMouthOpen = Arr::get($returnedArray, 'MouthOpen');

        return new MouthOpenData(
            confidence: Arr::get($returnedMouthOpen, 'Confidence'),
            value     : Arr::get($returnedMouthOpen, 'Value'),
        );
    }

    /**
     * Retrieves the mustache data including confidence and value.
     *
     * @param array|null $returnedArray
     *
     * @return MustacheData
     */
    protected function retrieveMustacheData(?array $returnedArray): MustacheData
    {
        $returnedMustache = Arr::get($returnedArray, 'Mustache');

        return new MustacheData(
            confidence: Arr::get($returnedMustache, 'Confidence'),
            value     : Arr::get($returnedMustache, 'Value'),
        );
    }

    /**
     * Retrieves the pose data including roll, yaw, and pitch.
     *
     * @param array|null $returnedArray
     *
     * @return PoseData
     */
    protected function retrievePoseData(?array $returnedArray): PoseData
    {
        $returnedPose = Arr::get($returnedArray, 'Pose');

        return new PoseData(
            roll : Arr::get($returnedPose, 'Roll'),
            yaw  : Arr::get($returnedPose, 'Yaw'),
            pitch: Arr::get($returnedPose, 'Pitch'),
        );
    }

    /**
     * Retrieves the quality data including brightness, contrast, and sharpness.
     *
     * @param array|null $returnedArray
     *
     * @return QualityData
     */
    protected function retrieveQualityData(?array $returnedArray): QualityData
    {
        $returnedQuality = Arr::get($returnedArray, 'Quality');

        return new QualityData(
            brightness: Arr::get($returnedQuality, 'Brightness'),
            contrast  : Arr::get($returnedQuality, 'Contrast'),
            sharpness : Arr::get($returnedQuality, 'Sharpness'),
        );
    }

    /**
     * Retrieves the smile data including confidence and value.
     *
     * @param array|null $returnedArray
     *
     * @return SmileData
     */
    protected function retrieveSmileData(?array $returnedArray): SmileData
    {
        $returnedSmile = Arr::get($returnedArray, 'Smile');

        return new SmileData(
            confidence: Arr::get($returnedSmile, 'Confidence'),
            value     : Arr::get($returnedSmile, 'Value'),
        );
    }

    /**
     * Retrieves the sunglasses data including confidence and value.
     *
     * @param array|null $returnedArray
     *
     * @return SunglassesData
     */
    protected function retrieveSunglassesData(?array $returnedArray): SunglassesData
    {
        $returnedSunglasses = Arr::get($returnedArray, 'Sunglasses');

        return new SunglassesData(
            confidence: Arr::get($returnedSunglasses, 'Confidence'),
            value     : Arr::get($returnedSunglasses, 'Value'),
        );
    }

    /**
     * Retrieves the bounding box data including height, left, top, and width.
     *
     * @param array|null $returnedArray
     *
     * @return BoundingBoxData|null
     */
    protected function retrieveBoundingBoxData(?array $returnedArray): ?BoundingBoxData
    {
        $returnedBoundingBox = Arr::get($returnedArray, 'BoundingBox');

        return new BoundingBoxData(
            height: Arr::get($returnedBoundingBox, 'Height'),
            left  : Arr::get($returnedBoundingBox, 'Left'),
            top   : Arr::get($returnedBoundingBox, 'Top'),
            width : Arr::get($returnedBoundingBox, 'Width'),
        );
    }

    /**
     * Retrieves the metadata of the response including status code, effective uri, headers, and transfer stats.
     *
     * @param array $response
     *
     * @return MetaData
     */
    protected function retrieveMetaData(array $response): MetaData
    {
        return new MetaData(
            statusCode   : Arr::get($response, '@metadata.statusCode'),
            effectiveUri : Arr::get($response, '@metadata.effectiveUri'),
            headers      : Arr::get($response, '@metadata.headers'),
            transferStats: Arr::get($response, '@metadata.transferStats'),
        );
    }

    /**
     * Retrieves the image properties of the response including background, dominant colors, foreground, and quality.
     *
     * @param array $response
     *
     * @return ImagePropertiesData
     */
    protected function retrieveImageProperties(array $response): ImagePropertiesData
    {
        $dominantColors = [];
        $returnedImageProperties = Arr::get($response, 'ImageProperties', []);
        $returnedDominantColors = Arr::get($returnedImageProperties, 'DominantColors', []);

        // Map the dominant colors data and add them to the dominant colors array.
        foreach ($returnedDominantColors as $returnedDominantColor) {
            $returnedDominantColor = new DominantColorsData(
                blue           : Arr::get($returnedDominantColor, 'Blue'),
                cssColor       : Arr::get($returnedDominantColor, 'CSSColor'),
                green          : Arr::get($returnedDominantColor, 'Green'),
                hexCode        : Arr::get($returnedDominantColor, 'HexCode'),
                pixelPercent   : Arr::get($returnedDominantColor, 'PixelPercent'),
                red            : Arr::get($returnedDominantColor, 'Red'),
                simplifiedColor: Arr::get($returnedDominantColor, 'SimplifiedColor'),
            );

            $dominantColors[] = $returnedDominantColor;
        }

        $returnedQuality = Arr::get($returnedImageProperties, 'Quality');

        $quality = new QualityData(
            brightness: Arr::get($returnedQuality, 'Brightness'),
            contrast  : Arr::get($returnedQuality, 'Contrast'),
            sharpness : Arr::get($returnedQuality, 'Sharpness'),
        );

        return new ImagePropertiesData(
            background    : $this->retrieveBackgroundImageProperty($returnedImageProperties),
            dominantColors: new DataCollection(DominantColorsData::class, $dominantColors),
            foreground    : $this->retrieveForegroundImageProperty($returnedImageProperties),
            quality       : $quality,
        );
    }

    /**
     * Retrieves the foreground image property including dominant colors and quality.
     *
     * @param array|null $returnedImageProperties
     *
     * @return ForegroundData
     */
    protected function retrieveForegroundImageProperty(?array $returnedImageProperties): ForegroundData
    {
        $returnedForeground = Arr::get($returnedImageProperties, 'Foreground');
        $returnedForegroundDominantColors = Arr::get($returnedForeground, 'DominantColors');
        $returnedQuality = Arr::get($returnedForeground, 'Quality');

        return new ForegroundData(
            dominantColors: $this->mapDominantColors($returnedForegroundDominantColors),
            quality       : $this->mapQualityData($returnedQuality),
        );
    }

    /**
     * Retrieves the background image property including dominant colors and quality.
     *
     * @param array|null $returnedImageProperties
     *
     * @return BackgroundData
     */
    protected function retrieveBackgroundImageProperty(?array $returnedImageProperties): BackgroundData
    {
        $returnedBackground = Arr::get($returnedImageProperties, 'Background');
        $returnedBackgroundDominantColors = Arr::get($returnedBackground, 'DominantColors');
        $returnedQuality = Arr::get($returnedBackground, 'Quality');

        return new BackgroundData(
            dominantColors: $this->mapDominantColors($returnedBackgroundDominantColors),
            quality       : $this->mapQualityData($returnedQuality),
        );
    }

    /**
     * Maps the dominant colors data and returns a DataCollection of DominantColorsData.
     *
     * @param array|null $returnedColors
     *
     * @return DataCollection
     */
    private function mapDominantColors(?array $returnedColors): DataCollection
    {
        $dominantColors = array_map(function ($color) {
            return new DominantColorsData(
                blue           : Arr::get($color, 'Blue'),
                cssColor       : Arr::get($color, 'CSSColor'),
                green          : Arr::get($color, 'Green'),
                hexCode        : Arr::get($color, 'HexCode'),
                pixelPercent   : Arr::get($color, 'PixelPercent'),
                red            : Arr::get($color, 'Red'),
                simplifiedColor: Arr::get($color, 'SimplifiedColor'),
            );
        }, $returnedColors ?? []);

        return new DataCollection(DominantColorsData::class, $dominantColors);
    }

    /**
     * Maps the quality data and returns a QualityData object.
     *
     * @param array|null $returnedQuality
     *
     * @return QualityData
     */
    private function mapQualityData(?array $returnedQuality): QualityData
    {
        return new QualityData(
            brightness: Arr::get($returnedQuality, 'Brightness'),
            contrast  : Arr::get($returnedQuality, 'Contrast'),
            sharpness : Arr::get($returnedQuality, 'Sharpness'),
        );
    }

    /**
     * Retrieves the labels of the response including name, confidence, instances, parents, aliases, and categories.
     *
     * @param array $response
     *
     * @return DataCollection
     */
    protected function retrieveLabels(array $response): DataCollection
    {
        $labels = [];
        $returnedLabels = Arr::get($response, 'Labels', []);

        // Loop through the returned labels and map them accordingly.
        foreach ($returnedLabels as $returnedLabel) {
            $instances = [];
            $name = Arr::get($returnedLabel, 'Name');
            $confidence = Arr::get($returnedLabel, 'Confidence');
            $returnedInstances = Arr::get($returnedLabel, 'Instances', []);

            // Loop through the returned instances of the returned label and map them accordingly and add them to the instances array.
            foreach ($returnedInstances as $returnedInstance) {
                $returnedConfidence = Arr::get($returnedInstance, 'Confidence');

                $boundingBox = $this->retrieveBoundingBoxData($returnedInstance);

                $instance = new InstanceData(
                    confidence : $returnedConfidence,
                    boundingBox: $boundingBox,
                );

                $instances[] = $instance;
            }

            $parents = [];
            $returnedParents = Arr::get($returnedLabel, 'Parents', []);

            // Loop through the returned parents and map them accordingly, and add them to the parents array.
            foreach ($returnedParents as $returnedParent) {
                $parent = new ParentData(
                    name: Arr::get($returnedParent, 'Name'),
                );

                $parents[] = $parent;
            }

            $aliases = [];
            $returnedAliases = Arr::get($returnedLabel, 'Aliases', []);

            foreach ($returnedAliases as $returnedAlias) {
                $aliasesItem = new AliasData(
                    name: Arr::get($returnedAlias, 'Name'),
                );

                $aliases[] = $aliasesItem;
            }

            $categories = [];
            $returnedCategories = Arr::get($returnedLabel, 'Categories', []);

            foreach ($returnedCategories as $returnedCategory) {
                $category = new CategoryData(
                    name: Arr::get($returnedCategory, 'Name'),
                );

                $categories[] = $category;
            }

            $label = new LabelData(
                confidence: $confidence,
                aliases   : new DataCollection(AliasData::class, $aliases),
                categories: new DataCollection(CategoryData::class, $categories),
                instances : new DataCollection(InstanceData::class, $instances),
                name      : $name,
                parents   : new DataCollection(ParentData::class, $parents),
            );

            $labels[] = $label;
        }

        return new DataCollection(LabelData::class, $labels);
    }

    /**
     * Retrieves the associated faces of the response including face id.
     *
     * @param array $response
     *
     * @return DataCollection
     */
    protected function retrieveAssociatedFaces(array $response): DataCollection
    {
        $associatedFaces = [];
        $returnedAssociatedFaces = Arr::get($response, 'AssociatedFaces', []);

        foreach ($returnedAssociatedFaces as $returnedAssociatedFace) {
            $associatedFace = new AssociatedFaceData(
                faceId: Arr::get($returnedAssociatedFace, 'FaceId'),
            );

            $associatedFaces[] = $associatedFace;
        }

        return new DataCollection(AssociatedFaceData::class, $associatedFaces);
    }

    /**
     * Retrieves the users of the response including user id and user status.
     *
     * @param array $response
     *
     * @return DataCollection
     */
    protected function retrieveUsers(array $response): DataCollection
    {
        $users = [];
        $returnedUsers = Arr::get($response, 'Users', []);

        foreach ($returnedUsers as $returnedUser) {
            $user = new MatchedUserData(
                userId    : Arr::get($returnedUser, 'UserId'),
                userStatus: Arr::get($returnedUser, 'UserStatus'),
            );

            $users[] = $user;
        }

        return new DataCollection(MatchedUserData::class, $users);
    }

    /**
     * Retrieves the unsuccessful face associations of the response including confidence, face id, reasons, and user id.
     *
     * @param array $response
     *
     * @return DataCollection
     */
    protected function retrieveUnsuccessfulFaceAssociations(array $response): DataCollection
    {
        $unsuccessfulFaceAssociations = [];
        $returnedUnsuccessfulFaceAssociations = Arr::get($response, 'UnsuccessfulFaceAssociations', []);

        foreach ($returnedUnsuccessfulFaceAssociations as $returnedUnsuccessfulFaceAssociation) {
            $unsuccessfulFaceAssociation = new UnsuccessfulFaceAssociationData(
                confidence: Arr::get($returnedUnsuccessfulFaceAssociation, 'Confidence'),
                faceId    : Arr::get($returnedUnsuccessfulFaceAssociation, 'FaceId'),
                reasons   : Arr::get($returnedUnsuccessfulFaceAssociation, 'Reasons'),
                userId    : Arr::get($returnedUnsuccessfulFaceAssociation, 'UserId'),
            );

            $unsuccessfulFaceAssociations[] = $unsuccessfulFaceAssociation;
        }

        return new DataCollection(UnsuccessfulFaceAssociationData::class, $unsuccessfulFaceAssociations);
    }

    /**
     * Retrieves the user matches data of the response including similarity and matched user data.
     *
     * @param array $response
     *
     * @return DataCollection
     */
    protected function retrieveUserMatches(array $response): DataCollection
    {
        $userMatches = [];
        $returnedUserMatches = Arr::get($response, 'UserMatches', []);

        foreach ($returnedUserMatches as $returnedUserMatch) {
            $returnedMatchedUserData = Arr::get($returnedUserMatch, 'User');
            $matchedUser = new MatchedUserData(
                userId    : Arr::get($returnedMatchedUserData, 'UserId'),
                userStatus: Arr::get($returnedMatchedUserData, 'UserStatus'),
            );

            $userMatch = new UserMatchData(
                similarity: Arr::get($returnedUserMatch, 'Similarity'),
                user      : $matchedUser,
            );

            $userMatches[] = $userMatch;
        }

        return new DataCollection(UserMatchData::class, $userMatches);
    }

    /**
     * Retrieves the searched face data of the response including face detail.
     *
     * @param array $response
     *
     * @return SearchedFaceData
     */
    protected function retrieveSearchedFace(array $response): SearchedFaceData
    {
        $returnedSearchedFace = Arr::get($response, 'SearchedFace');

        return new SearchedFaceData(
            faceDetail: $this->retrieveFaceDetailData($returnedSearchedFace),
        );
    }

    /**
     * Retrieves the unsearched faces of the response including face detail and reasons.
     *
     * @param array $response
     *
     * @return DataCollection
     */
    protected function retrieveUnsearchedFaces(array $response): DataCollection
    {
        $unsearchedFaces = [];
        $returnedUnsearchedFaces = Arr::get($response, 'UnsearchedFaces', []);

        foreach ($returnedUnsearchedFaces as $returnedUnsearchedFace) {
            $reasons = Arr::get($returnedUnsearchedFace, 'Reasons');

            /*
             * Warning!
             * Here we are changing the key of the array from 'FaceDetails' to 'FaceDetail'
             * in order to match the key of the retrieveFaceDetailData method which how it is being used any other place in the API response.
             * It might be a bug on the AWS side, or on purpose so we are fixing it here for consistency with the rest of the code.
             */
            $returnedUnsearchedFace = Arr::add(
                array: Arr::except($returnedUnsearchedFace, 'FaceDetails'),
                key  : 'FaceDetail',
                value: Arr::get($returnedUnsearchedFace, 'FaceDetails')
            );

            $unsearchedFace = new UnsearchedFaceData(
                faceDetail: $this->retrieveFaceDetailData($returnedUnsearchedFace),
                reasons   : $reasons,
            );

            $unsearchedFaces[] = $unsearchedFace;
        }

        return new DataCollection(UnsearchedFaceData::class, $unsearchedFaces);
    }
}