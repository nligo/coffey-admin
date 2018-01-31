<?php

namespace App\Entity;

interface _SortableInterface
{
    const DEFAULT_SORT = 255;

    public function setSort($sort);

    public function getSort();
}
