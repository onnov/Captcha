<?php
/**
 * Created by PhpStorm.
 * Project: captcha
 * User: sv
 * Date: 15.09.2019
 * Time: 13:10
 */

namespace Onnov\Captcha\Model;

/**
 * Class MinMaxRangeModel
 *
 * @package Onnov\Captcha\Model
 */
class MinMaxRangeModel
{
    /** @var int */
    protected $min;

    /** @var int */
    protected $max;

    /**
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param $min
     *
     * @return $this
     */
    public function setMin($min)
    {
        $this->min = $min;

        return $this;
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param $max
     *
     * @return $this
     */
    public function setMax($max)
    {
        $this->max = $max;

        return $this;
    }
}
