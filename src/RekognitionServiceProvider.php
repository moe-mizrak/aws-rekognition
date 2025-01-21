<?php

namespace MoeMizrak\Rekognition;

use Aws\Rekognition\RekognitionClient;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use MoeMizrak\Rekognition\Facades\Rekognition;
use MoeMizrak\Rekognition\Helpers\RekognitionHelper;

/**
 * Service provider for Rekognition.
 *
 * @class RekognitionServiceProvider
 */
class RekognitionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPublishing();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->configure();

        /*
         * Bind the RekognitionClient to the container so that it can be mocked for testing.
         */
        $this->app->bind(RekognitionClient::class, function () {
            return $this->rekognitionClient();
        });

        /*
         * When Facade is called, it will return an instance of RekognitionRequest.
         */
        $this->app->bind('aws-rekognition', function () {
            return new RekognitionRequest(
                $this->app->make(RekognitionClient::class),
                new RekognitionHelper(),
            );
        });

        /*
         * When RekognitionRequest is called, it will make aws-rekognition which is an instance of RekognitionRequest as described above.
         */
        $this->app->bind(RekognitionRequest::class, function () {
            return $this->app->make('aws-rekognition');
        });

        /*
         * Register the facade alias.
         */
        AliasLoader::getInstance()->alias('Rekognition', Rekognition::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['aws-rekognition'];
    }

    /**
     * Setup the configuration.
     *
     * @return void
     */
    protected function configure(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/aws-rekognition.php', 'aws-rekognition'
        );
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/aws-rekognition.php' => config_path('aws-rekognition.php'),
            ], 'aws-rekognition');
        }
    }

    /**
     * Configure the RekognitionClient.
     *
     * @return RekognitionClient
     */
    private function rekognitionClient(): RekognitionClient
    {
        // Set the options for the RekognitionClient.
        $options = [
            'credentials' => [
                'key'    => config('aws-rekognition.credentials.key'),
                'secret' => config('aws-rekognition.credentials.secret'),
            ],
            'region'      => config('aws-rekognition.region'),
            'version'     => config('aws-rekognition.version'),
        ];

        /*
         * Create and return a RekognitionClient client.
         * For more info: https://github.com/aws/aws-sdk-php
         */
        return new RekognitionClient($options);
    }
}