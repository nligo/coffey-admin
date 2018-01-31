<?php

namespace App\Entity;

trait _DeletableTrait
{
    /**
     * @ORM\Column(type="datetime", nullable=true, options={"comment": "删除时间"})
     */
    private $deletedAt;

    public function setDeletedAt(\DateTimeInterface $deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function hasDeletedAt()
    {
        return null !== $this->deletedAt;
    }
}
