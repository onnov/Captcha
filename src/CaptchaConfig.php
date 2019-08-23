<?php
/**
 * Created by PhpStorm.
 * Project: mail
 * User: sv
 * Date: 23.08.2019
 * Time: 21:34
 */

namespace Onnov;


class CaptchaConfig
{
    /**
     * image width px
     *
     * @var int
     */
    protected $width = 100;

    /**
     * image height px
     *
     * @var int
     */
    protected $height = 50;

    /**
     * foreground color array [R, G, B]
     *
     * @var array
     */
    protected $foregroundColor = [0, 0, 0];

    /**
     * background color array [R, G, B]
     *
     * @var array
     */
    protected $backgroundColor = [255, 255, 255];

    /**
     * symbols used to draw CAPTCHA
     * alphabet without similar symbols (o=0, 1=l, i=j, t=f)
     */
    protected $allowedSymbols = '23456789abcdeghkmnpqsuvxyz';

    protected $fontMin = 0;
    protected $fontMax = 2;

    /**
     * minimum string length
     *
     * @var int
     */
    protected $lengthMin = 5;

    /**
     * maximum string length
     *
     * @var int
     */
    protected $lengthMax = 5;

    /**
     * minimum gap between symbols
     *
     * @var int
     */
    protected $gapMin = 0; // минимальный пробел

    /**
     * maximum gap between symbols
     *
     * @var int
     */
    protected $gapMax = 10;

    /**
     * symbol's vertical fluctuation amplitude divided by 2
     *
     * @var int
     */
    protected $fluctuationAmplitude = 5;

    /**
     * additional interference
     *
     * @var bool
     */
    protected $interference = true;

    /**
     * JPEG quality of CAPTCHA image
     * 
     * @var int 
     */
    protected $jpegQuality = 70;
}
