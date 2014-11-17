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


}
