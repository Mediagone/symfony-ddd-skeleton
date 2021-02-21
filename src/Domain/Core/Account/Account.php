<?php declare(strict_types=1);

namespace App\Domain\Core\Account;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Mediagone\Common\Types\Crypto\Hash;
use Mediagone\Common\Types\Text\Name;
use Mediagone\Common\Types\Web\EmailAddress;
use Mediagone\SmallUid\SmallUid;


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
     * @Column(type="app_smalluid")
     */
    private SmallUid $id;
    
    public function getId() : SmallUid
    {
        return $this->id;
    }


    /** @Column(type="app_name") */
    private Name $lastname;

    public function getLastname() : Name
    {
        return $this->lastname;
    }

    public function setLastname(Name $name) : void
    {
        $this->lastname = $name;
    }


    /** @Column(type="app_name") */
    private Name $forename;

    public function getForename() : Name
    {
        return $this->forename;
    }

    public function setForename(Name $name) : void
    {
        $this->forename = $name;
    }
    
    
    /** @Column(type="app_email") */
    private EmailAddress $email;

    public function getEmail() : EmailAddress
    {
        return $this->email;
    }

    public function setEmail(EmailAddress $email) : void
    {
        $this->email = $email;
    }
    
    
    /** @Column(type="app_hash") */
    private Hash $password;
    
    public function getPassword() : Hash
    {
        return $this->password;
    }
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(SmallUid $id, Name $forename, Name $lastname, EmailAddress $email, Hash $password)
    {
        $this->id = $id;
        $this->forename = $forename;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
    }
    
    
    
}
