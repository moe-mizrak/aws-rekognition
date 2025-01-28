<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Data\ResultData;

use JetBrains\PhpStorm\ExpectedValues;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * AssociateFacesResultData is the class that forms the response data of the associateFaces method.
 * For more info: https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html#associatefaces
 *
 * @class AssociateFacesResultData
 */
final class AssociateFacesResultData extends Data
{
    public function __construct(
        /*
         * A collection of AssociatedFaceData objects containing faceIds that have been successfully associated with the userId.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(AssociatedFaceData::class)]
        public ?DataCollection $associatedFaces = null,

        /*
         * A collection of UnsuccessfulAssociationData objects containing faceIds that are not successfully associated along with the reasons.
         *
         * @param DataCollection|null
         */
        #[DataCollectionOf(UnsuccessfulFaceAssociationData::class)]
        public ?DataCollection $unsuccessfulFaceAssociations = null,

        /*
         * The status of an update made to a userId. Reflects if the userId has been updated for every requested change.
         *
         * @param string|null
         */
        #[ExpectedValues(['ACTIVE', 'UPDATING', 'CREATING', 'CREATED'])]
        public ?string $userStatus = null,

        /*
         * Metadata about the request.
         *
         * @param MetaData|null
         */
        public ?MetaData $metadata = null,
    ) {}
}