<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

final class FaceMatchData extends Data
{
    public function __construct(
        /*
         * Details about the face that matched.
         *
         * @param FaceData|null
         */
        public ?FaceData $face = null,

        /*
         * Similarity score (0-100) between the input face and the matched face.
         *
         * @param float|null
         */
        public ?float $similarity = null,
    ) {}
}
