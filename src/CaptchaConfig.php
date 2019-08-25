<?php
declare(strict_types=1);

namespace Onnov\Captcha;

use Onnov\Captcha\Effect\EffectInterface;
use Onnov\Captcha\Effect\InterferenceConfig;
use Onnov\Captcha\Effect\InterferenceEffect;
use Onnov\Captcha\Effect\WaveDistortionEffect;
use Onnov\Captcha\Font\ActionJacksonFont;
use Onnov\Captcha\Font\Baveuse3dFont;
use Onnov\Captcha\Font\MonsterShadowFont;
use Onnov\Captcha\Font\ModelFont;

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
     *
     * @var string
     */
    protected $allowedSymbols = '23456789abcdeghkmnpqsuvxyz';

    /**
     * List of objects used fonts
     *
     * @var ModelFont[]|null
     */
    protected $fonts = null;

    /**
     * minimum string length
     *
     * @var int
     */
    protected $lengthMin = 4;

    /**
     * maximum string length
     *
     * @var int
     */
    protected $lengthMax = 4;

    /**
     * minimum gap between symbols
     *
     * @var int
     */
    protected $gapMin = 0;

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
    protected $fluctuationAmplitude = 3;

    /**
     * List of objects used effects
     *
     * @var EffectInterface[]|null
     */
    protected $effects = null;

    /**
     * indent from the edge of the image to the inscription
     *
     * @var int
     */
    protected $padding = 0;

    /**
     * The angle in degrees for char rotation
     *
     * @var int
     */
    protected $charRotate = 5;

    /**
     * JPEG quality of CAPTCHA image
     *
     * @var int
     */
    protected $jpegQuality = 70;

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
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
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
     * @param int $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return array
     */
    public function getForegroundColor()
    {
        return $this->foregroundColor;
    }

    /**
     * @param array $foregroundColor
     * @return $this
     */
    public function setForegroundColor($foregroundColor)
    {
        $this->foregroundColor = $foregroundColor;

        return $this;
    }

    /**
     * @return array
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @param array $backgroundColor
     * @return $this
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    /**
     * @return string
     */
    public function getAllowedSymbols()
    {
        return $this->allowedSymbols;
    }

    /**
     * @param string $allowedSymbols
     * @return $this
     */
    public function setAllowedSymbols($allowedSymbols)
    {
        $this->allowedSymbols = $allowedSymbols;

        return $this;
    }

    /**
     * @return ModelFont[]
     */
    public function getFonts()
    {
        return $this->fonts;
    }

    /**
     * @param ModelFont[] $fonts
     * @return $this
     */
    public function setFonts($fonts)
    {
        $this->fonts = $fonts;

        return $this;
    }

    /**
     * @return int
     */
    public function getLengthMin()
    {
        return $this->lengthMin;
    }

    /**
     * @param int $lengthMin
     * @return $this
     */
    public function setLengthMin($lengthMin)
    {
        $this->lengthMin = $lengthMin;

        return $this;
    }

    /**
     * @return int
     */
    public function getLengthMax()
    {
        return $this->lengthMax;
    }

    /**
     * @param int $lengthMax
     * @return $this
     */
    public function setLengthMax($lengthMax)
    {
        $this->lengthMax = $lengthMax;

        return $this;
    }

    /**
     * @return int
     */
    public function getGapMin()
    {
        return $this->gapMin;
    }

    /**
     * @param int $gapMin
     * @return $this
     */
    public function setGapMin($gapMin)
    {
        $this->gapMin = $gapMin;

        return $this;
    }

    /**
     * @return int
     */
    public function getGapMax()
    {
        return $this->gapMax;
    }

    /**
     * @param int $gapMax
     * @return $this
     */
    public function setGapMax($gapMax)
    {
        $this->gapMax = $gapMax;

        return $this;
    }

    /**
     * @return int
     */
    public function getFluctuationAmplitude()
    {
        return $this->fluctuationAmplitude;
    }

    /**
     * @param int $fluctuationAmplitude
     * @return $this
     */
    public function setFluctuationAmplitude($fluctuationAmplitude)
    {
        $this->fluctuationAmplitude = $fluctuationAmplitude;

        return $this;
    }

    /**
     * @return EffectInterface[]
     */
    public function getEffects()
    {
        return $this->effects;
    }

    /**
     * @param EffectInterface[] $effects
     * @return $this
     */
    public function setEffects($effects)
    {
        $this->effects = $effects;

        return $this;
    }

    /**
     * @return int
     */
    public function getPadding()
    {
        return $this->padding;
    }

    /**
     * @param int $padding
     * @return $this
     */
    public function setPadding($padding)
    {
        $this->padding = $padding;

        return $this;
    }

    /**
     * @return int
     */
    public function getCharRotate()
    {
        return $this->charRotate;
    }

    /**
     * @param int $charRotate
     * @return $this
     */
    public function setCharRotate($charRotate)
    {
        $this->charRotate = $charRotate;

        return $this;
    }

    /**
     * @return int
     */
    public function getJpegQuality()
    {
        return $this->jpegQuality;
    }

    /**
     * @param int $jpegQuality
     * @return $this
     */
    public function setJpegQuality($jpegQuality)
    {
        $this->jpegQuality = $jpegQuality;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMaybeReturnGif()
    {
        return $this->maybeReturnGif;
    }

    /**
     * @param bool $maybeReturnGif
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
     * @return $this
     */
    public function setMaybeReturnPng($maybeReturnPng)
    {
        $this->maybeReturnPng = $maybeReturnPng;

        return $this;
    }
}
