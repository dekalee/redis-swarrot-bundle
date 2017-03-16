<?php

namespace Dekalee\RedisSwarrotBundle\Configurator;

use Dekalee\RedisSwarrot\Processor\RepostOnTimeOutProcessor;
use Psr\Log\LoggerInterface;
use Swarrot\SwarrotBundle\Broker\FactoryInterface;
use Swarrot\SwarrotBundle\Processor\ProcessorConfiguratorEnableAware;
use Swarrot\SwarrotBundle\Processor\ProcessorConfiguratorExtrasAware;
use Swarrot\SwarrotBundle\Processor\ProcessorConfiguratorInterface;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class RepostOnTimeOutProcessorConfigurator
 */
class RepostOnTimeOutProcessorConfigurator implements ProcessorConfiguratorInterface
{
    use ProcessorConfiguratorEnableAware, ProcessorConfiguratorExtrasAware;

    private $factory;
    private $logger;

    /**
     * @param FactoryInterface $factory
     * @param LoggerInterface  $logger
     */
    public function __construct(FactoryInterface $factory, LoggerInterface $logger)
    {
        $this->factory = $factory;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function getProcessorArguments(array $options)
    {
        return [
            RepostOnTimeOutProcessor::CLASS,
            $this->factory->getMessageProvider($options['queue'], $options['connection']),
            $this->logger,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getCommandOptions()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function resolveOptions(InputInterface $input)
    {
        return $this->getExtras();
    }
}
