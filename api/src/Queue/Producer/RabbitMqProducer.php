<?php declare(strict_types=1);

namespace App\Queue\Producer;

use App\Queue\Message\NamedMessageInterface;

class RabbitMqProducer extends AbstractProducer implements ProducerInterface
{
    /** @var \OldSound\RabbitMqBundle\RabbitMq\ProducerInterface $producer */
    protected $producer;

    /**
     * RabbitMqProducer constructor.
     * @param \OldSound\RabbitMqBundle\RabbitMq\ProducerInterface $producer
     */
    public function __construct(\OldSound\RabbitMqBundle\RabbitMq\ProducerInterface $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @param NamedMessageInterface $namedMessage
     * @todo implements a better serialization process
     */
    public function publish(NamedMessageInterface $namedMessage) : void
    {
        $this->producer->publish($this->createEnvelope($namedMessage));
    }
}
