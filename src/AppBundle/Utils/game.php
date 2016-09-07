<?php
/**
 * Created by PhpStorm.
 * User: nuntius
 * Date: 9/5/16
 * Time: 9:48 PM
 */
namespace AppBundle\Utils;


class game
{

    public $player1;
    public $player2;
    public $outcome;
    public function __construct(player $player1, player $player2){

        $this->player1=$player1;
        $this->player2=$player2;
    }

    /*
    The hand is played by retrieving the user's selection 
    and generating the computer's selection
    */
    public function playHand(){

        if($this->player1->type=="Computer"){
            $gesture = $this->getComputerGesture();
        }else{
            $gesture = $this->getHumanGesture();
        }

        $this->player1->gesture=$gesture;
        $this->player1->gestureName=$this->getGesture($gesture, "name");

        
        if($this->player2->type=="Computer"){
            $gesture = $this->getComputerGesture();
        }else{
            $gesture = $this->getHumanGesture();
        }

        $this->player2->gesture=$gesture;
        $this->player2->gestureName=$this->getGesture($gesture, "name");
    }

    /*
    ================================================================================
    Scoring Explained: Scoring mathematically by the Star Matrix.

    Note: The following is the math algorythm utilized, where $p1g and $pg2
    represent the user's gesture number in an array of 5.

    $position=(5+($p1g-$p2g))%5;

    1. Working from the inside in PEMDAS order, the code above first
    subtracts the User's hand gesture from the Computer's hand gesture.
    2. Then the number 5 is added to the difference (this assures the modulus
    calculation in the next step will aways be at least 5 (returning zero).
    3. Next, modulus is used against the result to find the remainder of 5
    divided by the result. The remainder is the position.
    4. The winner can be determined based off of the position of the second hand
    gesture in relation to the first hand gesture. Since the game is a star matrix,
    The User will always lose on odd and win on even and visa versa for the Computer.
    ================================================================================
    */

    public function scoreHand(){

        $p1g=$this->player1->gesture;
        $p2g=$this->player2->gesture;

        //echo "<p>Player 1 gesture: ".$p1g."</p>\n";
        //echo "<p>Player 2 gesture: ".$p2g."</p>\n";

        //Primary scoring algorythm
        $position=(5+($p1g-$p2g))%5;

        //==================
        //Award the players
        //==================
        switch ($position){
            case 0:
                $this->player1->award="Draw";
                $this->player2->award="Draw";
                break;
            case 1:
                //Player 2 (Computer) wins
                $this->player1->award="Lose";
                $this->player2->award="Win";
                break;
            case 2:
                //Player 1 (Human) Wins
                $this->player1->award="Win";
                $this->player2->award="Lose";
                break;
            case 3:
                //Player 2 (Computer) wins
                $this->player1->award="Lose";
                $this->player2->award="Win";
                break;
            case 4:
                //Player 1 (Human) Wins
                $this->player1->award="Win";
                $this->player2->award="Lose";
                break;
        }
        
        //Get the offset position in the star matrix and populate the player actions and font icon.
        $offset=$this->getActionOffset($p1g,$p2g);
        $this->player1->gestureAction=$this->getGesture($p1g, "action".$offset);
        $this->player1->gestureFA=$this->getGesture($p1g, "font_awesome");
        $this->player2->gestureAction=$this->getGesture($p2g, "action".$offset);
        $this->player2->gestureFA=$this->getGesture($p2g, "font_awesome");

    }

    public function getHumanGesture(){

        if(isset($_GET["id"])){
            return (int) $_GET["id"];
        }else{
            return "<p>Id not set.</p>";
        }
    }

    public function getComputerGesture(){
        return mt_rand(1, 5);
    }

    public function score($p1Gesture, $p2Gesture){

        return (5+($p1Gesture-$p2Gesture))%5;

    }

    /*
    ================================================================================
    The Action offset is based on the position relative to the gesture in the star
    pattern matrix. Outcomes will be as follows:
    1 and 4 positions will use the first gesture action
    2 and 3 positions use the second gesture action
    ================================================================================
    */

