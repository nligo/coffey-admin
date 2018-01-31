<?php

namespace App\EventListener;

use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;

class TablePrefixSubscriber implements EventSubscriber
{
    protected $prefix;

    public function __construct($prefix)
    {
        $this->prefix = $prefix;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::loadClassMetadata,
        ];
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $args)
    {
        $metadata = $args->getClassMetadata();

        if (!$metadata->isInheritanceTypeSingleTable() || $metadata->getName() === $metadata->rootEntityName) {
            $metadata->setPrimaryTable([
                'name' => $this->prefix.$metadata->getTableName(),
            ]);
        }

        foreach ($metadata->getAssociationMappings() as $fieldName => $mapping) {
            if (ClassMetadataInfo::MANY_TO_MANY == $mapping['type'] && $mapping['isOwningSide']) {
                $mappedTableName = $mapping['joinTable']['name'];
                $metadata->associationMappings[$fieldName]['joinTable']['name'] = $this->prefix.$mappedTableName;
            }
        }
    }
}
