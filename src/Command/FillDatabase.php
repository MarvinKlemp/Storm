<?php

namespace MarvinKlemp\Storm\Command;

use MarvinKlemp\Storm\Configuration\Configuration;
use MarvinKlemp\Storm\Configuration\Loader\ConfigurationLoaderException;
use MarvinKlemp\Storm\Configuration\Loader\ConfigurationLoaderInterface;
use MarvinKlemp\Storm\Configuration\Parser\ConfigurationParserException;
use MarvinKlemp\Storm\Configuration\Parser\ConfigurationParserInterface;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FillDatabase extends Command
{
    /**
     * @var ConfigurationLoaderInterface
     */
    private $configLoader;

    /**
     * @var ConfigurationParserInterface
     */
    private $configParser;

    /**
     * @param string $name
     * @param ConfigurationLoaderInterface $configLoader
     * @param ConfigurationParserInterface $configParser
     */
    public function __construct($name, ConfigurationLoaderInterface $configLoader, ConfigurationParserInterface $configParser)
    {
        parent::__construct($name);

        $this->configLoader = $configLoader;
        $this->configParser = $configParser;
    }

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
        $configPath = realpath($input->getArgument('config'));

        if (false === $configPath) {
            $output->writeln(sprintf(
                'Config file "%s" not found', $input->getArgument('config')
            ));
            return 1;
        }

        try {
            $configs = $this->configLoader->load($configPath);
        } catch (ConfigurationLoaderException $ex) {
            $output->writeln($ex->getMessage());

            return 1;
        }

        try {
            $parsedConfig = $this->configParser->parse(
                new Configuration(),
                $configs
            );
        } catch (ConfigurationParserException $ex) {
            $output->writeln($ex->getMessage());

            return 1;
        }


    }
}
