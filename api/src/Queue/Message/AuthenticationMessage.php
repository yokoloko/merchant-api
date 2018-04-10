<?php declare(strict_types=1);

namespace App\Queue\Message;

use Symfony\Component\EventDispatcher\Event;

class AuthenticationMessage extends Event implements NamedMessageInterface
{
    /** @var string $name */
    protected $eventName;

    /** @var int $id User id */
    protected $id;

    /** @var string $email */
    protected $email;

    /**
     * AuthenticationEvent constructor.
     * @param string $eventName
     * @param int $id
     * @param $email
     */
    public function __construct(string $eventName, int $id, $email)
    {
        $this->id = $id;
        $this->email = $email;
        $this->eventName = $eventName;
    }

    /**
     * @return string
     */
    public function getMessageName(): string
    {
        return $this->eventName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
