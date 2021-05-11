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
	 * @Route("/", name="home")
	 */
    public function indexAction(Request $request)
    {
		return $this->redirect($this->generateUrl('fos_user_security_login'));
    }
}