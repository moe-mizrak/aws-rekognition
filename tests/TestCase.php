<?php

namespace MoeMizrak\Rekognition\Tests;

use Aws\Rekognition\RekognitionClient;
use Mockery\MockInterface;
use MoeMizrak\Rekognition\Facades\Rekognition;
use MoeMizrak\Rekognition\RekognitionServiceProvider;
use MoeMizrak\Rekognition\Tests\Traits\MockTrait;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    use MockTrait;

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

    /**
     * Mock the Rekognition client for testing in order to avoid making real requests.
     *
     * @param string $methodName
     *
     * @return void
     */
    protected function mockRekognitionClient(string $methodName): void
    {
        $mockResponse = $this->mockRekognitionResponse($methodName);

        $this->mock(RekognitionClient::class, function (MockInterface $mock) use($methodName, $mockResponse) {
            $mock->shouldReceive($methodName)
                ->once()
                ->andReturn($mockResponse);
        });
    }
}