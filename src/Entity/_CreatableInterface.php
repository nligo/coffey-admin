<?php

namespace App\Entity;

interface _CreatableInterface
{
    public function setCreatedAt(\DateTimeInterface $createdAt);

    public function getCreatedAt();
}
