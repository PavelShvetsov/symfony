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
            // имя команды (часть после "bin/console")
            ->setName('app:check-ips')

            // краткое описание, отображающееся при запуске "php bin/console list"
            ->setDescription('Check ips in database')

            // полное описание команды, отображающееся при запуске команды
            // с опцией "--help"
            ->setHelp('This command check ips in database...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$repository = $this->container->get('doctrine')->getManager();
        $em = $this->container->get('doctrine')->getRepository(IpInfo::class);

        $items = $em->findBy(
            [],['id'=>'DESC'],10,0
        );
        foreach ($items as $item){
            $ip = $item->getIp();
            $id = $item->getId();
            //Get info ip from api
            $ipApi = new IpApi($ip);
            //Update rows
            $row = $em->find($id);
            $em = $this->container->get('doctrine')->getEntityManager();
            //$ipInfo = new IpInfo($ipApi);
            //$em->persist($ipInfo);
            $em->flush();
            $output->writeln($ip.' is updated');
        }

        $output->writeln('All ips is updated!');
    }
}