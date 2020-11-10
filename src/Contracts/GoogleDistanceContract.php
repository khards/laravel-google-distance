<?php

namespace Pnlinh\GoogleDistance\Contracts;

use Pnlinh\GoogleDistance\Response;

interface GoogleDistanceContract
{
    /**
     * Calculate distance from origins to destinations.
     *
     * @param string $origins
     * @param string $destinations
     *
     * @return int
     */
    public function calculate($origins, $destinations): Response;
}
