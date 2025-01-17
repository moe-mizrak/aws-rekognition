<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition;

use Aws\Rekognition\RekognitionClient;

/**
 * RekognitionAPI abstract class responsible for encapsulating the RekognitionRequest class.
 *
 * @class Abstract RekognitionAPI
 */
readonly abstract class RekognitionAPI
{
    /**
     * RekognitionAPI constructor.
     *
     * @param RekognitionClient $client
     */
    public function __construct(protected RekognitionClient $client) {}
}