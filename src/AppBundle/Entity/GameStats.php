<?php
/**
 * Created by PhpStorm.
 * User: nuntius
 * Date: 9/3/16
 * Time: 5:51 PM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="game_stats")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameStatsRepo")
 */

class GameStats
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string")
     */
    private $outcome;


    /**
     * @ORM\Column(type="string")
     */
    private $player;


    /**
     * @ORM\Column(type="string")
     */
    private $gesture;



    /**
     * ========================
     * Getters and Setters
     * ========================
     */



    /**
     * @return mixed
     */
    public function getOutcome()
    {
        return $this->outcome;
    }

    /**
     * @param mixed $outcome
     */
    public function setOutcome($outcome)
    {
        $this->outcome = $outcome;
    }

    /**
     * @return mixed
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param mixed $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }

    /**
     * @return mixed
     */
    public function getGesture()
    {
        return $this->gesture;
    }

    /**
     * @param mixed $gesture
     */
    public function setGesture($gesture)
    {
        $this->gesture = $gesture;
    }

    


}