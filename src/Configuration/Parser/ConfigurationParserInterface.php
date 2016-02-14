<?php

namespace MarvinKlemp\Storm\Configuration\Parser;

use MarvinKlemp\Storm\Configuration\Configuration;

interface ConfigurationParserInterface
{
    public function parse(Configuration $config, $configString);
}
