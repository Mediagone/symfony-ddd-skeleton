<?php declare(strict_types=1);

namespace App\Domain\Core\Account\Query\Specifications;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Mediagone\Doctrine\Specifications\Specification;


final class FilterAccountWithForenameOrLastnameLike implements Specification
{
    //========================================================================================================
    // Properties
    //========================================================================================================

    private string $name;
    
    
    
    //========================================================================================================
    // Constructors
    //========================================================================================================
    
    private function __construct(string $name)
    {
        $this->name = $name;
    }
    
    
    public static function specification(string $name) : self
    {
        return new self($name);
    }
    
    
    
    //========================================================================================================
    // Methods
    //========================================================================================================
    
    public function modifyBuilder(QueryBuilder $builder) : void
    {
        $builder
            ->andWhere("CONCAT(account.forename, ' ', account.lastname) LIKE :searchName")
            ->setParameter('searchName', '%'.$this->name.'%')
        ;
    }
    
    
    public function modifyQuery(Query $query) : void
    {
        // Do nothing
    }
    
    
    
}
