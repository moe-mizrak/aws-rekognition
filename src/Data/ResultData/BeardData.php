<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

/**
 * Indicates whether or not the face has a beard, and the confidence level in the determination.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-beard
 *
 * @class BeardData
 */
final class BeardData extends BaseValueConfidenceData {}