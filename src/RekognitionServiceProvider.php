<?php

namespace MoeMizrak\Rekognition;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use MoeMizrak\Rekognition\Facades\Rekognition;

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

        // todo modify this part for aws rekognition request
//        $this->app->singleton(ClientInterface::class, function () {
//            return $this->configureClient();
//        });

        $this->app->bind('aws-rekognition', function () {
            return new RekognitionRequest();
        });

        $this->app->bind(RekognitionRequest::class, function () {
            return $this->app->make('aws-rekognition');
        });

        // Register the facade alias.
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
     * Configure the Guzzle client.
     *
     * @return \GuzzleHttp\Client
     */
    private function configureClient(): Client
    {
        // todo implement for aws rekognition request
    }
}