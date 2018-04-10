<?php declare(strict_types=1);

namespace App\Queue\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use PhpAmqpLib\Message\AMQPMessage;


class RabbitMqConsumer implements ConsumerInterface
{
    use DenormalizerTrait;

    /** @var RabbitMqConsumer $consumer */
    protected $consumer;

    /** @var EventDispatcherInterface $dispatcher */
    protected $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param AMQPMessage $msg
     * @return void
     */
    public function execute(AMQPMessage $msg): void
    {
        $message = $this->denormalizeMessage($msg->getBody());

        $this->dispatcher->dispatch($message->getMessageName(), $message);
    }
}
