<?php declare(strict_types=1);

namespace App\UI\Shared\Services;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


final class ControllerFlashes
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private Session $session;
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(SessionInterface $session)
    {
        if (! $session instanceof Session) {
            //Note: required to ensure the presence of the getFlashBag() method
            throw new InvalidArgumentException('The specified SessionInterface object must be an instance of ' . Session::class);
        }
        
        $this->session = $session;
    }
    
    
    
    //========================================================================================================
    // Helpers
    //========================================================================================================
    
    /**
     * Adds a notice flash message.
     */
    public function notice(string $message, string $domain = 'default') : void
    {
        $this->session->getFlashBag()->add($domain, json_encode(['type' => 'notice', 'message' => $message]));
    }
    
    
    /**
     * Adds a success flash message.
     */
    public function success(string $message, string $domain = 'default') : void
    {
        $this->session->getFlashBag()->add($domain, json_encode(['type' => 'success', 'message' => $message]));
    }
    
    
    /**
     * Adds a warning flash message.
     */
    public function warning(string $message, string $domain = 'default') : void
    {
        $this->session->getFlashBag()->add($domain, json_encode(['type' => 'warning', 'message' => $message]));
    }
    
    
    /**
     * Adds an alert flash message.
     */
    public function alert(string $message, string $domain = 'default') : void
    {
        $this->session->getFlashBag()->add($domain, json_encode(['type' => 'alert', 'message' => $message]));
    }
    
    
    
}
