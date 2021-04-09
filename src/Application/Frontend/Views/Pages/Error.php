<?php declare(strict_types=1);

namespace App\Application\Frontend\Views\Pages;


final class Error
{
    //========================================================================================================
    // Properties
    //========================================================================================================

    private int $statusCode;
    
    public function getStatusCode() : int
    {
        return $this->statusCode;
    }
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }
    
    
    
}
