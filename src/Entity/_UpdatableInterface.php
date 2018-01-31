<?php

namespace App\Entity;

interface _UpdatableInterface
{
    public function setUpdatedAt(\DateTimeInterface $updatedAt);

    public function getUpdatedAt();
}
