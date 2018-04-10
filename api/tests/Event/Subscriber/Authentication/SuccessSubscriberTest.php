<?php declare(strict_types=1);

namespace Tests\Event\Subscriber\Authentication;

use App\Event\Subscriber\Authentication\SuccessSubscriber;
use App\Queue\Bus;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class SuccessSubscriberTest extends TestCase
{
    /** @var SuccessSubscriber $subject */
    protected $subject;
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

    public function setUp()
    {
        $entityManager = $this->createMock(EntityManager::class);
        $eventBus = $this->createMock(Bus::class);
        $mailer = $this->createMock(\Swift_Mailer::class);

        $this->subject = new SuccessSubscriber($entityManager, $eventBus, $mailer);
    }

    public function testOnAuthenticationSuccessUser()
    {
        $event = $this->createMock(AuthenticationEvent::class);
        $token = $this->createMock(TokenInterface::class);
        $user  = $this->createMock(UserInterface::class);

        $event
            ->expects($this->once())
            ->method('getAuthenticationToken')
            ->willReturn($token);

        $token
            ->expects($this->once())
            ->method('getUser')
            ->willReturn($user);

        $user
            ->expects($this->never())
            ->method('setLastLogin');

        $this->subject->onAuthenticationSuccess($event);
    }
}
