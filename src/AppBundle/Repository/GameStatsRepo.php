<?php
/**
 * Created by PhpStorm.
 * User: nuntius
 * Date: 9/6/16
 * Time: 2:50 PM
 */
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;


class GameStatsRepo extends EntityRepository
{
    /*
     * A main method to call everything needed for the stats display
     */
    public function getStats(){
        $stats=array();

        $stats["win"]=$this->getUserWins();
        $stats["lose"]=$this->getUserLosses();
        $stats["draw"]=$this->getUserDraws();
        $stats["user_gestures"]=$this->getPlayerGestures("Player");
        $stats["computer_gestures"]=$this->getPlayerGestures("Computer");

        return $stats;
    }

    /*
     * Gets the User win stats
     */
    public function getUserWins()
    {
        $dql="SELECT count(s.outcome) as win FROM AppBundle:GameStats s WHERE s.outcome = 'Win' AND s.player='Player'";
        return $this->runStatQuery($dql,1,"win");
    }

    /*
     * Gets the User loss stats
     */
    public function getUserLosses(){
        $dql="SELECT count(s.outcome) as lose FROM AppBundle:GameStats s WHERE s.outcome = 'Lose' AND s.player='Player'";
        return $this->runStatQuery($dql,1,"lose");
    }

    /*
     * Gets the User draw stats
     */
    public function getUserDraws(){
        $dql="SELECT count(s.outcome) as draw FROM AppBundle:GameStats s WHERE s.outcome = 'Draw' AND s.player='Player'";
        return $this->runStatQuery($dql,1,"draw");
    }

    /*
     * Gets the player gestures. Called for both the Player and the Computer
     */
    public function getPlayerGestures($player){
        $dql="SELECT count(s.gesture)as gesture_count, s.gesture FROM AppBundle:GameStats s "
        ."WHERE s.player='".$player."' GROUP BY s.gesture ORDER BY gesture_count DESC";
        return $this->runStatQuery($dql);
    }


    /*
     * runStatQuery:
     *
     * This is a method to run the stats queries without repeating the entity manager code
     * with different output per the data needs
     */
    private function runStatQuery($dql, $return_type="array", $name="")
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery($dql);
        if($return_type==1){
            $result=$query->getResult();
            return $result[0][$name];
        }elseif($return_type=="array"){
            return $query->getArrayResult();
        }


    }
}