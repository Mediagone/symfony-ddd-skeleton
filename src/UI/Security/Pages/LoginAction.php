<?php declare(strict_types=1);

namespace App\UI\Security\Pages;

use App\UI\Backend\Partials\BackendHeader;
use App\UI\Shared\Partials\PageHeader;
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
 * @Route("/login", name="security_login", methods={"GET","POST"})
 */
final class LoginAction
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
        
        $username = $this->auth->getLastUsername();
        
        return $responses->template('Security/Pages/Login.twig', [
            'HEADER' => new PageHeader(null),
            'MENU' => null,
            'FOOTER' => new BackendHeader(),
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
