<?php

use PHPUnit\Framework\TestCase;
use Oopress\Throttling\TokenBucketRateLimiter;

class TokenBucketRateLimiterTest extends TestCase
{
    public function testAllow()
    {
        $limiter = new TokenBucketRateLimiter(10, 1);

        // Allow 10 requests in the first second
        for ($i = 0; $i < 10; $i++) {
            $this->assertTrue($limiter->allow());
        }

        // The 11th request should be denied
        $this->assertFalse($limiter->allow());

        // Wait for one second, then allow another request
        sleep(1);
        $this->assertTrue($limiter->allow());
    }
}
