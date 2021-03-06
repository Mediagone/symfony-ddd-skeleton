<?php declare(strict_types=1);

namespace App\Application\Frontend\Website;

use App\Application\Frontend\Website\Views\Pages\Error;
use App\Application\Shared\Services\ControllerResponses;
use Symfony\Component\ErrorHandler\ErrorRenderer\ErrorRendererInterface;
use Symfony\Component\HttpFoundation\Response;
use Throwable;


final class ErrorAction
{
    //========================================================================================================
    // Action
    //========================================================================================================
    
    public function __invoke(Throwable $exception, bool $kernelDebug, ErrorRendererInterface $errorRenderer, ControllerResponses $responses) : Response
    {
        $flattenException = $errorRenderer->render($exception);
        
        if ($kernelDebug && $exception->getMessage() !== 'This is a sample exception.') {
            return new Response($flattenException->getAsString(), $flattenException->getStatusCode(), $flattenException->getHeaders());
        }
        
        switch ($flattenException->getStatusCode()) {
            case 403:
                $templateName = 'Error403';
                break;
            case 404:
                $templateName = 'Error404';
                break;
            case 500:
                $templateName = 'Error500';
                break;
            default:
                $templateName = 'Error';
                break;
        }
        
        return $responses->template("Frontend/Website/Views/Pages/$templateName.twig", [
            'MODEL' => new Error($flattenException->getStatusCode()),
        ]);
    }
    
    
    
}
