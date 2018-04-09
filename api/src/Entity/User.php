<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @ApiResource(
 *  attributes={
 *      "normalization_context"={"groups"={"user", "user-read"}},
 *      "denormalization_context"={"groups"={"user", "user-write"}}
 *  }, itemOperations={
 *      "get",
 *      "delete",
 *      "put"={"route_name"="api_users_put"}
 *  }, collectionOperations={
 *      "get",
 *      "post"={"route_name"="api_users_post"}
 *  }
 * )
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string|null
     *
     * @Groups({"user"})
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    protected $email;

    /**
     * @var string|null
     *
     * @Groups({"user-wrddite"})
     * @ORM\Column(name="password", type="string", length=64, nullable=true)
     */
    protected $password;

    /**
     * @var string|null
     *
     * @Groups({"user"})
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    protected $name;

    /**
     * @var string|null
     *
     * @Groups({"user"})
     * @ORM\Column(name="profileUrl", type="string", length=255, nullable=true)
     */
    protected $profileUrl;

    /**
     * @var \DateTime|null
     *
     * @Groups({"user"})
     * @ORM\Column(name="lastLogin", type="datetime", nullable=true)
     */
    protected $lastLogin;

    /**
     * @var \DateTime
     *
     * @Groups({"user"})
     * @ORM\Column(name="creationDate", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    protected $creationDate;

    /**
     * @var Commission[]
     * @ORM\OneToMany(targetEntity="Commission", mappedBy="user")
     */
    protected $commissions;

    /**
     * @param
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param null|string $email
     * @return User
     */
    public function setEmail(?string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param null|string $password
     * @return User
     */
    public function setPassword(?string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     * @return User
     */
    public function setName(?string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getProfileUrl(): ?string
    {
        return $this->profileUrl;
    }

    /**
     * @param null|string $profileUrl
     * @return User
     */
    public function setProfileUrl(?string $profileUrl): User
    {
        $this->profileUrl = $profileUrl;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastLogin(): ?\DateTime
    {
        return $this->lastLogin;
    }

    /**
     * @param \DateTime|null $lastLogin
     * @return User
     */
    public function setLastLogin(?\DateTime $lastLogin): User
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): ?\DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     * @return User
     */
    public function setCreationDate(\DateTime $creationDate): User
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * @return Commission[]
     */
    public function getCommissions()
    {
        return $this->commissions;
    }

    /**
     * @param Commission[] $commissions
     * @return User
     */
    public function setCommissions(array $commissions): User
    {
        $this->commissions = $commissions;
        return $this;
    }

    /**
     * @Groups({"user"})
     */
    public function getCommissionsCount()
    {
        return \count($this->commissions);
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }
}
