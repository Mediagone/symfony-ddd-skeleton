<?php declare(strict_types=1);

namespace App\UI\Backend\Forms;

use App\Domain\Core\Account\Account;
use App\UI\Shared\Services\Form\Validation\ValueValid;
use Mediagone\Common\Types\Web\EmailAddress;
use Mediagone\Common\Types\Text\Name;
use Symfony\Component\Validator\Constraints as Assert;


final class AccountEditFormData
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    /**
     * @Assert\NotBlank(message="entities.account.lastname.validation.not_blank")
     * @ValueValid(class=Name::class, message="entities.account.forename.validation.invalid")
     */
    private string $lastname;
    
    public function getLastname() : string
    {
        return $this->lastname;
    }
    
    public function setLastname(string $lastname) : void
    {
        $this->lastname = $lastname;
    }
    
    
    /**
     * @Assert\NotBlank(message="entities.account.forename.validation.not_blank")
     * @ValueValid(class=Name::class, message="entities.account.forename.validation.invalid")
     */
    private string $forename;
    
    public function getForename() : string
    {
        return $this->forename;
    }
    
    public function setForename(string $forename) : void
    {
        $this->forename = $forename;
    }
    
    
    /**
     * @Assert\NotBlank(message="entities.account.email.validation.not_blank")
     * @ValueValid(class=EmailAddress::class, message="entities.account.email.validation.invalid")
     */
    private string $email;
    
    public function getEmail() : string
    {
        return $this->email;
    }
    
    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }
    
    
    private string $password = '';
    
    public function getPassword() : string
    {
        return $this->password;
    }
    
    public function setPassword(string $password) : void
    {
        $this->password = $password;
    }
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(Account $account)
    {
        $this->lastname = $account->getLastname()->toString();
        $this->forename = $account->getForename()->toString();
        $this->email = $account->getEmail()->toString();
    }
    
    
    
}
