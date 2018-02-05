<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(options={"comment": "文章分类表"})
 */
class Category implements _CreatableInterface, _UpdatableInterface
{
    use _CreatableTrait,_UpdatableTrait;

    const ON_PRE_CREATED = 'pre_created'; // 创建事件名称
    const ON_PRE_UPDATED = 'pre_updated'; // 更新事件名称

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, options={"comment": "文章名称"})
     */
    private $name = '';

    /**
     * @ORM\ManyToMany(targetEntity="Article", mappedBy="categories")
     * @ORM\OrderBy({"createdAt": "ASC"})
     */
    private $articles;

    /**
     * The category parent.
     *
     * @var Category
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     **/
    protected $parent;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function __toString() {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getArticles()
    {
        return $this->articles;
    }

    public function hasArticle()
    {
        return !$this->articles->isEmpty();
    }

    public function addArticle(Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Set the parent category.
     *
     * @param Category $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
    /**
     * Get the parent category.
     *
     * @return Category
     */
    public function getParent()
    {
        return $this->parent;
    }
}
