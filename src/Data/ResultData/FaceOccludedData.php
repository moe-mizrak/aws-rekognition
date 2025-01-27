<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

/**
 * FaceOccluded should return "true" with a high confidence score if a detected face’s eyes, nose, and mouth are partially captured
 * or if they are covered by masks, dark sunglasses, cell phones, hands, or other objects.
 * FaceOccluded should return "false" with a high confidence score if common occurrences that do not impact face verification are detected,
 * such as eyeglasses, lightly tinted sunglasses, strands of hair, and others.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-faceoccluded
 *
 * @class FaceOccludedData
 */
final class FaceOccludedData extends BaseValueConfidenceData {}