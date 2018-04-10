<?php declare(strict_types=1);

namespace App\Queue\Producer;

use App\Queue\Consumer\SynchronousConsumer;
use App\Queue\Message\NamedMessageInterface;


class SynchronousProducer extends AbstractProducer implements ProducerInterface
{
    /** @var SynchronousConsumer $dispatcher */
    protected $consumer;

    /**
     * EventConsumer constructor.
     * @param SynchronousConsumer $consumer
     */
    public function __construct(SynchronousConsumer $consumer)
    {
        $this->consumer = $consumer;
    }

    /**
     * @param NamedMessageInterface $namedMessage
     */
    public function publish(NamedMessageInterface $namedMessage) : void
    {
        $this->consumer->consume($this->createEnvelope($namedMessage));
    }
}
