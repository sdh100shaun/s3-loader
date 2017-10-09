<?php
/**
 * Created by PhpStorm.
 * User: shaunhare
 * Date: 09/10/2017
 * Time: 18:54
 */

namespace ShaunHare\loader;


use Dotenv\Dotenv;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ListCommand extends Command
{
    public function configure()
    {
        $this->setName('list')
            ->setDescription('lists file(s) from s3');
    }


   public function execute(InputInterface $input, OutputInterface $output)
    {
            $io = new SymfonyStyle($input, $output);
            $env = new Dotenv(__DIR__. '/../');
            $env->load();

            $awsS3 = new AwsClient(['Bucket'=>$_SERVER['AWS_BUCKET'], 'Key'=>$_SERVER['AWS_KEY']], ['region'=>$_SERVER['AWS_REGION'],
                'version'=> $_SERVER['AWS_VERSION']]);
            $items = $awsS3->listObjects();
            foreach ($items as $item)
            {
                $io->writeln($item['Key']);
            }
     }
}