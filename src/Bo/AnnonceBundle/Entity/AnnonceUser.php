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
     * Set nbrPersonne
     *
     * @param integer $nbrPersonne
     * @return AnnonceUser
     */
    public function setNbrPersonne($nbrPersonne)
    {
        $this->nbrPersonne = $nbrPersonne;

        return $this;
    }

    /**
     * Get nbrPersonne
     *
     * @return integer 
     */
    public function getNbrPersonne()
    {
        return $this->nbrPersonne;
    }

    /**
     * Set note
     *
     * @param integer $note
     * @return AnnonceUser
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set annonce
     *
     * @param \Bo\AnnonceBundle\Entity\Annonce $annonce
     * @return AnnonceUser
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

    /**
     * Set user
     *
     * @param \Bo\AnnonceBundle\Entity\User $user
     * @return AnnonceUser
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
}
