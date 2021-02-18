<?php declare(strict_types=1);

namespace App\UI\Frontend;

use App\UI\Frontend\Views\Pages\SecurityLogin;
use App\UI\Shared\Services\ControllerFlashes;
use App\UI\Shared\Services\ControllerResponses;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationServiceException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


/**
 * @Route("/login", name="frontend_security_login", methods={"GET","POST"})
 */
final class SecurityLoginAction
{
    //========================================================================================================
    // Properties
    //========================================================================================================

    private AuthenticationUtils $auth;

    private ControllerFlashes $flashes;



    //========================================================================================================
    // Constructor
    //========================================================================================================

    public function __construct(AuthenticationUtils $auth, ControllerFlashes $flashes)
    {
        $this->auth = $auth;
        $this->flashes = $flashes;
    }



    //========================================================================================================
    // Action
    //========================================================================================================

    public function __invoke(?UserInterface $user, ControllerResponses $responses, AuthenticationUtils $authenticationUtils) : Response
    {
        if ($user !== null) {
            return $responses->seeOtherRedirection('backend_dashboard');
        }
        
        $this->handleAuthenticationError();
        
        return $responses->template('Frontend/Views/Pages/SecurityLogin.twig', [
            'MODEL' => new SecurityLogin($this->auth->getLastUsername()),
        ]);
    }
    
    
    
    //========================================================================================================
    // Helpers
    //========================================================================================================

    private function handleAuthenticationError()
    {
        $error = $this->auth->getLastAuthenticationError();
        
        if ($error instanceof BadCredentialsException || $error instanceof AuthenticationServiceException) {
            $this->flashes->warning('login.flashes.error_credentials_html', 'frontend');
        }
        elseif ($error instanceof InvalidCsrfTokenException) {
            $this->flashes->warning('login.flashes.error_csrf_html', 'frontend');
        }
        elseif ($error) {
            $this->flashes->warning('login.flashes.error_html', 'frontend');
        }
    }
    
    
    
}
