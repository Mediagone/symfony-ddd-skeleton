<?php declare(strict_types=1);

namespace App\UI\Shared;

use LogicException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;


final class ControllerResponses
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private Environment $twig;
    
    private RouterInterface $router;
    
    private RequestStack $requestStack;
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(Environment $twig, RouterInterface $router, RequestStack $requestStack)
    {
        $this->twig = $twig;
        $this->router = $router;
        $this->requestStack = $requestStack;
    }
    
    
    
    //========================================================================================================
    // Methods
    //========================================================================================================
    
    /**
     * Renders a template and returns an OK (200) Response.
     */
    public function template(string $templateName, array $templateContext = [], int $status = 200) : Response
    {
        return new Response($this->twig->render($templateName, $templateContext), $status);
    }
    
    
    /**
     * Returns a permanent (301) RedirectResponse to the given route with the given parameters.
     */
    public function permanentRedirection(string $route, array $parameters = []) : RedirectResponse
    {
        $url = $this->router->generate($route, $parameters, UrlGeneratorInterface::ABSOLUTE_PATH);
        return new RedirectResponse($url, 301);
    }
    
    
    /**
     * Returns a permanent (301) RedirectResponse to the given url.
     */
    public function permanentRedirectionUrl(string $url) : RedirectResponse
    {
        return new RedirectResponse($url, 301);
    }
    
    
    /**
     * Returns a temporary (307) RedirectResponse to the given route with the given parameters.
     */
    public function temporaryRedirection(string $route, array $parameters = []) : RedirectResponse
    {
        $url = $this->router->generate($route, $parameters, UrlGeneratorInterface::ABSOLUTE_PATH);
        return new RedirectResponse($url, 307);
    }
    
    
    /**
     * Returns a see-other (303) RedirectResponse to the given route with the given parameters.
     */
    public function seeOtherRedirection(string $route, array $parameters = []) : RedirectResponse
    {
        $url = $this->router->generate($route, $parameters, UrlGeneratorInterface::ABSOLUTE_PATH);
        return new RedirectResponse($url, 303);
    }
    
    
    /**
     * Returns a see-other (303) RedirectResponse to the current URL.
     */
    public function refreshRedirection() : RedirectResponse
    {
        if ($this->requestStack->getCurrentRequest() === null) {
            throw new LogicException('The current request is unavailable.');
        }
        
        return new RedirectResponse($this->requestStack->getCurrentRequest()->getUri(), 303);
    }
    
    
    
}
