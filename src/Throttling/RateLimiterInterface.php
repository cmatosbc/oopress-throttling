<?php

namespace Oopress\Throttling;

interface RateLimiterInterface 
{
    public function allow(): bool;
    public function setId(string $identifier);
}
