<?php

namespace App\EventListener\EasyAdmin;

use App\Entity\User;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
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
            'easy_admin.pre_persist' => array('prePersist'),
        );
    }

    public function prePersist(GenericEvent $event)
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
