<?php

declare(strict_types=1);

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Demande;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class CurrentUserForDemandeSubscriber implements EventSubscriberInterface
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['currentUserForDemande', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function currentUserForDemande(ViewEvent $event): void
    {
        $article = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($article instanceof Demande && Request::METHOD_POST === $method) {
            $article->setUser($this->security->getUser());
        }
    }
}
