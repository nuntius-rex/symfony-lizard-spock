<?php
/**
 * Created by PhpStorm.
 * User: nuntius
 * Date: 9/2/16
 * Time: 9:04 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="game_info")
 */
class GameInfo
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
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $code;

    /**
     * @ORM\Column(type="string")
     */
    private $game_explanation;

    /**
     * @ORM\Column(type="string")
     */
    private $challenge_msg;


    /** 
     * =======================================
     *   Getters and Setters
     *  =======================================
     */

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getGameExplanation()
    {
        return $this->game_explanation;
    }

    /**
     * @param mixed $game_explanation
     */
    public function setGameExplanation($game_explanation)
    {
        $this->game_explanation = $game_explanation;
    }

    /**
     * @return mixed
     */
    public function getChallengeMsg()
    {
        return $this->challenge_msg;
    }

    /**
     * @param mixed $challenge_msg
     */
    public function setChallengeMsg($challenge_msg)
    {
        $this->challenge_msg = $challenge_msg;
    }

    


}
