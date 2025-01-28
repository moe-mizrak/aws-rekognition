<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use Spatie\LaravelData\Data;

/**
 * Provides userId metadata along with the confidence in the match of this userId with the input face.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#shape-usermatch
 *
 * @class UserMatchData
 */
final class UserMatchData extends Data
{
    public function __construct(
        /*
         * Describes the userId metadata.
         *
         * @param float|null
         */
        public ?float $similarity = null,

        /*
         * Confidence in the match of this userId with the input face.
         *
         * @param MatchedUserData|null
         */
        public ?MatchedUserData $user = null,
    ) {}
}