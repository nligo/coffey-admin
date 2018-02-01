<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @UniqueEntity("username")
 */
class User implements UserInterface, _CreatableInterface
{
    use _CreatableTrait;

    const ON_PRE_CREATED = 'pre_created'; // 创建事件名称
    const ON_PRE_UPDATED = 'pre_updated'; // 更新事件名称

    const ROLE_ADMIN = 'ROLE_ADMIN'; // 管理员

    public static $roles = [
        self::ROLE_ADMIN => '管理员',
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"comment": "用户 ID"})
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32, unique=true, options={"fixed": true, "comment": "用户名"})
     */
    private $username = "";


    /**
     * @ORM\Column(type="string", length=32, options={"fixed": true})
     *
     * @Assert\NotBlank(groups={"role"})
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=60, options={"comment": "登录密码"})
     */
    private $password;

    /**
     * 用户明文密码
     *
     * @var string 明文密码
     *
     * @Assert\NotBlank(groups={"plainPassword"})
     * @Assert\Length(min=6, max=16, groups={"plainPassword"})
     * @Assert\Regex("/[0-9A-Za-z.-_]$/", message="user_password_rule", groups={"plainPassword"})
     */
    private $plainPassword;

    private $passwordEncoder;

    public function __construct($username = null, $plainPassword = null, $role = self::ROLE_ADMIN)
    {
        $this->username = $username;
        $this->plainPassword = $plainPassword;

        $this->setRole($role);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getRoleName()
    {
        return isset(self::$roles[$this->role])
            ? self::$roles[$this->role] : '-';
    }

    public function getRoles()
    {
        return (array) $this->role;
    }



    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function getSalt()
    {
        return;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
        return;
    }
}
