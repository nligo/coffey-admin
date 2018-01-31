<?php

namespace App\Entity;

trait _UpdatableTrait
{
    /**
     * @ORM\Column(type="datetime", nullable=true, options={"comment": "更新时间"})
     */
    private $updatedAt;

    public function setUpdatedAt(\DateTimeInterface $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function hasUpdatedAt()
    {
        return null !== $this->updatedAt;
    }
}
