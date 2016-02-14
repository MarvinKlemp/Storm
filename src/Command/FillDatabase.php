<?php

namespace MarvinKlemp\Storm\Command;

use MarvinKlemp\Storm\Config\Configuration;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class FillDatabase extends Command
{
    protected function configure()
    {
        $this
            ->setName('fill');

        $this->setDefinition([
            new InputArgument('config', InputArgument::REQUIRED, 'The path to your configuration'),
        ]);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $configPath = $input->getArgument('config');

        if (false === $configPath = realpath($configPath)) {
            $output->writeln(sprintf(
                'Config file "%s" not found', $configPath
            ));
            return 1;
        }

        try {
            $configuration = Yaml::parse(file_get_contents($configPath));
        } catch (ParseException $ex) {
            $output->writeln(sprintf(
               'Config file "%s" contains parsing errors: %s',
                $configPath,
                $ex->getMessage()
            ));

            return 1;
        }

        try {
            $config = new Configuration();
            $processor = new Processor();
            $processor->processConfiguration(
                $config,
                [$configuration]
            );
        } catch (InvalidConfigurationException $ex) {
            $output->writeln(sprintf(
                'Config file "%s" id invalid, %s',
                $configPath,
                $ex->getMessage()
            ));

            return 1;
        }

    }
}
