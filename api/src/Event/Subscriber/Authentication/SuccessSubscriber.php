<?php declare(strict_types=1);

namespace App\Event\Subscriber\Authentication;

use App\Entity\User;
use App\Event\AuthenticationMessages;
use App\Queue\Bus;
use App\Queue\Message\AuthenticationMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class SuccessSubscriber implements EventSubscriberInterface
{
    /** @var EntityManagerInterface $entityManager */
    protected $entityManager;

    /** @var Bus $eventBus */
    protected $eventBus;

    /** @var \Swift_Mailer $mailer */
    protected $mailer;

    /**
     * SuccessSubscriber constructor.
     * @param EntityManagerInterface $entityManager
     * @param Bus $eventBus
     * @param \Swift_Mailer $mailer
     */
    public function __construct(EntityManagerInterface $entityManager, Bus $eventBus, \Swift_Mailer $mailer)
    {
        $this->entityManager = $entityManager;
        $this->eventBus = $eventBus;
        $this->mailer = $mailer;
    }

    /**
     * @param AuthenticationEvent $event
     */
    public function onAuthenticationSuccess(AuthenticationEvent $event): void
    {
        $user = $event->getAuthenticationToken()->getUser();

        if ($user instanceof User) {
            $user->setLastLogin(new \DateTime());
            $this->entityManager->flush();
            $this->eventBus->publish(
                new AuthenticationMessage(
                    AuthenticationMessages::AUTHENTICATION_SUCCESS,
                    $user->getId(),
                    $user->getEmail()
                )
            );
        }
    }

    /**
     * @param AuthenticationMessage $event
     */
    public function onAuthenticationMessageSuccess(AuthenticationMessage $event): void
    {
        $message = (new \Swift_Message($event->getMessageName()))
            ->setFrom('send@example.com')
            ->setTo($event->getEmail())
            ->setBody('xoxo');

        $this->mailer->send($message);
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            AuthenticationEvents::AUTHENTICATION_SUCCESS   => 'onAuthenticationSuccess',
            AuthenticationMessages::AUTHENTICATION_SUCCESS => 'onAuthenticationMessageSuccess',
        ];
    }
}
