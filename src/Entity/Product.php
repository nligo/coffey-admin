<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(options={"comment": "产品表"})
 */
class Product implements _CreatableInterface,_UpdatableInterface
{
    use _CreatableTrait,_UpdatableTrait;


    const ON_PRE_CREATED = 'pre_created'; // 创建事件名称
    const ON_PRE_UPDATED = 'pre_updated'; // 更新事件名称

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $name;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    public $price;

    /**
     * @ORM\Column(type="text")
     */
    public $description;
}
