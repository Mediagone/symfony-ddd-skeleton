<?php declare(strict_types=1);

namespace App\UI\Shared;

use Psr\Log\LoggerInterface;


final class ControllerLogs
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private LoggerInterface $logger;
    
    
    
    //========================================================================================================
    // Constructor
    //========================================================================================================
    
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    
    
    //========================================================================================================
    // Methods
    //========================================================================================================
    
    /**
     * System is unusable.
     * It should trigger the SMS alerts and wake you up.
     */
    public function emergency(string $message, array $context = []) : void
    {
        $this->logger->emergency($message, $context);
    }
    
    
    /**
     * Action must be taken immediately.
     * It should trigger the SMS alerts and wake you up.
     *      Example: Entire website down, database unavailable, etc.
     */
    public function alert(string $message, array $context = []) : void
    {
        $this->logger->alert($message, $context);
    }
    
    
    /**
     * Critical conditions.
     *      Example: Application component unavailable, unexpected exception.
     */
    public function critical(string $message, array $context = []) : void
    {
        $this->logger->critical($message, $context);
    }
    
    
    /**
     * Runtime errors that do not require immediate action but should typically be logged and monitored.
     */
    public function error(string $message, array $context = []) : void
    {
        $this->logger->error($message, $context);
    }
    
    
    /**
     * Exceptional occurrences that are not errors.
     *      Example: Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.
     */
    public function warning(string $message, array $context = []) : void
    {
        $this->logger->warning($message, $context);
    }
    
    
    /**
     * Normal but significant events.
     */
    public function notice(string $message, array $context = []) : void
    {
        $this->logger->notice($message, $context);
    }
    
    
    /**
     * Interesting events.
     *      Example: User logs in, SQL logs.
     */
    public function info(string $message, array $context = []) : void
    {
        $this->logger->info($message, $context);
    }
    
    
    /**
     * Detailed debug information.
     */
    public function debug(string $message, array $context = []) : void
    {
        $this->logger->debug($message, $context);
    }
    
    
    
}
