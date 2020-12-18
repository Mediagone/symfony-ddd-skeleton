<?php declare(strict_types=1);

namespace App\Infrastructure\Fixtures;

use App\Domain\Core\Account\Account;
use App\Domain\Core\Account\AccountId;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use function password_hash;


final class AccountFixtures extends Fixture
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
        $account = new Account(
            AccountId::fromString('01ESTQSNZDJCC5GGVZ1PBYJQER'),
            'Admin',
            'admin@dev.com',
            password_hash('pass', PASSWORD_BCRYPT, ['cost' => 14])
        );
        $em->persist($account);
        
        $em->flush();
    }
    
    
    
}
