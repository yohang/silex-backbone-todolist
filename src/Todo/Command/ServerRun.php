<?php

namespace Todo\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\ProcessBuilder;

/**
 * The server:run task class
 */
class ServerRun extends Command
{
    /**
     * Set up options and arguments
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('server:run')
            ->setDefinition(array(
                new InputOption(
                    'router',
                    null,
                    InputOption::VALUE_REQUIRED,
                    'The router script',
                    realpath(__DIR__ . '/../../../resources/config/router.php')
                ),
                new InputArgument(
                    'bind_address',
                    InputArgument::OPTIONAL,
                    'The address:port your project will run',
                    'localhost:8080'
                )
            ))
            ->setDescription('Runs the project')
            ->setHelp(
                <<<EOF
    The <info>server:run</info> command runs the project using the PHP 5.4+ built-in web server

    <info>bin/console server:run</info>
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
        $builder = new ProcessBuilder(
            array(PHP_BINARY, '-S', $input->getArgument('bind_address'), $input->getOption('router'))
        );
        $builder->setWorkingDirectory(realpath(__DIR__ . '/../../../web'));
        $builder->setTimeout(null);

        $output->writeln(sprintf("Server running on <info>%s</info>\n", $input->getArgument('bind_address')));

        $builder->getProcess()->run(function ($type, $buffer) use ($output) {
            if (OutputInterface::VERBOSITY_VERBOSE === $output->getVerbosity()) {
                $output->write($buffer);
            }
        });
    }
}
