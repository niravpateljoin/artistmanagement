<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Celebrity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Form\Type\CelebrityType;
use Symfony\Component\Security\Core\Security;
use \DateTime;

class LogController extends AbstractController
{
	/**
	 * @Route("/log", name="log_list")
	 */
    public function listAction(Request $request)
    {
    	$securityContext = $this->container->get('security.authorization_checker');
        if (! $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    	$objLog = $this->getDoctrine()->getRepository('App:Log')->findAll();
    	
    	$data = array(
    		'objLog'      => $objLog
    	);
		return $this->render('Log/list.html.twig', $data);
    }
}