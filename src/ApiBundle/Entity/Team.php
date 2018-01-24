<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\TeamRepository")
 */
class Team
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="coach", type="string", length=255)
     */
    private $coach;

    /**
     * @var string
     *
     * @ORM\Column(name="president", type="string", length=255)
     */
    private $president;
    
   /**
	* @ORM\OneToMany(targetEntity="ApiBundle\Entity\Player",mappedBy="team")
	* @ORM\JoinColumn(nullable=false)
	*/
	private $players;


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
     * @return Team
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
     * Set city
     *
     * @param string $city
     *
     * @return Team
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Team
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
     * Set coach
     *
     * @param string $coach
     *
     * @return Team
     */
    public function setCoach($coach)
    {
        $this->coach = $coach;

        return $this;
    }

    /**
     * Get coach
     *
     * @return string
     */
    public function getCoach()
    {
        return $this->coach;
    }

    /**
     * Set president
     *
     * @param string $president
     *
     * @return Team
     */
    public function setPresident($president)
    {
        $this->president = $president;

        return $this;
    }

    /**
     * Get president
     *
     * @return string
     */
    public function getPresident()
    {
        return $this->president;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->competitions = new \Doctrine\Common\Collections\ArrayCollection();
    }

   

    /**
     * Add player
     *
     * @param \ApiBundle\Entity\Player $player
     *
     * @return Team
     */
    public function addPlayer(\ApiBundle\Entity\Player $player)
    {
        $this->players[] = $player;

        return $this;
    }

    /**
     * Remove player
     *
     * @param \ApiBundle\Entity\Player $player
     */
    public function removePlayer(\ApiBundle\Entity\Player $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }
}
