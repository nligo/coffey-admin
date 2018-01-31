<?php

namespace App\EventListener;

use App\Entity\_SortableInterface;
use App\Entity\_CreatableInterface;
use App\Entity\_UpdatableInterface;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class AutoFixtureSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof _SortableInterface && !$entity->hasSort()) {
            $entity->setSort(_SortableInterface::DEFAULT_SORT);
        }

        if ($entity instanceof _CreatableInterface && !$entity->hasCreatedAt()) {
            $entity->setCreatedAt(new \DateTime());
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof _SortableInterface && !$entity->hasSort()) {
            $entity->setSort(_SortableInterface::DEFAULT_SORT);
        }

        if ($entity instanceof _UpdatableInterface) {
            $entity->setUpdatedAt(new \DateTime());
        }
    }
}
