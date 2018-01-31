<?php

namespace App\Entity;

interface _DeletableInterface
{
    public function setDeletedAt(\DateTimeInterface $deletedAt);

    public function getDeletedAt();
}
