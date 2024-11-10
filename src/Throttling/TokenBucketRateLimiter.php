<?php

namespace Oopress\Throttling;

class TokenBucketRateLimiter implements RateLimiterInterface 
{
    private $tokens;
    private $lastRefillTime;
    private $id;

    public function __construct(private int $capacity, private int $refillRate)
    {
        $this->tokens = $capacity;
        $this->lastRefillTime = time();
    }

    public function setID(string $identifier)
    {
        $this->id = $identifier;
    }

    public function allow(): bool
    {
        $currentTime = time();
        $elapsedTime = $currentTime - $this->lastRefillTime;
        $tokensToAdd = $elapsedTime * $this->refillRate;
        $this->tokens = min($this->tokens + $tokensToAdd, $this->capacity);
        $this->lastRefillTime = $currentTime;

        if ($this->tokens > 0) {
            $this->tokens--;
            return true;
        }

        return false;
    }
}