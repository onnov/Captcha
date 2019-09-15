<?php

namespace Onnov\Captcha;

use Onnov\Captcha\Effect\EffectInterface;
use Onnov\Captcha\Font\ActionJacksonFont;
use Onnov\Captcha\Model\FontModel;
use Onnov\Captcha\Model\MaybeReturnImgModel;
use Onnov\Captcha\Model\MinMaxRangeModel;
use Onnov\Captcha\Model\RgbColorModel;
use Onnov\Captcha\Model\SizeModel;

class CaptchaConfig
{
    /**
     * image width x height px
     * 100-50
     *
     * @var SizeModel
     */
    protected $imgSize;

    /**
     * foreground color rgb(0, 0, 0)
     *
     * @var RgbColorModel
     */
    protected $foregroundColor;

    /**
     * background color rgb[255, 255, 255]
     *
     * @var RgbColorModel
     */
    protected $backgroundColor;

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
     * @var FontModel[]
     */
    protected $fonts;

    /**
     * maximum and minimum length key string
     * 4-4
     *
     * @var MinMaxRangeModel
     */
    protected $lengthKeyString;

    /**
     * maximum and minimum gap between symbols
     * 0-10
     *
     * @var MinMaxRangeModel
     */
    protected $characterGap;

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

    /** @var MaybeReturnImgModel */
    protected $maybeReturnImg;


    public function __construct()
    {
        $this
            ->setImgSize(
                (new SizeModel())
                    ->setWidth(100)
                    ->setHeight(50)
            )
            ->setForegroundColor(
                (new RgbColorModel())
                    ->setRed(0)
                    ->setGreen(0)
                    ->setBlue(0)
            )
            ->setBackgroundColor(
                (new RgbColorModel())
                    ->setRed(255)
                    ->setGreen(255)
                    ->setBlue(255)
            )
            ->setLengthKeyString(
                (new MinMaxRangeModel())
                    ->setMin(4)
                    ->setMax(4)
            )
            ->setCharacterGap(
                (new MinMaxRangeModel())
                    ->setMin(0)
                    ->setMax(10)
            )
            ->setMaybeReturnImg(new MaybeReturnImgModel());
    }

    /**
     * @return SizeModel
     */
    public function getImgSize()
    {
        return $this->imgSize;
    }

    /**
     * @param SizeModel $imgSize
     *
     * @return $this
     */
    public function setImgSize(SizeModel $imgSize)
    {
        $this->imgSize = $imgSize;

        return $this;
    }

    /**
     * @return RgbColorModel
     */
    public function getForegroundColor()
    {
        return $this->foregroundColor;
    }

    /**
     * @param RgbColorModel $foregroundColor
     *
     * @return $this
     */
    public function setForegroundColor(RgbColorModel $foregroundColor)
    {
        $this->foregroundColor = $foregroundColor;

        return $this;
    }

    /**
     * @return RgbColorModel
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @param RgbColorModel $backgroundColor
     *
     * @return $this
     */
    public function setBackgroundColor(RgbColorModel $backgroundColor)
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
     *
     * @return $this
     */
    public function setAllowedSymbols($allowedSymbols)
    {
        $this->allowedSymbols = $allowedSymbols;

        return $this;
    }

    /**
     * @return FontModel[]
     */
    public function getFonts()
    {
        if ($this->fonts == null) {
            $this->fonts = [new ActionJacksonFont()];
        }
        return $this->fonts;
    }

    /**
     * @param FontModel[] $fonts
     *
     * @return $this
     */
    public function setFonts($fonts)
    {
        $this->fonts = $fonts;

        return $this;
    }

    /**
     * @return MinMaxRangeModel
     */
    public function getLengthKeyString()
    {
        return $this->lengthKeyString;
    }

    /**
     * @param MinMaxRangeModel $lengthKeyString
     *
     * @return $this
     */
    public function setLengthKeyString(MinMaxRangeModel $lengthKeyString)
    {
        $this->lengthKeyString = $lengthKeyString;

        return $this;
    }

    /**
     * @return MinMaxRangeModel
     */
    public function getCharacterGap()
    {
        return $this->characterGap;
    }

    /**
     * @param MinMaxRangeModel $characterGap
     *
     * @return $this
     */
    public function setCharacterGap(MinMaxRangeModel $characterGap)
    {
        $this->characterGap = $characterGap;

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
     *
     * @return $this
     */
    public function setFluctuationAmplitude($fluctuationAmplitude)
    {
        $this->fluctuationAmplitude = $fluctuationAmplitude;

        return $this;
    }

    /**
     * @return EffectInterface[]|null
     */
    public function getEffects()
    {
        return $this->effects;
    }

    /**
     * @param EffectInterface[] $effects
     *
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
     *
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
     *
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
     *
     * @return $this
     */
    public function setJpegQuality($jpegQuality)
    {
        $this->jpegQuality = $jpegQuality;

        return $this;
    }

    /**
     * @return MaybeReturnImgModel
     */
    public function getMaybeReturnImg()
    {
        return $this->maybeReturnImg;
    }

    /**
     * @param MaybeReturnImgModel $maybeReturnImg
     *
     * @return $this
     */
    public function setMaybeReturnImg(MaybeReturnImgModel $maybeReturnImg)
    {
        $this->maybeReturnImg = $maybeReturnImg;

        return $this;
    }
}
