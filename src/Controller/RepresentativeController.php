<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Representative;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Form\Type\RepresentativeType;
use \DateTime;
use App\Entity\Log;

class RepresentativeController extends AbstractController
{
	/**
	 * @Route("/representative", name="representative_list")
	 */
    public function listAction(Request $request)
    {
    	$securityContext = $this->container->get('security.authorization_checker');
        if (! $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    	$objRepresentative = $this->getDoctrine()->getRepository('App:Representative')->findAll();
    	
    	$data = array(
    		'objRepresentative'      => $objRepresentative
    	);
		return $this->render('Representative/list.html.twig', $data);
    }

	/**
	 * @Route("/representative/create", name="representative_create")
	 */
    public function createAction(Request $request)
    {
    	$securityContext = $this->container->get('security.authorization_checker');
        if (! $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    	$representative = new Representative();

		$form = $this->createForm(RepresentativeType::class, $representative);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$representative = $form->getData();
			
			try {
				$em = $this->getDoctrine()->getManager();
				$em->persist($representative);
				$em->flush();
				$this->addFlash('success', 'Representative has been successfully created.');
			} catch (\Exception $e) {
				$this->addFlash('danger', 'An error occurred when creating representative object.');
			}

			return $this->redirectToRoute('representative_list');
		}
		
		return $this->render('Representative/create.html.twig', ['form' => $form->createView(), 'action' => 'add']);
	}

	/**
	 * @Route("/representative/update/{id}", name="representative_update")
	 */
    public function updateAction(Request $request, $id)
    {
    	$date = new DateTime();
    	$securityContext = $this->container->get('security.authorization_checker');
        if (! $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    	$representative = $this->getDoctrine()->getRepository('App:Representative')->findOneById($id);
    	$form = $this->createForm(RepresentativeType::class, $representative);
		$form->handleRequest($request);

		$exitsCelebsOfRepresentatives = $this->getDoctrine()->getRepository('App:Representative')->getRepresentative($representative);

		if ($form->isSubmitted() && $form->isValid()) {
			$representative = $form->getData();
			
			try {
				$em = $this->getDoctrine()->getManager();

				$uow = $em->getUnitOfWork();
        		$uow->computeChangeSets();
        		$changeset = $uow->getEntityChangeSet($representative);
        		$changeNote = '';

        		foreach ($changeset as $key => $value) {
        			$changeData = $value[1];
        			$changeNote = $changeNote . "Representative ". $key ." updated to - ".  $changeData . ", ";
        		}

				$em->persist($representative);
				$em->flush();

				$updatedCelebsOfRepresentatives = $this->getDoctrine()->getRepository('App:Representative')->getRepresentative($representative);

				if( $exitsCelebsOfRepresentatives !== $updatedCelebsOfRepresentatives )
        		{
        			$changeNote = $changeNote . "Representative's celebrity list updated to - ".  $updatedCelebsOfRepresentatives;
        		}

        		// generate the log for edit record...
				if( $changeNote !== '' )
				{
					$changeNote = $changeNote . " At ". $date->format('Y-m-d H:i:s');		
					$log = new Log();
					$log->setChangeNotes($changeNote);		
					$log->setCreatedAt($date);
					$em->persist($log);
					$em->flush();
				}

				$this->addFlash('success', 'Representative has been successfully updated.');
			} catch (\Exception $e) {
				$this->addFlash('danger', 'An error occurred when updating representative object.');
			}

			return $this->redirectToRoute('representative_list');
		}
		
		return $this->render('Representative/create.html.twig', ['form' => $form->createView(), 'action' => 'update']);
    }

    /**
	 * @Route("/representative/delete/{id}", name="representative_delete")
	 */
	public function deleteAction(Request $request, $id)
	{
		$securityContext = $this->container->get('security.authorization_checker');
        if (! $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
		$representative = $this->getDoctrine()->getRepository('App:Representative')->findOneById($id);
		try {
			$em = $this->getDoctrine()->getManager();
			$em->remove($representative);
			$em->flush();
			$this->addFlash('success', 'Representative has been successfully deleted.');
		} catch (\Exception $e) {
			$this->addFlash('danger', 'An error occurred when deleting representative object.');
		}

		return $this->redirectToRoute('representative_list');
	}
}