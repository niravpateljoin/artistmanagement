<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Celebrity;
use App\Entity\Log;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Form\Type\CelebrityType;
use \DateTime;

class CelebrityController extends AbstractController
{
	/**
	 * @Route("/celebrity", name="celebrity_list")
	 */
    public function listAction(Request $request)
    {
    	$securityContext = $this->container->get('security.authorization_checker');
        if (! $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    	$objCelebrity = $this->getDoctrine()->getRepository('App:Celebrity')->findBy(array(),array('id'=>'DESC'));
    	
    	$data = array(
    		'objCelebrity'      => $objCelebrity
    	);
		return $this->render('Celebrity/list.html.twig', $data);
    }
	
	/**
	 * @Route("/celebrity/create", name="celebrity_create")
	 */
    public function createAction(Request $request)
    {
    	$securityContext = $this->container->get('security.authorization_checker');
        if (! $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    	$celebrity = new Celebrity();

		$form = $this->createForm(CelebrityType::class, $celebrity);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$celebrity = $form->getData();
			
			try {
				$em = $this->getDoctrine()->getManager();
				$em->persist($celebrity);
				$em->flush();
				$this->addFlash('success', 'Celebrity has been successfully created.');
			} catch (\Exception $e) {
				$this->addFlash('danger', 'An error occurred when creating celebrity object.');
			}

			return $this->redirectToRoute('celebrity_list');
		}
		
		return $this->render('Celebrity/create.html.twig', ['form' => $form->createView(), 'action' => 'add']);
    }

    /**
	 * @Route("/celebrity/update/{id}", name="celebrity_update")
	 */
    public function updateAction(Request $request, $id)
    {
    	$user = $this->getUser();

    	$securityContext = $this->container->get('security.authorization_checker');
        if (! $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    	 $date = new DateTime();
    	$celebrity = $this->getDoctrine()->getRepository('App:Celebrity')->findOneById($id);
    	$form = $this->createForm(CelebrityType::class, $celebrity);
		$form->handleRequest($request);
        			
		$exitsCelebsOfRepresentatives = $this->getDoctrine()->getRepository('App:Celebrity')->getActiveCelebsOfRepresentative($celebrity);

		if ($form->isSubmitted() && $form->isValid()) {
			$celebrity = $form->getData();
			
			try {
				$em = $this->getDoctrine()->getManager();
				$uow = $em->getUnitOfWork();
        		$uow->computeChangeSets();
        		$changeset = $uow->getEntityChangeSet($celebrity);
        		$changeNote = '';
        		foreach ($changeset as $key => $value) {
        			$oldData = $value[0];
        			$changeData = $value[1];
        			if( $key == 'birthday' )
        			{
        				$oldData = '';
        				if( $value[0] != null )
        				{
        					$oldData = $value[0]->format('Y-m-d');
        				}

        				$changeData = '';
        				if( $value[1] != null )
        				{
        					$changeData = $value[1]->format('Y-m-d');
        				}
        			}
        			$changeNote = "Celebrity ". $key ." updated from - ". $oldData ." to - ".  $changeData . " By " . $user->getUserName();

        			$log = new Log();
					$log->setChangeNotes($changeNote);		
					$log->setCreatedAt($date);
					$em->persist($log);
        		}
				$em->flush();

				$em->persist($celebrity);
				$em->flush();
        		$updatedCelebsOfRepresentatives = $this->getDoctrine()->getRepository('App:Celebrity')->getActiveCelebsOfRepresentative($celebrity);
        		
        		if( $exitsCelebsOfRepresentatives !== $updatedCelebsOfRepresentatives )
        		{
        			$changeNote = "Celebrity's representative list updated from - " . $exitsCelebsOfRepresentatives . " to - ".  $updatedCelebsOfRepresentatives . " By " . $user->getUserName();

        			$log = new Log();
					$log->setChangeNotes($changeNote);		
					$log->setCreatedAt($date);
					$em->persist($log);
					$em->flush();
        		}


				$this->addFlash('success', 'Celebrity has been successfully updated.');
			} catch (\Exception $e) {
				$this->addFlash('danger', 'An error occurred when updating celebrity object.');
			}

			return $this->redirectToRoute('celebrity_list');
		}
		
		return $this->render('Celebrity/create.html.twig', ['form' => $form->createView(), 'action' => 'update']);
    }

    /**
	 * @Route("/celebrity/delete/{id}", name="celebrity_delete")
	 */
	public function deleteAction(Request $request, $id)
	{
		$securityContext = $this->container->get('security.authorization_checker');
        if (! $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
		$celebrity = $this->getDoctrine()->getRepository('App:Celebrity')->findOneById($id);
		
		try {
			$em = $this->getDoctrine()->getManager();
			$em->remove($celebrity);
			$em->flush();
			$this->addFlash('success', 'Celebrity has been successfully deleted.');
		} catch (\Exception $e) {
			$this->addFlash('danger', 'An error occurred when deleting celebrity object.');
		}

		return $this->redirectToRoute('celebrity_list');
	}
}