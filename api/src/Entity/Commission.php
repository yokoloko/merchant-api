<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Commission
 *
 * @ORM\Table(name="commission", indexes={@ORM\Index(name="idMerchant", columns={"idMerchant"}), @ORM\Index(name="idUser", columns={"idUser"})})
 * @ORM\Entity
 * @ApiResource
 */
class Commission
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="cashback", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $cashback;

    /**
     * @var Merchant
     *
     * @ORM\ManyToOne(targetEntity="Merchant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMerchant", referencedColumnName="id", nullable=false)
     * })
     */
    private $merchant;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id", nullable=false)
     * })
     */
    private $user;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Commission
     */
    public function setDate(\DateTime $date): Commission
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getCashback(): ?string
    {
        return $this->cashback;
    }

    /**
     * @param string $cashback
     * @return Commission
     */
    public function setCashback(string $cashback): Commission
    {
        $this->cashback = $cashback;
        return $this;
    }

    /**
     * @return Merchant|null
     */
    public function getMerchant(): ?Merchant
    {
        return $this->merchant;
    }

    /**
     * @param Merchant $merchant
     * @return Commission
     */
    public function setMerchant(Merchant $merchant): Commission
    {
        $this->merchant = $merchant;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Commission
     */
    public function setUser(User $user): Commission
    {
        $this->user = $user;
        return $this;
    }
}
