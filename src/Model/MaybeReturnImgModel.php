<?php
/**
 * Created by PhpStorm.
 * Project: captcha
 * User: sv
 * Date: 15.09.2019
 * Time: 15:42
 */

namespace Onnov\Captcha\Model;

/**
 * Class MaybeReturnImgModel
 *
 * @package Onnov\Captcha\Model
 */
class MaybeReturnImgModel
{
    /**
     * The script tries to return the image sequentially first in the GIF format then jpg further to the PNG,
     * $maybeReturnGif = false prevents the return of the image GIF
     *
     * @var bool
     */
    protected $maybeReturnGif = true;

    /**
     * The script tries to return the image sequentially first in the GIF format then jpg further to the PNG,
     * $maybeReturnJpg = false prevents the return of the image JPG
     *
     * @var bool
     */
    protected $maybeReturnJpg = true;

    /**
     * The script tries to return the image sequentially first in the GIF format then jpg further to the PNG,
     * $maybeReturnPng = false prevents the return of the image PNG
     *
     * @var bool
     */
    protected $maybeReturnPng = true;

    /**
     * @return bool
     */
    public function isMaybeReturnGif()
    {
        return $this->maybeReturnGif;
    }

    /**
     * @param bool $maybeReturnGif
     *
     * @return $this
     */
    public function setMaybeReturnGif($maybeReturnGif)
    {
        $this->maybeReturnGif = $maybeReturnGif;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMaybeReturnJpg()
    {
        return $this->maybeReturnJpg;
    }

    /**
     * @param bool $maybeReturnJpg
     *
     * @return $this
     */
    public function setMaybeReturnJpg($maybeReturnJpg)
    {
        $this->maybeReturnJpg = $maybeReturnJpg;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMaybeReturnPng()
    {
        return $this->maybeReturnPng;
    }

    /**
     * @param bool $maybeReturnPng
     *
     * @return $this
     */
    public function setMaybeReturnPng($maybeReturnPng)
    {
        $this->maybeReturnPng = $maybeReturnPng;

        return $this;
    }
}
