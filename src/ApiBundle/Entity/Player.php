<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table(name="player")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\PlayerRepository")
 */
class Player
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255,nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255,nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255,nullable=false)
     */
    private $country;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer",nullable=false)
     */
    private $age;

	/**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=255,nullable=false)
     */
    private $position;
    
    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer",nullable=false)
     */
    private $height;
    

    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="integer",nullable=false)
     */
    private $weight;

    /**
     * @var bool
     *
     * @ORM\Column(name="rightFoot", type="boolean",nullable=false)
     */
    private $rightFoot;


	/**
	* @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Team",inversedBy="players")
	* @ORM\JoinColumn(nullable=true)
	*/
	private $team;
	
	/**
	* @ORM\OneToMany(targetEntity="ApiBundle\Entity\PlayerCompetition",mappedBy="player")
		* @ORM\JoinColumn(nullable=true)

	*/
	private $competitions;

	
	
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Player
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Player
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Player
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set height
     *
     * @param integer $height
     *
     * @return Player
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return Player
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }


    /**
     * Set rightFoot
     *
     * @param boolean $rightFoot
     *
     * @return Player
     */
    public function setRightFoot($rightFoot)
    {
        $this->rightFoot = $rightFoot;

        return $this;
    }

    /**
     * Get rightFoot
     *
     * @return bool
     */
    public function getRightFoot()
    {
        return $this->rightFoot;
    }

    /**
     * Set team
     *
     * @param \ApiBundle\Entity\Team $team
     *
     * @return Player
     */
    public function setTeam(\ApiBundle\Entity\Team $team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \ApiBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->competitions = new \Doctrine\Common\Collections\ArrayCollection();
    }

   

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Player
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return Player
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Add competition
     *
     * @param \ApiBundle\Entity\PlayerCompetition $competition
     *
     * @return Player
     */
    public function addCompetition(\ApiBundle\Entity\PlayerCompetition $competition)
    {
        $this->competitions[] = $competition;

        return $this;
    }

    /**
     * Remove competition
     *
     * @param \ApiBundle\Entity\PlayerCompetition $competition
     */
    public function removeCompetition(\ApiBundle\Entity\PlayerCompetition $competition)
    {
        $this->competitions->removeElement($competition);
    }

    /**
     * Get competitions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }
}
