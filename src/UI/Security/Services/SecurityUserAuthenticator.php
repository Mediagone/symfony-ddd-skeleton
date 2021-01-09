<?php declare(strict_types=1);

namespace App\UI\Security\Services;

use App\Domain\Core\Account\Query\OneAccount;
use App\UI\Security\SecurityUser;
use Mediagone\Common\Types\Web\EmailAddress;
use Mediagone\CQRS\Bus\Domain\Query\QueryBus;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Throwable;
use function get_class;


final class SecurityUserAuthenticator extends AbstractFormLoginAuthenticator
{
    //========================================================================================================
    // Properties
    //========================================================================================================

    private QueryBus $queryBus;

    private RouterInterface $router;

    private CsrfTokenManagerInterface $csrfTokenManager;

    private string $loginRoute;
    
    

    //========================================================================================================
    // Constructor
    //========================================================================================================

    public function __construct(QueryBus $queryBus, RouterInterface $router, CsrfTokenManagerInterface $csrfTokenManager, string $securityLoginRoute)
    {
        $this->queryBus = $queryBus;
        $this->router = $router;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->loginRoute = $securityLoginRoute;
    }


    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    protected function getLoginUrl() : string
    {
        return $this->router->generate($this->loginRoute);
    }
    
    
    public function supports(Request $request) : bool
    {
        return $request->isMethod('POST') && $request->attributes->get('_route') === $this->loginRoute;
    }
    
    
    public function getCredentials(Request $request) : array
    {
        $credentials = [
            'email' => $request->request->get('_username'),
            'password' => $request->request->get('_password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];
        
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email']
        );
        
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (! $this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }
        
        return $credentials;
    }
    
    
    public function getUser($credentials, UserProviderInterface $userProvider) : SecurityUser
    {
        ['email' => $email] = $credentials;
        
        try {
            $account = $this->queryBus->find(
                OneAccount::asEntity()->byEmail(EmailAddress::fromString($email))
            );
        }
        catch (Throwable $ex) {
            throw new AuthenticationException('An error occured when retrieving the user account.', 0, $ex);
        }
        
        if ($account === null) {
            throw new BadCredentialsException('No user found for email "'.$email.'"');
        }
        
        return new SecurityUser($account);
    }
    
    
    public function checkCredentials($credentials, UserInterface $user) : bool
    {
        if (! $user instanceof SecurityUser) {
            throw new UnsupportedUserException('Instances of "'.get_class($user).'" are not supported.');
        }
        
        ['password' => $password] = $credentials;
        
        return $user->getAccount()->getPassword()->verifyString($password);
    }
    
    
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey) : ?RedirectResponse
    {
        return new RedirectResponse($this->router->generate('backend_dashboard'));
    }
    
    
}
