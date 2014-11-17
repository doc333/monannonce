<?php

namespace Bo\AnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MessageAnnonce
 *
 * @ORM\Table(name="message_annonce", indexes={@ORM\Index(name="fk_discussion_message_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_discussion_message_annonce1_idx", columns={"annonce_id"})})
 * @ORM\Entity
 */
class MessageAnnonce
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
     * @ORM\Column(name="message", type="string", length=255, nullable=true)
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
     * @var \Annonce
     *
     * @ORM\ManyToOne(targetEntity="Annonce")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="annonce_id", referencedColumnName="id")
     * })
     */
    private $annonce;



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
     * @return MessageAnnonce
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
     * @return MessageAnnonce
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
     * @return MessageAnnonce
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
     * @return MessageAnnonce
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
     * Set annonce
     *
     * @param \Bo\AnnonceBundle\Entity\Annonce $annonce
     * @return MessageAnnonce
     */
    public function setAnnonce(\Bo\AnnonceBundle\Entity\Annonce $annonce = null)
    {
        $this->annonce = $annonce;

        return $this;
    }

    /**
     * Get annonce
     *
     * @return \Bo\AnnonceBundle\Entity\Annonce 
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }
}
