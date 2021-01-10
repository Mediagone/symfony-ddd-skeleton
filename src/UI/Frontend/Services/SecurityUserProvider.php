<?php declare(strict_types=1);

namespace App\UI\Frontend\Services;

use App\Domain\Core\Account\Query\OneAccount;
use App\UI\Frontend\SecurityUser;
use Mediagone\Common\Types\Web\EmailAddress;
use Mediagone\CQRS\Bus\Domain\Query\QueryBus;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Uid\Ulid;
use Throwable;
use function get_class;


final class SecurityUserProvider implements UserProviderInterface
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private QueryBus $queryBus;
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }
    
    
    
    //========================================================================================================
    // UserLoaderInterface implementation
    //========================================================================================================
    
    /**
     * Loads a SecurityUser from the database by email (not username).
     */
    public function loadUserByUsername(string $email) : ?UserInterface
    {
        try {
            $account = $this->queryBus->find(
                OneAccount::asEntity()->byEmail(EmailAddress::fromString($email))
            );
        }
        catch (Throwable $ex) {
            throw new AuthenticationException('An error occurred when retrieving the user account.', 0, $ex);
        }
        
        if ($account === null) {
            throw new BadCredentialsException('No user found for email "'.$email.'"');
        }
        
        return new SecurityUser($account);
    }
    
    
    /**
     * Reloads a SecurityUser from the database using its UID.
     */
    public function refreshUser(UserInterface $user) : UserInterface
    {
        if (! $user instanceof SecurityUser) {
            throw new UnsupportedUserException('Instances of "'.get_class($user).'" are not supported.');
        }
        
        $userId = $user->getIdentifier();
        $account = $this->queryBus->find(
            OneAccount::asEntity()->byId(new Ulid($userId))
        );
        
        if ($account === null) {
            throw new BadCredentialsException('No user found for uid "'.$userId.'"');
        }
        
        return new SecurityUser($account);
    }
    
    
    /**
     * Returns whether this provider supports the given user class.
     */
    public function supportsClass(string $class) : bool
    {
        return $class === SecurityUser::class;
    }
    
    
    
}
