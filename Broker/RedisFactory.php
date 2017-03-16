<?php

namespace Dekalee\RedisSwarrotBundle\Broker;

use Dekalee\RedisSwarrot\MessageProvider\RedisMessageProvider;
use Dekalee\RedisSwarrot\MessagePublisher\RedisMessagePublisher;
use Swarrot\Broker\MessageProvider\MessageProviderInterface;
use Swarrot\Broker\MessagePublisher\MessagePublisherInterface;
use Swarrot\SwarrotBundle\Broker\FactoryInterface;

/**
 * Class RedisFactory
 */
class RedisFactory implements FactoryInterface
{
    protected $connections = array();
    protected $messageProviders = array();
    protected $messagePublishers = array();

    /**
     * {@inheritDoc}
     */
    public function addConnection($name, array $connection)
    {
        $this->connections[$name] = $connection;
    }

    /**
     * getMessageProvider.
     *
     * @param string $name       The name of the queue where the MessageProviderInterface will found messages
     * @param string $connection The name of the connection to use
     *
     * @return MessageProviderInterface
     */
    public function getMessageProvider($name, $connection)
    {
        if (!isset($this->messageProviders[$connection][$name])) {
            if (!isset($this->messageProviders[$connection])) {
                $this->messageProviders[$connection] = array();
            }

            $channel = $this->getChannel($connection);

            $this->messageProviders[$connection][$name] = new RedisMessageProvider($channel, $name);
        }

        return $this->messageProviders[$connection][$name];
    }

    /**
     * getMessagePublisher.
     *
     * @param string $name       The name of the exchange where the MessagePublisher will publish
     * @param string $connection The name of the connection to use
     *
     * @return MessagePublisherInterface
     */
    public function getMessagePublisher($name, $connection)
    {
        if (!isset($this->messageProviders[$connection][$name])) {
            if (!isset($this->messageProviders[$connection])) {
                $this->messageProviders[$connection] = array();
            }

            $channel = $this->getChannel($connection);

            $this->messageProviders[$connection][$name] = new RedisMessagePublisher($channel, $name);
        }

        return $this->messageProviders[$connection][$name];
    }

    /**
     * getChannel.
     *
     * @param string $connection
     *
     * @return \Redis
     */
    protected function getChannel($connection)
    {
        $client = new \Redis();
        $client->connect($this->connections[$connection]['host'], $this->connections[$connection]['port']);

        if ('/' != $this->connections[$connection]['vhost']) {
            $client->select($this->connections[$connection]['vhost']);
        }

        return $client;
    }
}
