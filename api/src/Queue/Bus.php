<?php declare(strict_types=1);

namespace App\Queue;

use App\Queue\Message\NamedMessageInterface;
use App\Queue\Producer\ProducerInterface;
use Psr\Log\LoggerInterface;

class Bus
{
    /** @var ProducerInterface $producer */
    protected $producer;

    /** @var LoggerInterface $logger */
    protected $logger;

    /**
     * EventBus constructor.
     *
     * @param ProducerInterface $producer
     * @param LoggerInterface $logger
     */
    public function __construct(ProducerInterface $producer, LoggerInterface $logger)
    {
        $this->logger   = $logger;
        $this->producer = $producer;
    }

    /**
     * @param NamedMessageInterface $namedMessage
     */
    public function publish(NamedMessageInterface $namedMessage): void
    {
        $this->logger->debug('Publish message on bus for routing key : ' . $namedMessage->getMessageName());
        $this->producer->publish($namedMessage);
    }
}
