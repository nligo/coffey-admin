<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

trait _SortableTrait
{
    /**
     * @ORM\Column(type="smallint", options={"comment": "显示排序", "unsigned": true})
     *
     * @Assert\Range(min=0, max=65535)
     */
    private $sort;

    public function setSort($sort)
    {
        $sort = (int) $sort;
        $this->sort = ($sort > 65535) ? 65535 : $sort;

        return $this;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function hasSort()
    {
        return null !== $this->sort;
    }
}
