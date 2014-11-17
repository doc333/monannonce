<?php

namespace Bo\AnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnnonceUser
 *
 * @ORM\Table(name="annonce_user", indexes={@ORM\Index(name="fk_annonce_has_user_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_annonce_has_user_annonce1_idx", columns={"annonce_id"})})
 * @ORM\Entity
 */
class AnnonceUser
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
     * @var integer
     *
     * @ORM\Column(name="nbr_personne", type="integer", nullable=true)
     */
    private $nbrPersonne;

    /**
     * @var integer
     *
     * @ORM\Column(name="note", type="integer", nullable=true)
     */
    private $note;

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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


}
