<?php declare(strict_types=1);

namespace App\Domain\Core\Account;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Mediagone\Common\Types\Crypto\HashBcrypt;
use Mediagone\Common\Types\Text\Name;
use Mediagone\Common\Types\Web\EmailAddress;
use Symfony\Component\Uid\Ulid;


/**
 * @Entity
 * @Table(name="account")
 */
final class Account
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    /**
     * @Id
     * @Column(type="ulid") 
     */
    private Ulid $id;
    
    public function getId() : Ulid
    {
        return $this->id;
    }
    
    
    /** @Column(type="app_name") */
    private Name $name;
    
    public function getName() : Name
    {
        return $this->name;
    }
    
    
    /** @Column(type="app_email") */
    private EmailAddress $email;

    public function getEmail() : EmailAddress
    {
        return $this->email;
    }
    
    
    /** @Column(type="app_hashbcrypt") */
    private HashBcrypt $password;
    
    public function getPassword() : HashBcrypt
    {
        return $this->password;
    }
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(Ulid $id, Name $name, EmailAddress $email, HashBcrypt $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
    
    
    
}
