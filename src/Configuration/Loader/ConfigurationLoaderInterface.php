<?php

namespace MarvinKlemp\Storm\Configuration\Loader;

interface ConfigurationLoaderInterface
{
    /**
     * @param string $configPath
     * @return string
     * @throws ConfigurationLoaderException
     */
    public function load($configPath);
}
