<?php declare(strict_types=1);

namespace App\Queue\Consumer;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SynchronousConsumer
{
    use DenormalizerTrait;

    /** @var EventDispatcherInterface $dispatcher */
    protected $dispatcher;

    /**
     * SynchronousConsumer constructor.
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param string $msg
     */
    public function consume(string $msg)
    {
        $message = $this->denormalizeMessage($msg);

        $this->dispatcher->dispatch($message->getMessageName(), $message);
    }
}
