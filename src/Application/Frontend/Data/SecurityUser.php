<?php declare(strict_types=1);

namespace App\Application\Frontend\Data;

use App\Domain\Core\Account\Account;
use Serializable;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use function json_decode;
use function json_encode;


final class SecurityUser implements UserInterface, Serializable, EquatableInterface
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private Account $account;
    
    private string $accountId;
    
    private string $accountEmail;
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(Account $account)
    {
        $this->account = $account;
        $this->accountId = (string)$account->getId();
        $this->accountEmail = (string)$this->account->getEmail();
    }
    
    
    
    //========================================================================================================
    // Getters
    //========================================================================================================
    
    /**
     * Returns the user's uid as a string.
     */
    public function getIdentifier() : string
    {
        return $this->accountId;
    }
    
    
    /**
     * Returns the user's account.
     */
    public function getAccount() : Account
    {
        return $this->account;
    }
    
    
    
    //========================================================================================================
    // UserInterface implementation
    //========================================================================================================
    
    /**
     * Returns the identifier used to authenticate the user.
     */
    public function getUsername() : string
    {
        return $this->accountEmail; // Login with the Email instead of the Username.
    }
    
    
    /**
     * Returns the encoded password used to authenticate the user.
     */
    public function getPassword() : string
    {
        return (string)$this->account->getPassword();
    }
    
    
    /**
     * Returns the salt that was originally used to encode the password.
     */
    public function getSalt() : ?string
    {
        return null; // Salt is not needed because Bcrypt/Argon2 hashes already define them.
    }
    
    
    /**
     * Returns the roles granted to the user.
     *
     * @return string[] The user roles
     */
    public function getRoles() : array
    {
        return [];
    }
    
    
    /**
     * Removes sensitive data from the user (eg. plain-text password).
     */
    public function eraseCredentials() : void
    {
        // Unused, there is nothing to hide.
    }
    
    
    
    //========================================================================================================
    // Serializable implementation
    //========================================================================================================
    
    /**
     * Returns the serialized representation of the user.
     */
    public function serialize() : ?string
    {
        $serialized = json_encode([
            $this->accountId,
            $this->accountEmail,
        ], JSON_THROW_ON_ERROR);
        
        return ($serialized !== false) ? $serialized : null;
    }
    
    
    /**
     * Constructs the user from its string (uid) representation.
     */
    public function unserialize($serialized) : void
    {
        [$this->accountId, $this->accountEmail] = json_decode($serialized);
    }
    
    
    
    //========================================================================================================
    // EquatableInterface implementation
    //========================================================================================================
    
    /**
     * Returns whether the current user is up-to-date or requires re-authentication.
     */
    public function isEqualTo(UserInterface $user) : bool
    {
        if (!$user instanceof self) {
            return false;
        }
        
        if ($this->getIdentifier() !== $user->getIdentifier()) {
            return false;
        }
        
        // Check other properties?
        // see: https://github.com/symfony/security/blob/master/Core/User/EquatableInterface.php
        
        return true;
    }
    
    
    
}
