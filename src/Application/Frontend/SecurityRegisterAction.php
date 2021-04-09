<?php declare(strict_types=1);

namespace App\Application\Frontend;

use App\Application\Frontend\Views\Pages\SecurityRegister;
use App\Application\Shared\Services\ControllerFlashes;
use App\Application\Shared\Services\ControllerResponses;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationServiceException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


/**
 * @Route("/register", name="frontend_security_register", methods={"GET"})
 */
final class SecurityRegisterAction
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
        return $responses->template('Frontend/Views/Pages/SecurityRegister.twig', [
            //'HEADER' => new PageHeader(null),
            'MODEL' => new SecurityRegister(),
        ]);
    }



    //========================================================================================================
    // Helpers
    //========================================================================================================

    private function handleAuthenticationError()
    {
        $error = $this->auth->getLastAuthenticationError();

        if ($error instanceof BadCredentialsException || $error instanceof AuthenticationServiceException) {
            $this->flashes->warning('flashes.login.error_credentials_html', 'frontend');
        }
        elseif ($error instanceof InvalidCsrfTokenException) {
            $this->flashes->warning('flashes.login.error_csrf_html', 'frontend');
        }
        elseif ($error) {
            $this->flashes->warning('flashes.login.error_html', 'frontend');
        }
    }
    
    
    
}
