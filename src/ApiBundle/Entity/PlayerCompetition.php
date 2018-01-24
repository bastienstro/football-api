<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerCompetition
 *
 * @ORM\Entity
 */
class PlayerCompetition
{
    
    
    /**
	* @ORM\Id
	* @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Player",inversedBy="competitions")
	*/
	private $player;
    
    /**
	* @ORM\Id
	* @ORM\ManyToOne(targetEntity="ApiBundle\Entity\Competition",inversedBy="players")
	*/
	private $competition;
    
    /**
     * @var int
     *
     * @ORM\Column(name="goals", type="integer")
     */
    private $goals;
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="assists", type="integer")
     */
    private $assists;
    
    
       
    

   

    /**
     * Set goals
     *
     * @param integer $goals
     *
     * @return PlayerCompetition
     */
    public function setGoals($goals)
    {
        $this->goals = $goals;

        return $this;
    }

    /**
     * Get goals
     *
     * @return integer
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * Set assists
     *
     * @param integer $assists
     *
     * @return PlayerCompetition
     */
    public function setAssists($assists)
    {
        $this->assists = $assists;

        return $this;
    }

    /**
     * Get assists
     *
     * @return integer
     */
    public function getAssists()
    {
        return $this->assists;
    }

    /**
     * Set player
     *
     * @param \ApiBundle\Entity\Player $player
     *
     * @return PlayerCompetition
     */
    public function setPlayer(\ApiBundle\Entity\Player $player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \ApiBundle\Entity\Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set competition
     *
     * @param \ApiBundle\Entity\Competition $competition
     *
     * @return PlayerCompetition
     */
    public function setCompetition(\ApiBundle\Entity\Competition $competition)
    {
        $this->competition = $competition;

        return $this;
    }

    /**
     * Get competition
     *
     * @return \ApiBundle\Entity\Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }
}
