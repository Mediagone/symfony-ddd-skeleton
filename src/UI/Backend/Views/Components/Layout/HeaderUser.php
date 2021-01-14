<?php declare(strict_types=1);

namespace App\UI\Backend\Views\Components\Layout;

use App\UI\Frontend\SecurityUser;


final class HeaderUser
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private bool $hasUser;
    
    public function hasUser() : bool
    {
        return $this->hasUser;
    }
    
    private string $id;
    
    public function getId() : string
    {
        return $this->id;
    }
    
    
    private string $name;
    
    public function getName() : string
    {
        return $this->name;
    }
    
    
    private string $email;
    
    public function getEmail() : string
    {
        return $this->email;
    }
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(?SecurityUser $user/*string $id, string $name, string $avatar*/)
    {
        $this->hasUser = $user !== null;
        
        if ($this->hasUser) {
            $this->id = $user->getAccount()->getId()->toBase32();
            $this->name = $user->getAccount()->getName()->toString();
            $this->email = $user->getAccount()->getEmail()->toString();
        }
    }
    
    
    
}
