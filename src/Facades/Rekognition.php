<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Facades;

use Illuminate\Support\Facades\Facade;
use MoeMizrak\Rekognition\Data\DetectLabelsData;
use MoeMizrak\Rekognition\Data\ResultData\ResultData;

/**
 * Facade for AWS Rekognition.
 *
 * @method static ResultData detectLabels(DetectLabelsData $detectLabelsData) Detects instances of real-world labels within an image (JPEG or PNG) provided as input.
 *
 * @class Rekognition
 */
final class Rekognition extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'aws-rekognition';
    }
}