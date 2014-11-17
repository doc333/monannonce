<?php

namespace Bo\AnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnnoncePhoto
 *
 * @ORM\Table(name="annonce_photo", indexes={@ORM\Index(name="fk_annonce_photo_annonce1_idx", columns={"annonce_id"})})
 * @ORM\Entity
 */
class AnnoncePhoto
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
     * @ORM\Column(name="file_photo", type="string", length=255, nullable=true)
     */
    private $filePhoto;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_principal", type="boolean", nullable=true)
     */
    private $isPrincipal;

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
     * Set filePhoto
     *
     * @param string $filePhoto
     * @return AnnoncePhoto
     */
    public function setFilePhoto($filePhoto)
    {
        $this->filePhoto = $filePhoto;

        return $this;
    }

    /**
     * Get filePhoto
     *
     * @return string 
     */
    public function getFilePhoto()
    {
        return $this->filePhoto;
    }

    /**
     * Set isPrincipal
     *
     * @param boolean $isPrincipal
     * @return AnnoncePhoto
     */
    public function setIsPrincipal($isPrincipal)
    {
        $this->isPrincipal = $isPrincipal;

        return $this;
    }

    /**
     * Get isPrincipal
     *
     * @return boolean 
     */
    public function getIsPrincipal()
    {
        return $this->isPrincipal;
    }

    /**
     * Set annonce
     *
     * @param \Bo\AnnonceBundle\Entity\Annonce $annonce
     * @return AnnoncePhoto
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
