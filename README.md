Dekalee Redis swarrot
=====================

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dekalee/redis-swarrot-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dekalee/redis-swarrot-bundle/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/dekalee/redis-swarrot-bundle/v/stable)](https://packagist.org/packages/dekalee/redis-swarrot-bundle)
[![Total Downloads](https://poser.pugx.org/dekalee/redis-swarrot-bundle/downloads)](https://packagist.org/packages/dekalee/redis-swarrot-bundle)
[![License](https://poser.pugx.org/dekalee/redis-swarrot-bundle/license)](https://packagist.org/packages/dekalee/redis-swarrot-bundle)

This bundle will wrap the [swarrot-redis](https://github.com/dekalee/redis-swarrot) library.

It will provide a way to use the redis provider while using the [SwarrotBundle](https://github.com/swarrot/SwarrotBundle).

Installation
------------

Use composer to install this bundle :

```
    composer require dekalee/redis-swarrot-bundle
```

Activate it in the `AppKernel.php` file:

```php
    new Dekalee\RedisSwarrotBundle\DekaleeRedisSwarrotBundle(),
```

Configuration
-------------

In your `config.yml` file, you should set the provider to redis and specify the connection :

```yaml
    swarrot:
        provider: redis
        default_connection: redisQueue
        connections:
            redisQueue:
                host: %redis_queue_host%
                port: %redis_queue_port%
                vhost: %redis_queue_database%
```

Usage
-----

You can directly use your queing system as before
