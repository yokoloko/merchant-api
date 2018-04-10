<?php declare(strict_types=1);

namespace Tests\Event\Subscriber\Kernel;

use App\Event\Subscriber\Kernel\SetHeaderSubscriber;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class SetHeaderSubscriberTest extends TestCase
{
    public function testOnKernelResponseGet()
    {
        $event = $this->createMock(FilterResponseEvent::class);
        $request = $this->createMock(Request::class);
        $response = $this->createMock(ResponseInterface::class);
        $headers = $this->createMock(ResponseHeaderBag::class);

        $response->headers = $headers;

        $event
            ->expects($this->once())
            ->method('getRequest')
            ->willReturn($request);

        $event
            ->expects($this->once())
            ->method('getResponse')
            ->willReturn($response);

        $request
            ->expects($this->once())
            ->method('isMethod')
            ->with('GET')
            ->willReturn(true);

        $headers
            ->expects($this->once())
            ->method('set')
            // @todo inject datime to the listener for testing
            ->with('Generation-Date', (new \DateTime())->format('Y-m-d H:i:is'));

        $subscriber = new SetHeaderSubscriber();
        $subscriber->onKernelResponse($event);
    }

    public function testOnKernelResponsePost()
    {
        $event = $this->createMock(FilterResponseEvent::class);
        $request = $this->createMock(Request::class);
        $response = $this->createMock(ResponseInterface::class);
        $headers = $this->createMock(ResponseHeaderBag::class);

        $response->headers = $headers;

        $event
            ->expects($this->once())
            ->method('getRequest')
            ->willReturn($request);

        $event
            ->expects($this->never())
            ->method('getResponse');

        $request
            ->expects($this->once())
            ->method('isMethod')
            ->with('GET')
            ->willReturn(false);

        $subscriber = new SetHeaderSubscriber();
        $subscriber->onKernelResponse($event);
    }
}
