<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

/**
 * Indicates whether or not the face has a mustache, and the confidence level in the determination.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-mustache
 *
 *
 * @class MustacheData
 */
final class MustacheData extends BaseValueConfidenceData {}