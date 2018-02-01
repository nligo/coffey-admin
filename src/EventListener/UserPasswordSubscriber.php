<?php

namespace App\EventListener;

use App\Entity\User;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserPasswordSubscriber implements EventSubscriberInterface
{
    protected $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public static function getSubscribedEvents()
    {
        return [
            User::ON_PRE_CREATED => 'encodeUserPassword',
            User::ON_PRE_UPDATED => 'encodeUserPassword',
        ];
    }

    public function encodeUserPassword(GenericEvent $event)
    {
        $user = $event->getSubject();
        if (!$user instanceof User) {
            return;
        }

        if (null !== $plainPassword = $user->getPlainPassword()) {
            $password = $this->passwordEncoder->encodePassword($user, $plainPassword);
            $user->setPassword($password);
        }
    }
}
