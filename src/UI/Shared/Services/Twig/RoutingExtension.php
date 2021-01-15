<?php declare(strict_types=1);

namespace App\UI\Shared\Services\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use function strpos;


final class RoutingExtension extends AbstractExtension
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private RequestStack $requestStack;
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
    
    
    
    //========================================================================================================
    //
    //========================================================================================================
    
    public function getName() : string
    {
        return 'RoutingExtension';
    }
    
    
    public function getFunctions() : array
    {
        return [
            new TwigFunction('current_path', [$this, 'currentPath']),
            new TwigFunction('current_path_with_query', [$this, 'currentPathWithQuery']),
            new TwigFunction('is_current_path', [$this, 'isCurrentPath']),
            new TwigFunction('is_current_path_or_child', [$this, 'isCurrentPathOrChild']),
        ];
    }
    
    
    
    //========================================================================================================
    // Helpers
    //========================================================================================================
    
    public function currentPath() : ?string
    {
        $request = $this->requestStack->getCurrentRequest();
        
        return $request ? $request->getPathInfo() : null;
    }
    
    
    public function currentPathWithQuery() : ?string
    {
        $request = $this->requestStack->getCurrentRequest();
        
        return $request ? $request->getRequestUri() : null;
    }
    
    
    public function isCurrentPath(string $path) : bool
    {
        return $path === $this->currentPath();
    }
    
    
    public function isCurrentPathOrChild(string $path) : bool
    {
        return strpos($this->currentPath(), $path) === 0;
    }
    
    
    
}
