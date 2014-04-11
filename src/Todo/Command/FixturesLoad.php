<?php

namespace Todo\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\ProcessBuilder;
use Symfony\Component\Yaml\Yaml;

/**
 * The fixtures:load task class
 */
class FixturesLoad extends Command
{
    /**
     * Set up options and arguments
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('fixtures:load')
            ->setDescription('Runs the project')
            ->setHelp(
                <<<EOF
    The <info>fixtures:load</info> insert fixtures data into your database

    <info>bin/console schema:create</info>
EOF
            );
    }

    /**
     * Run the task
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fixtures = array();
        foreach (glob($this->app['resources_path'].'/fixtures/*.yml') as $file) {
            $fixtures = array_merge($fixtures, Yaml::parse(file_get_contents($file)));
        }

        $output->writeln('Purging database...');
        $output->writeln('Loading fixtures');

        foreach ($fixtures as $table => $data) {
            $this->app['db']->exec('DELETE FROM '.$table);
            foreach ($data as $row) {
                $this->app['db']->insert($table, $row);
            }
        }

        $output->writeln('Fixtures loaded');
    }
}
