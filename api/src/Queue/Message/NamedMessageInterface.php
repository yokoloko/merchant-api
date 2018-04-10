<?php

namespace App\Queue\Message;

interface NamedMessageInterface
{
    /**
     * Get message name
     *
     * @return string
     */
    public function getMessageName() : string;
}
