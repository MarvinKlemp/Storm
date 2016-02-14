<?php

namespace MarvinKlemp\Storm;

use MarvinKlemp\Storm\Command\FillDatabase;
use MarvinKlemp\Storm\Configuration\Loader\SymfonyConfigurationLoader;
use MarvinKlemp\Storm\Configuration\Parser\SymfonyConfigurationParser;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    public function __construct()
    {
        parent::__construct('Marvin Klemp Storm', 'dev');
        $command = new FillDatabase(
            'fill',
            new SymfonyConfigurationLoader(),
            new SymfonyConfigurationParser()
        );
        $this->add($command);
        $this->setDefaultCommand('fill');
    }
}
