<?php

namespace Console\Command;

use Symfony\Component\Console;

/**
 * Install Command
 * @author bazo
 */
class Install extends Console\Command\Command {

    protected function configure() {
        $this->setName('app:install')
             ->setDescription('Installs application');
    }

    protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output) {
        $output->writeln('<info>Installing chillout</info>');
        $application = $this->getApplication();

        $command = $application->get('app:database:create');
        $command->run($input, $output);

        $command = $application->get('app:user:create');
        $command->run($input, $output);

        $output->writeln('<info>Finished</info>');
    }
}
