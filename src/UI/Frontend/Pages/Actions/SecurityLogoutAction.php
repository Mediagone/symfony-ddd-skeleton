<?php declare(strict_types=1);

namespace App\UI\Frontend\Pages\Actions;

use LogicException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/logout", name="frontend_security_logout", methods={"GET"})
 */
final class SecurityLogoutAction
{
    //========================================================================================================
    // Action
    //========================================================================================================

    public function __invoke() : Response
    {
        throw new LogicException("This point should never be reached! Don't forget to activate logout in security.yaml");
    }
    
    
    
}
