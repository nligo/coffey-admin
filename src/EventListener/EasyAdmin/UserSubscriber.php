<?php

namespace App\EventListener\EasyAdmin;

use App\Entity\User;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserSubscriber implements EventSubscriberInterface
{
    protected $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public static function getSubscribedEvents()
    {
        return array(
            'easy_admin.pre_persist' => array('encodePassword'),
            'easy_admin.pre_update' => array('encodePassword'),
        );
    }

    public function encodePassword(GenericEvent $event)
    {
        $user = $event->getSubject();

        if (!($user instanceof User)) {
            return;
        }

        if (null !== $password = $user->getPassword()) {
            $password = $this->passwordEncoder->encodePassword($user, $password);
            $user->setPassword($password);
        }
    }
}
