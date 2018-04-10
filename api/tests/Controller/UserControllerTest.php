<?php declare(strict_types=1);

namespace Tests\Controller;

use App\Controller\UserController;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserControllerTest extends TestCase
{
    public function testPostAction()
    {
        $user = new User();
        $user->setPassword('pass');
        $encoder = $this->createMock(UserPasswordEncoderInterface::class);

        $encoder
            ->expects($this->once())
            ->method('encodePassword')
            ->with($user, 'pass')
            ->willReturn('encoded');

        $controller = new UserController();
        $result = $controller->postAction($user, $encoder);

        $this->assertEquals('encoded', $result->getPassword());
    }

    public function testPutAction()
    {
        $user = new User();
        $user->setPassword('pass');
        $encoder = $this->createMock(UserPasswordEncoderInterface::class);

        $encoder
            ->expects($this->once())
            ->method('encodePassword')
            ->with($user, 'pass')
            ->willReturn('encoded');

        $controller = new UserController();
        $result = $controller->putAction($user, $encoder);

        $this->assertEquals('encoded', $result->getPassword());
    }
}
