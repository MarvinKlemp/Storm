<?php

namespace MarvinKlemp\Storm\Configuration\Parser;

use MarvinKlemp\Storm\Configuration\Configuration;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

class SymfonyConfigurationParser implements ConfigurationParserInterface
{
    public function parse(Configuration $config, $configString)
    {
        try {
            $processor = new Processor();
            $processor->processConfiguration(
                $config,
                [$configString]
            );
        } catch (InvalidConfigurationException $ex) {
            throw new ConfigurationParserException(sprintf(
                'Config file is invalid, %s',
                $ex->getMessage()
            ));
        }
    }
}
