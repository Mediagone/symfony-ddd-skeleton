<?php declare(strict_types=1);

namespace App\UI\Security\Pages;

use LogicException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


final class Logout
{
    //========================================================================================================
    // Action
    //========================================================================================================

    /**
     * @Route("/logout", name="security_logout", methods={"GET"})
     */
    public function __invoke() : Response
    {
        throw new LogicException("This point should never be reached! Don't forget to activate logout in security.yaml");
    }
    
    
    
}
