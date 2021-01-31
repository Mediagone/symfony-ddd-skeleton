<?php declare(strict_types=1);

namespace App\Domain\Core\Account\Command;

use App\Domain\Core\Account\Account;
use Mediagone\Common\Types\Text\Name;
use Mediagone\Common\Types\Web\EmailAddress;
use Mediagone\CQRS\Bus\Domain\Command\Command;


final class ModifyAccount implements Command
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private Account $account;
    
    public function getAccount() : Account
    {
        return $this->account;
    }
    
    
    private Name $forename;
    
    public function getForename() : Name
    {
        return $this->forename;
    }
    
    
    private Name $lastname;
    
    public function getLastname() : Name
    {
        return $this->lastname;
    }
    
    
    private EmailAddress $email;
    
    public function getEmail() : EmailAddress
    {
        return $this->email;
    }
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(Account $account, Name $lastname, Name $forename, EmailAddress $email)
    {
        $this->account = $account;
        $this->lastname = $lastname;
        $this->forename = $forename;
        $this->email = $email;
    }
    
    
    
}
