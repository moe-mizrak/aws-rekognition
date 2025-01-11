<?php

namespace MoeMizrak\Rekognition\Tests;

use MoeMizrak\Rekognition\Facades\Rekognition;
use MoeMizrak\Rekognition\RekognitionRequest;
use PHPUnit\Framework\Attributes\Test;

class RekognitionRequestTest extends TestCase
{
    private RekognitionRequest $rekognition;

    public function setUp(): void
    {
        parent::setUp();

        $this->rekognition = $this->app->make(RekognitionRequest::class);
    }

    #[Test]
    public function it_test()
    {
        /* SETUP */

        /* EXECUTE */
        $response = $this->rekognition->test();
        dd($response);

        /* ASSERT */
    }

    #[Test]
    public function it_test_facade()
    {
        /* SETUP */

        /* EXECUTE */
        $response = Rekognition::test();
        dd($response);

        /* ASSERT */
    }
}