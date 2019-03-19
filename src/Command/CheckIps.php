<?php
/**
 * Created by PhpStorm.
 * User: manager
 * Date: 15.03.19
 * Time: 12:11
 */

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Entity\IpInfo;
use Symfony\Component\DependencyInjection\ContainerInterface;
use App\Entity\IpApi;

class CheckIps extends Command
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setName('app:check-ips')
            ->setDescription('Check ips in database')
            ->setHelp('This command check ips in database...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /*$items = $this->container->get('doctrine')->getRepository(IpInfo::class)->findBy(
            [],['id'=>'DESC'],10,0
        );*/
        $items = $this->container->get('doctrine')->getRepository(IpInfo::class)->findIpLastDay();

        foreach ($items as $item){
            $ip = $item->getIp();
            //Get info ip from api
            $ipApi = new IpApi($ip);
            //update ip
            $item->update($ipApi);
            $this->container->get('doctrine')->getEntityManager()->flush();
            $output->writeln($ip.' is updated');
        }
        $output->writeln('All ips is updated!');
    }
}