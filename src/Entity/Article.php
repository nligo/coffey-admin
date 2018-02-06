<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ORM\Table(options={"comment": "文章内容表"})
 * @Vich\Uploadable
 */
class Article implements _CreatableInterface, _UpdatableInterface
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
     * @ORM\Column(type="text", options={"comment": "文章内容"})
     */
    private $content = '';

    /**
     * @ORM\Column(type="boolean", options={"comment": "文章的模式:0为私有，1为公开"})
     */
    private $type = false;

    /**
     * @ORM\Column(type="boolean", options={"comment": "是否置顶:0为否，1为是"})
     */
    private $isUp = false;

    /**
     * @ORM\Column(type="boolean", options={"comment": "是否博主推荐:0为否，1为是"})
     */
    private $isSupport = false;

    /**
     * @ORM\Column(type="datetime", options={"comment": "发布时间"})
     */
    private $releaseAt;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="articles")
     * @ORM\JoinTable(name="category_articles")
     * @ORM\OrderBy({"id" : "DESC"})
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="article")
     */
    private $comments;

    /**
     * It only stores the name of the image associated with the product.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $cover;

    /**
     * This unmapped property stores the binary contents of the image file
     * associated with the product.
     *
     * @Vich\UploadableField(mapping="article_image", fileNameProperty="cover")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $user
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;
    }


    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function __toString()
    {
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

    /**
     * @return mixed
     */
    public function getReleaseAt()
    {
        return $this->releaseAt;
    }

    /**
     * @param mixed $releaseAt
     */
    public function setReleaseAt($releaseAt)
    {
        $this->releaseAt = $releaseAt;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getIsUp()
    {
        return $this->isUp;
    }

    /**
     * @param mixed $isUp
     */
    public function setIsUp($isUp)
    {
        $this->isUp = $isUp;
    }

    /**
     * @return mixed
     */
    public function getIsSupport()
    {
        return $this->isSupport;
    }

    /**
     * @param mixed $isSupport
     */
    public function setIsSupport($isSupport)
    {
        $this->isSupport = $isSupport;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function hasCategory()
    {
        return !$this->categories->isEmpty();
    }

    public function addCategory(Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    public function removeCategory(Category $category)
    {
        $this->categories->removeElement($category);
    }

    public function hasComment()
    {
        return !$this->comments->isEmpty();
    }

    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    public function removeComment(Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param string $cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }

    /**
     * @param File $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
    }
    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }
}
