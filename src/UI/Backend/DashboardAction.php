<?php declare(strict_types=1);

namespace App\UI\Backend;

use App\UI\Backend\Views\Pages\Dashboard;
use App\UI\Shared\Services\ControllerResponses;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin", name="backend_dashboard", methods={"GET"})
 */
final class DashboardAction
{
    //========================================================================================================
    // Action
    //========================================================================================================
    
    public function __invoke(ControllerResponses $responses) : Response
    {
        return $responses->template('Backend/Views/Pages/Dashboard.twig', [
            'MODEL' => new Dashboard(),
        ]);
    }
    
    
    
}
