<?php

namespace App\Entity;

trait _CreatableTrait
{
    /**
     * @ORM\Column(type="datetime", options={"comment": "创建时间"})
     */
    private $createdAt;

    public function setCreatedAt(\DateTimeInterface $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function hasCreatedAt()
    {
        return null !== $this->createdAt;
    }
}
