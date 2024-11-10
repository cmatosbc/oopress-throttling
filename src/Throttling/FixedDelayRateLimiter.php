<?php

namespace Oopress\Throttling;

class FixedDelayRateLimiter implements RateLimiterInterface
{
    private $lastExecutionTime = [];
    private $id;

    public function __construct(private int $limit)
    {
    }

    public function setID(string $identifier)
    {
        $this->id = $identifier;
    }

    public function allow(): bool
    {
        $currentTime = time();

        if (!isset($this->lastExecutionTime[$this->id]) || ($currentTime - $this->lastExecutionTime[$this->id]) >= $limit) {
            $this->lastExecutionTime[$this->id] = $currentTime;
            return true;
        }

        return false;
    }
}