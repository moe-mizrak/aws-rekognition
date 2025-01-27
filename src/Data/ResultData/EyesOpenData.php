<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

/**
 * Indicates whether the eyes on the face are open, and the confidence level in the determination.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-eyeopen
 *
 * @class EyesOpenData
 */
final class EyesOpenData extends BaseValueConfidenceData {}