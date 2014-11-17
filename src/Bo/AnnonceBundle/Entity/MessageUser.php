<?php

namespace Bo\AnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MessageUser
 *
 * @ORM\Table(name="message_user", indexes={@ORM\Index(name="fk_discussion_user_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_discussion_user_user2_idx", columns={"user_destinataire_id"})})
 * @ORM\Entity
 */
class MessageUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_destinataire_id", referencedColumnName="id")
     * })
     */
    private $userDestinataire;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return MessageUser
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return MessageUser
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return MessageUser
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set user
     *
     * @param \Bo\AnnonceBundle\Entity\User $user
     * @return MessageUser
     */
    public function setUser(\Bo\AnnonceBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Bo\AnnonceBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set userDestinataire
     *
     * @param \Bo\AnnonceBundle\Entity\User $userDestinataire
     * @return MessageUser
     */
    public function setUserDestinataire(\Bo\AnnonceBundle\Entity\User $userDestinataire = null)
    {
        $this->userDestinataire = $userDestinataire;

        return $this;
    }

    /**
     * Get userDestinataire
     *
     * @return \Bo\AnnonceBundle\Entity\User 
     */
    public function getUserDestinataire()
    {
        return $this->userDestinataire;
    }
}
