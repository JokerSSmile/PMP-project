<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 */
class History
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
    protected $filmName;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="history")
     */
    private $partner;

    public function setFilmName($filmName)
    {
        $this->filmName = $nfilmNameame;
    }

    public function getFilmName()
    {
        return $this->filmName;
    }
}