    public function getActionOffset($p1Gesture, $p2Gesture){

        $p1step = -($p1Gesture-$p2Gesture);
        $p2step = -($p2Gesture-$p1Gesture);
        $action="";

        if(
            $p1step==1 ||
            $p1step==4 ||
            $p2step==1 ||
            $p2step==4

        ){
            $action=1;
        }elseif(
            $p1step==2 ||
            $p1step==3 ||
            $p2step==2 ||
            $p2step==3
        ){
            $action=2;
        }

        return $action;

    }

    /*
     * Note: Gestures here are stored in an array with 1 as the starting index with 
     * content. To match the numeric id of the gestures in database.
     * A next move might be to pull these directly from database instead.
     */
    
    public function getGesture($num, $type){

        
        $gesturesArray[0] = array();

        $gesturesArray[1]=array(
                'name'=>"Scissors",
                'font_awesome'=>"fa fa-hand-scissors-o fa-5x",
                'action1'=>"cuts",
                'action2'=>"decapitates"
            );


        $gesturesArray[2]=array(
                'name'=>"Paper",
                'font_awesome'=>"fa fa-hand-paper-o fa-5x",
                'action1'=>"covers",
                'action2'=>"disproves"
            );

        $gesturesArray[3]=array(
                'name'=>"Rock",
                'font_awesome'=>"fa fa-hand-rock-o fa-5x",
                'action1'=>"crushes",
                'action2'=>"crushes"
            );

        $gesturesArray[4]=array(
                'name'=>"Lizard",
                'font_awesome'=>"fa fa-hand-lizard-o fa-5x",
                'action1'=>"poisons",
                'action2'=>"eats"
            );

        $gesturesArray[5]=array(
                'name'=>"Spock",
                'font_awesome'=>"fa fa-hand-spock-o fa-5x",
                'action1'=>"smashes",
                'action2'=>"vaporizes"
            );




        return $gesturesArray[$num][$type];

    }

    /*
     * Generate an outcome array to pass to be passed to the front-end
     * by the controller
     */
    public function outcome(){

        if($this->player1->award=="Win"){
            $outcome[]=array(
                "p1Gesture"=>$this->player1->gestureName,
                "p1GestureFA"=>$this->player1->gestureFA,
                "winnerGesture"=>$this->player1->gestureName,
                "action"=>$this->player1->gestureAction,
                "loserGesture"=>$this->player2->gestureName,
                "p2Gesture"=>$this->player2->gestureName,
                "p2GestureFA"=>$this->player2->gestureFA,
                "outcomeText"=>"Player 1 Wins!"
            );
        }elseif($this->player2->award=="Win"){
            $outcome[]=array(
                "p1Gesture"=>$this->player1->gestureName,
                "p1GestureFA"=>$this->player1->gestureFA,
                "winnerGesture"=>$this->player2->gestureName,
                "action"=>$this->player2->gestureAction,
                "loserGesture"=>$this->player1->gestureName,
                "p2Gesture"=>$this->player2->gestureName,
                "p2GestureFA"=>$this->player2->gestureFA,
                "outcomeText"=>"Player 2 Wins!"
            );
        }else{
            $outcome[]=array(
                "p1Gesture"=>$this->player1->gestureName,
                "p1GestureFA"=>$this->player1->gestureFA,
                "winnerGesture"=>"",
                "action"=>"",
                "loserGesture"=>"",
                "p2Gesture"=>$this->player2->gestureName,
                "p2GestureFA"=>$this->player2->gestureFA,
                "outcomeText"=>"Draw!"
            );
        }

        return $outcome;
    }

    /*
     * Generate a log array of this hand for the database
     */
    public function log(){

        $log[]=array(
            "player"=>$this->player1->type,
            "outcome"=>$this->player1->award,
            "gesture"=>$this->player1->gestureName
        );
        $log[]=array(
            "player"=>$this->player2->type,
            "outcome"=>$this->player2->award,
            "gesture"=>$this->player2->gestureName
        );

        return $log;

    }

    /*
     * This method is for debugging
     */

    public function playerStatus($player, $display){

        if($display=="dump"){
            echo "<pre>";
            echo var_dump(get_object_vars($this->$player));
            echo "</pre>";
        }elseif($display=="print"){
            echo "<pre>";
            echo print_r(get_object_vars($this->$player));
            echo "</pre>";
        }elseif($display=="json"){
            return json_encode($this->$player);
        }

    }

}
