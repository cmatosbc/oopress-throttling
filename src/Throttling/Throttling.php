<?php

namespace Oopress\Throttling;

class Throttling 
{
    private $rateLimiter;

    public function __construct(RateLimiterInterface $rateLimiter) 
    {
        $this->rateLimiter = $rateLimiter;
    }

    public function throttle(callable $func): void 
    {
        $this->rateLimiter->setId(spl_object_hash($func));
        
        if ($this->rateLimiter->allow()) {
            $func();
        }
    }
}
