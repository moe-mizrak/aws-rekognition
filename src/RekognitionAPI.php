<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition;

use Aws\Rekognition\RekognitionClient;
use MoeMizrak\Rekognition\Helpers\RekognitionHelper;

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
     * @param RekognitionHelper $rekognitionHelper
     */
    public function __construct(
        protected RekognitionClient $client,
        protected RekognitionHelper $rekognitionHelper,
    ) {}
}