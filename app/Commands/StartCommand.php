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
        $socket = \socket_create(\AF_INET, \SOCK_STREAM, \SOL_TCP);

        \socket_bind($socket, "127.0.0.1", 7998);

        \socket_listen($socket, 10);

        for (;;) {
            $conn = \socket_accept($socket);
            if ($conn === false) {
                usleep(100);
            } else {
                while (($read = \socket_read($conn, 10)) != false) {
                    if (str_ends_with($read, "\r\n")) {
                        break;
                    }
                }

                \socket_write($conn, "hello world\n");
                socket_close($conn);
            }
        }

        return Command::SUCCESS;
    }
}