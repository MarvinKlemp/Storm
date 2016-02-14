<?php

namespace MarvinKlemp\Storm\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FillDatabase extends Command
{
    protected function configure()
    {
        $this
            ->setName('fill');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        
    }
}
