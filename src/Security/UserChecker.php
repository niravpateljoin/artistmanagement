<?php
namespace App\Security;

use Application\Sonata\Userbundle\Entity\User as AppUser;

use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class UserChecker implements UserCheckerInterface
{
	public function checkPreAuth( UserInterface $user )
	{
		if ( ! $user instanceof AppUser )
		{
			return;
		}

		// has the user NOT been enabled yet
		if ( ! $user->isEnabled() )
		{
			// has confirmation token been generated (means the user has not activated their account yet)
			if( !empty($user->getConfirmationToken() ))
			{

//				$resend_activation_link = $this->generateUrl('resend_activation_link');
//				$resend_activation_link = $this->container->get('router')->generate('resend_activation_link');

//				$resend_activation_link = $this->get('request')->getSchemeAndHttpHost() . $this->container->get('router')->getContext()->getBaseUrl() . '/resend-activation-link' . $user->getId();
//				$resend_activation_link = '/resend-activation-link/' . $user->getId();
				$resend_activation_link = '/resend-activation-link/' . $user->getConfirmationToken();


				$ex = new DisabledException( 'Your account hasn\'t yet been activated. We sent you an email with your activation link in it. Please check your email and SPAM folder.<br />If you need us to resend it please click the link below: <br /><a href="'.$resend_activation_link.'">Resend Activation Link</a>' );
				$ex->setUser( $user );
				throw $ex;
			}
			else
			{
				$ex = new DisabledException( 'Your account is currently disabled. Please contact us so we can help get your account re-activated again. <a href="https://mobilemoxie.com/contact/">Go here and submit your support request</a>.' );
				$ex->setUser( $user );
				throw $ex;
			}
		}

	}

	public function checkPostAuth( UserInterface $user )
	{
		if ( ! $user instanceof AppUser )
		{
			return;
		}
	}
}