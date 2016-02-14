<?php

namespace MarvinKlemp\Storm\Configuration\Loader;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class SymfonyConfigurationLoader implements ConfigurationLoaderInterface
{
    public function load($configPath)
    {
        try {
            return Yaml::parse(file_get_contents($configPath));
        } catch (ParseException $ex) {
            throw new ConfigurationLoaderException(sprintf(
                'Config file "%s" contains parsing errors: %s',
                $configPath,
                $ex->getMessage()
            ));
        }
    }
}
