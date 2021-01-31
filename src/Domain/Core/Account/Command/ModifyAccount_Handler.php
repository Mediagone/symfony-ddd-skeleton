<?php declare(strict_types=1);

namespace App\Domain\Core\Account\Command;

use Doctrine\ORM\EntityManagerInterface;
use Mediagone\CQRS\Bus\Domain\Command\Command;
use Mediagone\CQRS\Bus\Domain\Command\CommandHandler;


final class ModifyAccount_Handler implements CommandHandler
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private EntityManagerInterface $em;
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    
    
    //========================================================================================================
    // Methods
    //========================================================================================================
    
    /**
     * @param ModifyAccount $command
     */
    public function handle(Command $command) : void
    {
        $account = $command->getAccount();
        $account->setLastname($command->getLastname());
        $account->setForename($command->getForename());
        $account->setEmail($command->getEmail());
        
        $this->em->persist($account);
    }
    
    
    
}
