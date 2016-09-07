<?php
/**
 * Created by PhpStorm.
 * User: nuntius
 * Date: 9/5/16
 * Time: 9:34 PM
 */
namespace AppBundle\Utils;

class player
{
    public $id;
    public $name;
    public $type;
    public $gesture;
    public $gestureName;
    public $gestureAction;
    public $gestureFA;
    public $award;

    public function __construct($id, $name, $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;

    }

}