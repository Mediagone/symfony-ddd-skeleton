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
        return $configuration->getClass() === Account::class && $configuration->getName() === 'account';
    }
    
    
    public function apply(Request $request, ParamConverter $configuration)
    {
        try {
            $accountId = $request->get('accountId');
            $uid = SmallUid::fromString($accountId);
        }
        catch (InvalidArgumentException $ex) {
            throw new NotFoundHttpException($ex->getMessage());
        }
        
        /** @var Account|null $account */
        $account = $this->queryBus->find(
            OneAccount::asEntity()->byId($uid)
        );
        if (! $account && $configuration->isOptional() === false) {
            throw new NotFoundHttpException('Account not found.');
        }
        
        $request->attributes->set($configuration->getName(), $account);
    }
    
    
    
}
