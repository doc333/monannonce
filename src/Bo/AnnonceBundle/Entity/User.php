<?php

namespace Bo\AnnonceBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Serializable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @Entity(repositoryClass="UserRepository")
 * 
 * @UniqueEntity(fields={"username"},message="Username déjà utilisé !")
 * @UniqueEntity(fields={"email"},message="Email déjà utilisé !")
 * 
 */
class User implements UserInterface, Serializable, AdvancedUserInterface
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
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     * 
     *  @Assert\Length(
     *      min = "6",
     *      minMessage = "Votre Username doit faire au moins {{ limit }} caractères"
     * )
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     * 
     *  @Assert\Length(
     *      min = "6",
     *      minMessage = "Votre Password doit faire au moins {{ limit }} caractères"
     * )
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * 
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=255, nullable=true)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_newsletter", type="boolean", nullable=true)
     */
    private $isNewsletter = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_desactiver", type="boolean", nullable=false)
     */
    private $isDesactiver = '0';

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $date_created;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $date_updated;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Departement", mappedBy="user")
     */
    private $departement;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="user")
     * @ORM\JoinTable(name="user_role",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *   }
     * )
     * 
     * * @Assert\Count(
     *      min = "1",
     *      minMessage = "Merci de choisir au moins un type de compte!"
     * )
     * 
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity="Annonce", mappedBy="user")
     */
    protected $annonces;    

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->departement = new ArrayCollection();
        $this->role = new ArrayCollection();
        $this->salt = md5(uniqid(rand(),true));
        $this->date_created = new \DateTime('now');
        $this->date_updated = new \DateTime('now');
    }

    /**
     * Add annonces
     *
     * @param Annonce $annonces
     * @return Annonce
     */
    public function addAnnonce(Annonce $annonces)
    {
        $this->annonces[] = $annonces;

        return $this;
    }

    /**
     * Remove annonces
     *
     * @param Annonce $annonces
     */
    public function removeAnnonce(Annonce $annonces)
    {
        $this->produits->removeElement($annonces);
    }

    /**
     * Get annonces
     *
     * @return Collection 
     */
    public function getAnnonces()
    {
        return $this->annonces;
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return User
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
     * Set ville
     *
     * @param string $ville
     * @return User
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
     * Set isNewsletter
     *
     * @param boolean $isNewsletter
     * @return User
     */
    public function setIsNewsletter($isNewsletter)
    {
        $this->isNewsletter = $isNewsletter;

        return $this;
    }

    /**
     * Get isNewsletter
     *
     * @return boolean 
     */
    public function getIsNewsletter()
    {
        return $this->isNewsletter == 1;
    }

    /**
     * Set isDesactiver
     *
     * @param boolean $isDesactiver
     * @return User
     */
    public function setIsDesactiver($isDesactiver)
    {
        $this->isDesactiver = $isDesactiver;

        return $this;
    }

    /**
     * Get isDesactiver
     *
     * @return boolean 
     */
    public function getIsDesactiver()
    {
        return $this->isDesactiver;
    }

    /**
     * Set date_created
     *
     * @param DateTime $date_created
     * @return User
     */
    public function setCreated($date_created)
    {
        $this->date_created = $date_created;

        return $this;
    }

    /**
     * Get date_created
     *
     * @return DateTime 
     */
    public function getCreated()
    {
        return $this->date_created;
    }

    /**
     * Set update
     *
     * @param DateTime $date_updated
     * @return User
     */
    public function setUpdate($date_updated)
    {
        $this->date_updated = $date_updated;

        return $this;
    }

    /**
     * Get update
     *
     * @return DateTime 
     */
    public function getUpdate()
    {
        return $this->date_updated;
    }

    /**
     * Add departement
     *
     * @param Departement $departement
     * @return User
     */
    public function addDepartement(Departement $departement)
    {
        $this->departement[] = $departement;

        return $this;
    }

    /**
     * Remove departement
     *
     * @param Departement $departement
     */
    public function removeDepartement(Departement $departement)
    {
        $this->departement->removeElement($departement);
    }

    /**
     * Get departement
     *
     * @return Collection 
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Add role
     *
     * @param Role $role
     * @return User
     */
    public function addRole(Role $role)
    {
        $this->role[] = $role;

        return $this;
    }
    
    /**
     * Remove role
     *
     * @param Role $role
     */
    public function removeRole(Role $role)
    {
        $this->role->removeElement($role);
    }

    /**
     * Get role
     *
     * @return Collection 
     */
    public function getRole()
    {
    	return $this->role;
    }

    public function eraseCredentials() {}

    public function getRoles() 
    {
        return $this->getRole()->toArray();
        
    }
    
    /**
     * @see Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }
    
    public function __toString() 
    { 
        return $this->getUsername(); 
    }
    /**
     * @see Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
    }
    
    public function isEqualTo(UserInterface $user)
    {
        return $this->username === $user->getUsername();
    }
    
    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return !$this->isDesactiver;
    }
    
    public function encodePass(MessageDigestPasswordEncoder $encoder)
    {
        $password = $encoder->encodePassword($this->getPassword(), $this->getSalt());
        $this->setPassword($password);
    }
}
