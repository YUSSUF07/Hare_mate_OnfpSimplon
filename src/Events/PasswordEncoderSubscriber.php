<?php

declare(strict_types=1);

namespace App\Events;

use App\Entity\Utilisateur;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UtilisateurPasswordEncoderInterface;

class PasswordEncoderSubscriber implements EventSubscriberInterface
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['encodePassword', EventPriorities::PRE_WRITE],
        ];
    }

    public function encodePassword(ViewEvent $event): void
    {
        $utilisateur = $event->getControllerResult();

        if ($utilisateur instanceof Utilisateur) {
            $passHash = $this->encoder->encodePassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($passHash);
        }
    }
}
