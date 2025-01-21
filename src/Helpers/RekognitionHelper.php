<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Helpers;

use Illuminate\Support\Arr;
use MoeMizrak\Rekognition\Data\ResultData\AliasData;
use MoeMizrak\Rekognition\Data\ResultData\BackgroundData;
use MoeMizrak\Rekognition\Data\ResultData\BoundingBoxData;
use MoeMizrak\Rekognition\Data\ResultData\CategoryData;
use MoeMizrak\Rekognition\Data\ResultData\CreateCollectionResultData;
use MoeMizrak\Rekognition\Data\ResultData\DeleteCollectionResultData;
use MoeMizrak\Rekognition\Data\ResultData\DominantColorsData;
use MoeMizrak\Rekognition\Data\ResultData\ForegroundData;
use MoeMizrak\Rekognition\Data\ResultData\ImagePropertiesData;
use MoeMizrak\Rekognition\Data\ResultData\InstanceData;
use MoeMizrak\Rekognition\Data\ResultData\LabelData;
use MoeMizrak\Rekognition\Data\ResultData\ListCollectionsResultData;
use MoeMizrak\Rekognition\Data\ResultData\MetaData;
use MoeMizrak\Rekognition\Data\ResultData\ParentData;
use MoeMizrak\Rekognition\Data\ResultData\QualityData;
use MoeMizrak\Rekognition\Data\ResultData\DetectLabelsResultData;
use Spatie\LaravelData\DataCollection;

/**
 * Rekognition helper class for separating the logic of forming the response data from the Rekognition API.
 *
 * @class RekognitionHelper
 */
final readonly class RekognitionHelper
{
    /**
     * Forms the Rekognition listCollections response to ListCollectionsResultData including collection ids, face model versions, next token, and metadata.
     *
     * @param array $response
     *
     * @return ListCollectionsResultData
     */
    public function formListCollectionsResponse(array $response): ListCollectionsResultData
    {
        return new ListCollectionsResultData(
            collectionIds     : Arr::get($response, 'CollectionIds'),
            faceModelVersions : Arr::get($response, 'FaceModelVersions'),
            nextToken         : Arr::get($response, 'NextToken'),
            metadata          : $this->retrieveMetaData($response),
        );
    }

    /**
     * Forms the Rekognition deleteCollection response to DeleteCollectionResultData including status code and metadata.
     *
     * @param array $response
     *
     * @return DeleteCollectionResultData
     */
    public function formDeleteCollectionResponse(array $response): DeleteCollectionResultData
    {
        return new DeleteCollectionResultData(
            statusCode: Arr::get($response, 'StatusCode'),
            metadata  : $this->retrieveMetaData($response),
        );
    }

    /**
     * Forms the Rekognition createCollection response to CreateCollectionResultData including collection arn, face model version, status code, and metadata.
     *
     * @param array $response
     *
     * @return CreateCollectionResultData
     */
    public function formCreateCollectionResponse(array $response): CreateCollectionResultData
    {
        return new CreateCollectionResultData(
            collectionArn   : Arr::get($response, 'CollectionArn'),
            faceModelVersion: Arr::get($response, 'FaceModelVersion'),
            statusCode      : Arr::get($response, 'StatusCode'),
            metadata        : $this->retrieveMetaData($response),
        );
    }

    /**
     * Forms the Rekognition detect labels response to DetectLabelsResultData including labels, label model version, orientation correction, image properties, and metadata.
     *
     * @param array $response
     *
     * @return DetectLabelsResultData
     */
    public function formDetectLabelsResponse(array $response): DetectLabelsResultData
    {
        return new DetectLabelsResultData(
            labels               : $this->retrieveLabels($response),
            labelModelVersion    : Arr::get($response, 'LabelModelVersion'),
            orientationCorrection: Arr::get($response, 'OrientationCorrection'),
            imageProperties      : $this->retrieveImageProperties($response),
            metadata             : $this->retrieveMetaData($response),
        );
    }

    /**
     * Retrieves the metadata of the response including status code, effective uri, headers, and transfer stats.
     *
     * @param array $response
     *
     * @return MetaData
     */
    private function retrieveMetaData(array $response): MetaData
    {
        return new MetaData(
            statusCode    : Arr::get($response, '@metadata.statusCode'),
            effectiveUri  : Arr::get($response, '@metadata.effectiveUri'),
            headers       : Arr::get($response, '@metadata.headers'),
            transferStats : Arr::get($response, '@metadata.transferStats'),
        );
    }

    /**
     * Retrieves the image properties of the response including background, dominant colors, foreground, and quality.
     *
     * @param array $response
     *
     * @return ImagePropertiesData
     */
    private function retrieveImageProperties(array $response): ImagePropertiesData
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
    private function retrieveForegroundImageProperty(?array $returnedImageProperties): ForegroundData
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
    private function retrieveBackgroundImageProperty(?array $returnedImageProperties): BackgroundData
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
    private function retrieveLabels(array $response): DataCollection
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
                $returnedBoundingBox = Arr::get($returnedInstance, 'BoundingBox');
                $returnedConfidence = Arr::get($returnedInstance, 'Confidence');

                $boundingBox = new BoundingBoxData(
                    height: Arr::get($returnedBoundingBox, 'Height'),
                    left  : Arr::get($returnedBoundingBox, 'Left'),
                    top   : Arr::get($returnedBoundingBox, 'Top'),
                    width : Arr::get($returnedBoundingBox, 'Width'),
                );

                $instance = new InstanceData(
                    boundingBox: $boundingBox,
                    confidence : $returnedConfidence,
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
                aliases   : new DataCollection(AliasData::class, $aliases),
                categories: new DataCollection(CategoryData::class, $categories),
                confidence: $confidence,
                instances : new DataCollection(InstanceData::class, $instances),
                name      : $name,
                parents   : new DataCollection(ParentData::class, $parents),
            );

            $labels[] = $label;
        }

        return new DataCollection(LabelData::class, $labels);
    }
}