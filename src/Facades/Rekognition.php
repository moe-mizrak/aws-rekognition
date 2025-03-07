<?php

declare(strict_types=1);

namespace MoeMizrak\Rekognition\Facades;

use Illuminate\Support\Facades\Facade;
use MoeMizrak\Rekognition\Data\AssociateFacesData;
use MoeMizrak\Rekognition\Data\CreateCollectionData;
use MoeMizrak\Rekognition\Data\UserData;
use MoeMizrak\Rekognition\Data\DeleteCollectionData;
use MoeMizrak\Rekognition\Data\DetectLabelsData;
use MoeMizrak\Rekognition\Data\IndexFacesData;
use MoeMizrak\Rekognition\Data\ListCollectionsData;
use MoeMizrak\Rekognition\Data\ResultData\AssociateFacesResultData;
use MoeMizrak\Rekognition\Data\ResultData\CreateCollectionResultData;
use MoeMizrak\Rekognition\Data\ResultData\UserResultData;
use MoeMizrak\Rekognition\Data\ResultData\DeleteCollectionResultData;
use MoeMizrak\Rekognition\Data\ResultData\IndexFacesResultData;
use MoeMizrak\Rekognition\Data\ResultData\ListCollectionsResultData;
use MoeMizrak\Rekognition\Data\ResultData\DetectLabelsResultData;
use MoeMizrak\Rekognition\Data\ResultData\SearchUsersByImageResultData;
use MoeMizrak\Rekognition\Data\SearchUsersByImageData;

/**
 * Facade for AWS Rekognition.
 *
 * @method static DetectLabelsResultData detectLabels(DetectLabelsData $detectLabelsData) Detects instances of real-world labels within an image (JPEG or PNG) provided as input.
 * @method static CreateCollectionResultData createCollection(CreateCollectionData $createCollectionData) Creates a collection in an AWS Region.
 * @method static DeleteCollectionResultData deleteCollection(DeleteCollectionData $deleteCollectionData) Deletes the specified collection. Warning! Note that this operation removes all faces in the collection.
 * @method static ListCollectionsResultData listCollections(ListCollectionsData $listCollectionsData) Lists the collections in an AWS account.
 * @method static UserResultData createUser(UserData $createUserData) Creates a new User within a collection specified by collectionId. Takes userId as a parameter, which is a user provided id which should be unique within the collection.
 * @method static UserResultData deleteUser(UserData $deleteUserData) Deletes a User within a collection. Faces that are associated with the userId are disassociated from the userId before deleting the specified userId.
 * @method static IndexFacesResultData indexFaces(IndexFacesData $indexFacesData) Detects faces in the input image and adds them to the specified collection.
 * @method static AssociateFacesResultData associateFaces(AssociateFacesData $associateFacesData) Associates one or more faces with an existing userId in a collection.
 * @method static SearchUsersByImageResultData searchUsersByImage(SearchUsersByImageData $searchUsersByImageData) Searches for userIds using a supplied image. It first detects the largest face in the image, and then searches a specified collection for matching userIds.
 *
 * For more information, see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-rekognition-2016-06-27.html
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