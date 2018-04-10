<?php declare(strict_types=1);

namespace App\Event\Subscriber\Kernel;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class SetHeaderSubscriber implements EventSubscriberInterface
{
    /**
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event):void
    {
        if ($event->getRequest()->isMethod('GET')) {
            // $event->getResponse()->headers->set('Generation-Date', (new \DateTime())->format('Y-m-d H:i:is'));
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse'
        ];
    }
}
