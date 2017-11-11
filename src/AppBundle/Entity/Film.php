<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 */
class Film
{
    /**
     * @ORM\Id;
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=40)
     */
    protected $description;

    /**
     * @ORM\Column(type="integer")
     */
    protected $rating;

    /**
     * @ORM\Column(type="date")
     */
    protected $releaseDate;

    /**
     * @ORM\Column(type="time")
     */
    protected $runningTime;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $imgUrl;

    /**
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="films")
     */
    protected $genres;  

    /**
     * @ORM\ManyToOne(targetEntity="Director", inversedBy="films")
     */
    protected $director;

    /**
     * @ORM\ManyToMany(targetEntity="Actor", inversedBy="films")
     */
    protected $actors;

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->name = $description;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }
}