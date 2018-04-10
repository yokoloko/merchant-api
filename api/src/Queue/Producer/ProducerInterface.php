<?php

namespace App\Queue\Producer;

use App\Queue\Message\NamedMessageInterface;

interface ProducerInterface
{
    /**
     * Publish a message
     *
     * @param NamedMessageInterface $namedMessage
     */
    public function publish(NamedMessageInterface $namedMessage) : void;
}
