<?php

namespace Pnlinh\GoogleDistance\Tests;

use Pnlinh\GoogleDistance\Providers\GoogleDistanceServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected $googleApiKey = null;

    public function setUp(): void
    {
        parent::setUp();

        $this->googleApiKey = env('GOOGLE_API_KEY');
    }

    public function getPackageProviders($app)
    {
        return [
            GoogleDistanceServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('google-distance.api_key', 'foo');
    }
}
