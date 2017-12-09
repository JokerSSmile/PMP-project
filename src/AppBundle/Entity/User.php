<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="This email address is already in use")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id;
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=40)
     */
    protected $nickname;

    /**
     * @ORM\Column(type="string", length=40)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=40)
     */
    protected $surname;

    /**
     * @ORM\Column(type="integer")
     */
    protected $age;

    /**
     * @ORM\ManyToOne(targetEntity="Gender", inversedBy="users")
     */
    protected $gender;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=256, nullable=true)
     */
    protected $userImageUrl;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $role;

    /**
     * @Assert\Length(max=4096)
     */
    protected $plainPassword;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $password;

    /**
     * @ORM\OneToMany(targetEntity="UserReview", mappedBy="user")
     */
    private $reviews;

    /**
     * @ORM\ManyToMany(targetEntity="Film", mappedBy="users")
     */
    private $films;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="iWantToGoWith")
     */
    private $wantsToGoWithMe;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="wantsToGoWithMe")
     */
    private $iWantToGoWith;

    /**
     * @ORM\OneToMany(targetEntity="History", mappedBy="partner")
     */
    private $history;

    public function eraseCredentials()
    {
        return null;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role = null)
    {
        $this->role = $role;
    }

    public function getRoles()
    {
        return [$this->getRole()];
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getName()
    {
        return $this->getNickname();
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function getSalt()
    {
        return null;
    }

    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }

    public function getReviews()
    {
        return $this->reviews;
    }

    public function setFilms($films)
    {
        $this->films = $films;
    }

    public function getFilms()
    {
        return $this->films;
    }

    public function addFilm($film)
    {
        $this->films[] = $film;
    }

    public function removeFilm($film)
    {
        $this->films->removeElement($film);
    } 

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setUserImageUrl($userImageUrl)
    {
        $this->userImageUrl = $userImageUrl;
    }

    public function getUserImageUrl()
    {
        return $this->userImageUrl;
    }

    public function getWantsToGoWithMe()
    {
        return $this->wantsToGoWithMe;
    }

    public function getIWantToGoWith()
    {
        return $this->iWantToGoWith;
    }

    public function addWantsToGoWithMe($user)
    {
        $this->wantsToGoWithMe[] = $user;
    }

    public function addIWantToGoWith($user)
    {
        $this->iWantToGoWith[] = $user;
    }
}