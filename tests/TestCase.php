<?php

namespace MoeMizrak\Rekognition\Tests;

use MoeMizrak\Rekognition\Facades\Rekognition;
use MoeMizrak\Rekognition\RekognitionServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @param $app
     *
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            RekognitionServiceProvider::class,
        ];
    }

    /**
     * @param $app
     *
     * @return string[]
     */
    protected function getPackageAliases($app): array
    {
        return [
            'Rekognition' => Rekognition::class,
        ];
    }
}