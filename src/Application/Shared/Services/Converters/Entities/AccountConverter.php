<?php declare(strict_types=1);

namespace App\Application\Shared\Services\Converters\Entities;

use App\Domain\Core\Account\Account;
use App\Domain\Core\Account\Query\OneAccount;
use InvalidArgumentException;
use Mediagone\CQRS\Bus\Domain\Query\QueryBus;
use Mediagone\SmallUid\SmallUid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Supply any controller parameter "$account" from a route attribute "accountId".
 */
final class AccountConverter implements ParamConverterInterface
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private QueryBus $queryBus;
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }
    
    
    //========================================================================================================
    // Methods
    //========================================================================================================
    
    public function supports(ParamConverter $configuration) : bool
    {
        return $configuration->getClass() === Account::class;
    }
    
    
    public function apply(Request $request, ParamConverter $configuration)
    {
        $paramName = $configuration->getName();

        if ($request->get($paramName.'Id')) {
            $account = $this->findById($request->get($paramName.'Id'));
        }
        else {
            $account = null;
        }
        
        if (! $account && $configuration->isOptional() === false) {
            throw new NotFoundHttpException('Account not found.');
        }
        
        $request->attributes->set($configuration->getName(), $account);
    }



    //========================================================================================================
    // Helpers
    //========================================================================================================

    private function findById(string $id) : ?Account
    {
        try {
            return $this->queryBus->find(
                OneAccount::asEntity()->byId(SmallUid::fromString($id))
            );
        }
        catch (InvalidArgumentException $ex) {
            return null;
        }
    }
    
    
    
}
