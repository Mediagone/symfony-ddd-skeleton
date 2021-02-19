<?php declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


final class Fixtures extends Fixture
{
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct()
    {
        
    }
    
    
    
    //========================================================================================================
    // Methods
    //========================================================================================================
    
    public function load(ObjectManager $em) : void
    {
        FixturesAccount::load($em);
    }
    
    
    
}
