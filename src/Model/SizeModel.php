<?php
/**
 * Created by PhpStorm.
 * Project: captcha
 * User: sv
 * Date: 15.09.2019
 * Time: 13:25
 */

namespace Onnov\Captcha\Model;

/**
 * Class SizeModel
 *
 * @package Onnov\Captcha\Model
 */
class SizeModel
{
    /** @var int */
    protected $width;

    /** @var int */
    protected $height;

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param $width
     *
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param $height
     *
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }
}
