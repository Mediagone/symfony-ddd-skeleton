<?php declare(strict_types=1);

namespace App\Domain\Core\Account\Query\Specifications;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Mediagone\Doctrine\Specifications\Specification;
use Symfony\Component\Uid\Ulid;


final class GetAccountById implements Specification
{
    //========================================================================================================
    // Properties
    //========================================================================================================

    private Ulid $id;
    
    
    
    //========================================================================================================
    // Constructors
    //========================================================================================================
    
    private function __construct(Ulid $id)
    {
        $this->id = $id;
    }
    
    
    public static function specification(Ulid $id) : self
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
            ->setParameter('id', $this->id, 'ulid')
        ;
    }
    
    
    public function modifyQuery(Query $query) : void
    {
        // Do nothing
    }
    
    
    
}
