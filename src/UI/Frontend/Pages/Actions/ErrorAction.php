<?php declare(strict_types=1);

namespace App\UI\Frontend\Pages\Actions;

use App\UI\Frontend\Pages\Views\Error;
use App\UI\Shared\Services\ControllerResponses;
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
        
        return $responses->template("Frontend/Pages/Views/$templateName.twig", [
            'MODEL' => new Error($flattenException->getStatusCode()),
        ]);
    }
    
    
    
}
