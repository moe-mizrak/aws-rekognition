<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * MetaData is for metadata of the result such as status code, effective uri, headers and transfer stats.
 *
 * @class MetaData
 */
final class MetaData extends Data
{
    public function __construct(
        /*
         * The HTTP status code of the response.
         * e.g. 200
         *
         * @param int|null
         */
        public ?int $statusCode = null,

        /*
         * The effective URI of the request.
         * e.g. https://rekognition.us-east-1.amazonaws.com
         *
         * @param string|null
         */
        public ?string $effectiveUri = null,

        /*
         * The headers of the response.
         *
         * @param array|null
         */
        public ?array $headers = null,

        /*
         * The transfer stats of the response.
         *
         * @param array|null
         */
        public ?array $transferStats = null,
    ) {}
}