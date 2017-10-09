<?php
/**
 * Created by PhpStorm.
 * User: shaunhare
 * Date: 07/10/2017
 * Time: 22:52
 */

namespace ShaunHare\loader;

use Dotenv\Dotenv;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GrabCommand extends Command
{
    public function configure()
    {
        $this->setName('grab')
            ->setDescription('It grabs the file(s) from s3');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        (new Dotenv(__DIR__.'/../'))->load();
        $io->writeln("Starting S3 bucket file retrieval");
    }
}
