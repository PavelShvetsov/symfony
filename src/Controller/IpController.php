<?php
/**
 * Created by PhpStorm.
 * User: manager
 * Date: 12.03.19
 * Time: 17:08
 */

namespace App\Controller;
use App\Entity\IpApi;
use App\Entity\IpInfo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;


class IpController extends Controller
{
    protected function getIps(){
        $repository = $this->getDoctrine()->getRepository(IpInfo::class);
        return $repository->findBy(
            [],['id'=>'DESC'],10,0
        );
    }

    /** @Route("/ip/", name="ip") */
    public function getInfoIp(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('ip', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Save IP'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            //Check ip
            $ip = $this->getDoctrine()
                ->getRepository(IpInfo::class)
                ->findOneBy(['ip' => $data['ip']]);

            if ($ip) {
                return new Response('This ip exists '.$data['ip']);
            }

            //Get info ip from api
            $ipApi = new IpApi($data['ip']);
            //Save to db
            $em = $this->getDoctrine()->getManager();
            $ipInfo = new IpInfo($ipApi);
            $em->persist($ipInfo);
            $em->flush();
            //return $this->redirectToRoute('ip_new');
        }

        return $this->render('ip/infoip.html.twig', array(
            'form' => $form->createView(),
            'ips' => $this->getIps()
        ));
    }
}