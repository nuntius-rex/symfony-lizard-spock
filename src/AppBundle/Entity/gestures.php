<?php
/**
 * Created by PhpStorm.
 * User: nuntius
 * Date: 9/3/16
 * Time: 4:33 AM
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="gestures")
 */
class gestures
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
    private $font_awesome;

    /**
     * @ORM\Column(type="string")
     */
    private $action1;

    /**
     * @ORM\Column(type="string")
     */
    private $action2;


    /**
     * @ORM\Column(type="string")
     */
    private $list_order;




    /**
     * =======================================
     *   Getters and Setters
     *  =======================================
     */

    /**
     * @return mixed
     */
    public function getListOrder()
    {
        return $this->list_order;
    }

    /**
     * @param mixed $list_order
     */
    public function setListOrder($list_order)
    {
        $this->list_order = $list_order;
    }


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
    public function getFontAwesome()
    {
        return $this->font_awesome;
    }

    /**
     * @param mixed $font_awesome
     */
    public function setFontAwesome($font_awesome)
    {
        $this->font_awesome = $font_awesome;
    }

    /**
     * @return mixed
     */
    public function getAction1()
    {
        return $this->action1;
    }

    /**
     * @param mixed $action1
     */
    public function setAction1($action1)
    {
        $this->action1 = $action1;
    }

    /**
     * @return mixed
     */
    public function getAction2()
    {
        return $this->action2;
    }

    /**
     * @param mixed $action2
     */
    public function setAction2($action2)
    {
        $this->action2 = $action2;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    
    
    
}