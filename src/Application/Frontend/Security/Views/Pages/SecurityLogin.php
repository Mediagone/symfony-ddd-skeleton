<?php declare(strict_types=1);

namespace App\Application\Frontend\Security\Views\Pages;


final class SecurityLogin
{
    //========================================================================================================
    // Properties
    //========================================================================================================

    private string $lastUsername;
    
    public function getLastUsername() : string
    {
        return $this->lastUsername;
    }
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================

    public function __construct(string $lastUsername)
    {
        $this->lastUsername = $lastUsername;
    }
    
    
    
}
