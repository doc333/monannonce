<?php

namespace Bo\AnnonceBundle\Entity;

use Bo\AnnonceBundle\Entity\Annonce;
use Bo\AnnonceBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Bo\AnnonceBundle\Entity\AnnonceType;


/**
 * Annonce
 *
 * @ORM\Table(name="annonce", indexes={@ORM\Index(name="fk_annonce_user_idx", columns={"user_id"}), @ORM\Index(name="fk_annonce_annonce_type1_idx", columns={"annonce_type_id"})})
 * @Entity
 */
class Annonce
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
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_place", type="integer", nullable=true)
     */
    private $nbrPlace;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_refuser", type="boolean", nullable=false)
     */
    private $isRefuser = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=255, nullable=true)
     */
    private $cp;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_debut", type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_fin", type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \AnnonceType
     *
     * @ORM\ManyToOne(targetEntity="AnnonceType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="annonce_type_id", referencedColumnName="id")
     * })
     */
    private $annonceType;

    public function __contruct() 
    {
        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');
    }

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
     * Set titre
     *
     * @param string $titre
     * @return Annonce
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Annonce
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set nbrPlace
     *
     * @param integer $nbrPlace
     * @return Annonce
     */
    public function setNbrPlace($nbrPlace)
    {
        $this->nbrPlace = $nbrPlace;

        return $this;
    }

    /**
     * Get nbrPlace
     *
     * @return integer 
     */
    public function getNbrPlace()
    {
        return $this->nbrPlace;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Annonce
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isRefuser
     *
     * @param boolean $isRefuser
     * @return Annonce
     */
    public function setIsRefuser($isRefuser)
    {
        $this->isRefuser = $isRefuser;

        return $this;
    }

    /**
     * Get isRefuser
     *
     * @return boolean 
     */
    public function getIsRefuser()
    {
        return $this->isRefuser;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Annonce
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Annonce
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return Annonce
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set dateDebut
     *
     * @param DateTime $dateDebut
     * @return Annonce
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = new \DateTime($dateDebut);

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param DateTime $dateFin
     * @return Annonce
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = new \DateTime($dateFin);

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set updated
     *
     * @param DateTime $updated
     * @return Annonce
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set created
     *
     * @param DateTime $created
     * @return Annonce
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return Annonce
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set annonceType
     *
     * @param \Bo\AnnonceBundle\Entity\AnnonceType $annonceType
     * @return Annonce
     */
    public function setAnnonceType(\Bo\AnnonceBundle\Entity\AnnonceType $annonceType = null)
    {
        $this->annonceType = $annonceType;

        return $this;
    }

    /**
     * Get annonceType
     *
     * @return \Bo\AnnonceBundle\Entity\AnnonceType 
     */
    public function getAnnonceType()
    {
        return $this->annonceType;
    }
}
