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


}
