<?php declare(strict_types=1);

namespace App\Domain\Core\Account\Query\Specifications;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Mediagone\Doctrine\Specifications\Specification;
use Mediagone\SmallUid\SmallUid;


final class GetAccountById implements Specification
{
    //========================================================================================================
    // Properties
    //========================================================================================================

    private SmallUid $id;
    
    
    
    //========================================================================================================
    // Constructors
    //========================================================================================================
    
    private function __construct(SmallUid $id)
    {
        $this->id = $id;
    }
    
    
    public static function specification(SmallUid $id) : self
    {
        return new self($id);
    }
    
    
    
    //========================================================================================================
    // Methods
    //========================================================================================================
    
    public function modifyBuilder(QueryBuilder $builder) : void
    {
        $builder
            ->andWhere("account.id = :id")
            ->setParameter('id', $this->id, 'app_smalluid')
        ;
    }
    
    
    public function modifyQuery(Query $query) : void
    {
        // Do nothing
    }
    
    
    
}
