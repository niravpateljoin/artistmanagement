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

class HomeController extends AbstractController
{
	/**
	 * @Route("/dashboard", name="home")
	 */
    public function indexAction(Request $request)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if (! $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    	$objCelebrity = $this->getDoctrine()->getRepository('App:Celebrity')->findAll();
    	$objRepresentative = $this->getDoctrine()->getRepository('App:Representative')->findAll();
    	$data = array(
    		'objCelebrity'      => $objCelebrity,
    		'objRepresentative' => $objRepresentative
    	);
		return $this->render('Dashboard/index.html.twig', $data);
    }
}