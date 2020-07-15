<?php
namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartCommand extends Command
{
    protected static $defaultName = 'start';

    protected function configure()
    {
        $this->setDescription("start ngx")
            ->setHelp("start command");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln("hello world");
        return Command::SUCCESS;
    }
}