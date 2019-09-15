<?php
/**
 * Created by PhpStorm.
 * Project: captcha
 * User: sv
 * Date: 15.09.2019
 * Time: 13:35
 */

namespace Onnov\Captcha\Model;

/**
 * Class RgbColorModel
 *
 * @package Onnov\Captcha\Model
 */
class RgbColorModel
{
    /** @var int */
    protected $red;

    /** @var int */
    protected $green;

    /** @var int */
    protected $blue;

    /**
     * @return int
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * @param $red
     *
     * @return $this
     */
    public function setRed($red)
    {
        $this->red = $red;

        return $this;
    }

    /**
     * @return int
     */
    public function getGreen()
    {
        return $this->green;
    }

    /**
     * @param $green
     *
     * @return $this
     */
    public function setGreen($green)
    {
        $this->green = $green;

        return $this;
    }

    /**
     * @return int
     */
    public function getBlue()
    {
        return $this->blue;
    }

    /**
     * @param $blue
     *
     * @return $this
     */
    public function setBlue($blue)
    {
        $this->blue = $blue;

        return $this;
    }
}
