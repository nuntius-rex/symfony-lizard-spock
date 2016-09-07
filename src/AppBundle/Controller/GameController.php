<?php

namespace AppBundle\Controller;

use AppBundle\Entity\gestures;
use AppBundle\Entity\GameInfo;
use AppBundle\Entity\GameStats;
use AppBundle\Utils\game;
use AppBundle\Utils\player;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class GameController extends Controller
{

    /**
    * @Route("/ajax", name="_ajax")
    */
    public function ajaxAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $Player1 = new player(0, "Player 1", "Player");
            $Player2 = new player(1, "Player 2", "Computer");

            $Game = new game($Player1, $Player2);
            $Game->playHand();
            $Game->scoreHand();
            $output=$Game->outcome();
            $log=$Game->log();


            $GameStats=new GameStats();

            for($i=0; $i<count($log); $i++) {
                $GameStats->setPlayer($log[$i]["player"]);
                $GameStats->setOutcome($log[$i]["outcome"]);
                $GameStats->setGesture($log[$i]["gesture"]);
                $em = $this->getDoctrine()->getManager();
                $em->persist($GameStats);
                $em->flush();
                $em->clear();

            }

            $em = $this->getDoctrine()->getManager();
            $stats=$em->getRepository('AppBundle:GameStats')
                ->getStats();

            $output[]=$stats;

            return new JsonResponse(json_encode($output));
        }else{
            return new Response('Invalid Request!', 400);
        }


    }

    /**
     * @Route("/new")
     */
    public function newAction()
    {

        /*  Inserting: Used my original test array to insert into the gestures table:*/
        $gesturesArray = array(

            array(
                'name'=>"Scissors",
                'font_awesome'=>"fa fa-hand-scissors-o fa-5x",
                'action1'=>"cuts",
                'action2'=>"decapitates"
            ),
            array(
                'name'=>"Paper",
                'font_awesome'=>"fa fa-hand-paper-o fa-5x",
                'action1'=>"covers",
                'action2'=>"disproves"
            ),
            array(
                'name'=>"Rock",
                'font_awesome'=>"fa fa-hand-rock-o fa-5x",
                'action1'=>"crushes",
                'action2'=>"crushes"
            ),
            array(
                'name'=>"Lizard",
                'font_awesome'=>"fa fa-hand-lizard-o fa-5x",
                'action1'=>"poisons",
                'action2'=>"eats"
            ),
            array(
                'name'=>"Spock",
                'font_awesome'=>"fa fa-hand-spock-o fa-5x",
                'action1'=>"smashes",
                'action2'=>"vaporizes"
            ),

        );

        $gestures = new gestures();

        for($i=0; $i<count($gesturesArray); $i++){
            //echo $gesturesArray[$i]["name"]."<br>";
            $gestures->setName($gesturesArray[$i]["name"]);
            $gestures->setFontAwesome($gesturesArray[$i]["font_awesome"]);
            $gestures->setAction1($gesturesArray[$i]["action1"]);
            $gestures->setAction2($gesturesArray[$i]["action2"]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($gestures);
            $em->flush();
            $em->clear();
        }
        //return new Response("Data action done!");




        /* Inserting: Used my original test array to insert into the GameInfo table*/
        $gameInfo = array(
            'name' => 'Rock-Paper-Scissors-Lizard-Spock Code Demo',
            'code' => 'Symfony Framework - PHP',
            'game_explanation' => "Explanation: This is a Symfony Framework (PHP) version of the game of Rock-Paper-Scissors-Lizard-Spock
                invented by Sam Kass and Karen Bryla, and made popular by the Big Bang Theory. ",
            'challenge_msg'=>'Click Your Gesture to Challenge the Machine!'
        );

        $game = new GameInfo();
        $game->setName($gameInfo["name"]);
        $game->setCode($gameInfo["code"]);
        $game->setGameExplanation($gameInfo["game_explanation"]);
        $game->setChallengeMsg($gameInfo["challenge_msg"]);
        $em = $this->getDoctrine()->getManager();
        $em->persist($game);
        $em->flush();

        return new Response("Data action done!");


        //return new Response("This feature is currently disabled.");
    }

    /**
     * @Route("/")
     */
    public function indexAction()
    {
        /* ===== Load Game Landing Page Data ===== */

        $em = $this->getDoctrine()->getManager();
        
        $gameInfo = $em->getRepository('AppBundle:GameInfo')
        ->find(1);
         //dump($gameInfoData);die;

        $gestures = $em->getRepository('AppBundle:gestures')
            ->findBy(
                array(),
                array('list_order'=>'ASC')
            );
        //dump($gestures);die;

        //$stats="";
        $stats = $em->getRepository('AppBundle:GameStats')
        ->getStats();
        //dump($stats);die;
        

        return $this->render('default/game.html.twig',
            array(
                'gameInfo' =>$gameInfo,
                'gestures' =>$gestures,
                'stats'=>$stats
            ));

    }
}
