<?php
use Sunspikes\Ratelimit\Cache\Adapter\DesarrollaCacheAdapter;
use Sunspikes\Ratelimit\Cache\Factory\DesarrollaCacheFactory;
use Sunspikes\Ratelimit\RateLimiter;
use Sunspikes\Ratelimit\Throttle\Factory\ThrottlerFactory;
use Sunspikes\Ratelimit\Throttle\Hydrator\HydratorFactory;
use Sunspikes\Ratelimit\Throttle\Settings\ElasticWindowSettings;

// 1. Make a rate limiter with limit 3 attempts in 10 minutes
$cacheAdapter = new DesarrollaCacheAdapter((new DesarrollaCacheFactory())->make());
$settings = new ElasticWindowSettings(3, 600);
$ratelimiter = new RateLimiter(new ThrottlerFactory($cacheAdapter), new HydratorFactory(), $settings);

// 2. Get a throttler for path /login
$loginThrottler = $ratelimiter->get('/api');

// 3. Register a hit
$loginThrottler->hit();

// 4. Check if it reached the limit
if ($loginThrottler->check()) {
	// access permitted
	// echo "Out of limit";
} else {
	// echo "No";
	// access denied
}

// Or combine steps 3 & 4
if ($loginThrottler->access()) {
	// access permitted
} else {
	// access denied
}

// To get the number of hits
// print $loginThrottler->count();
