<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\Contracts;

/**
 * Interface for Rekognition Data Format where it uses capital letter as first letter for the properties.
 * e.g. 'Image' instead of 'image', 'MaxLabels' instead of 'maxLabels'.
 *
 * @class RekognitionDataFormatInterface
 */
interface RekognitionDataFormatInterface
{
    /**
     * Convert the data to an AWS Rekognition array format, excluding null values.
     *
     * @return array
     */
    public function toRekognitionDataFormat(): array;
}