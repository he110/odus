<?php

namespace App\Entity;

use App\Reference\ChatUserReference;
use App\Repository\ChatUserRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChatUserRepository::class)
 */
class ChatUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private int $channelType = ChatUserReference::CHANNEL_TYPE_UNKNOWN;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $uid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="datetime", name="date_created")
     */
    private DateTimeInterface $dateCreated;

    public function __construct()
    {
        $this->dateCreated = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChannelType(): ?int
    {
        return $this->channelType;
    }

    public function setChannelType(int $channelType): self
    {
        $this->channelType = $channelType;

        return $this;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDateCreated(): ?DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }
}
