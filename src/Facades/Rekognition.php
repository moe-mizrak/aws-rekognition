<?php

namespace MoeMizrak\Rekognition\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for AWS Rekognition.
 */
class Rekognition extends Facade
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