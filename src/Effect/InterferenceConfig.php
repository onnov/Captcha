<?php

namespace Onnov\Captcha\Effect;

use Onnov\Captcha\Model\RgbColorModel;

class InterferenceConfig
{
    /**
     * minimum number of char for interference
     *
     * @var int
     */
    protected $interferenceMin = 20;

    /**
     * maximum number of char for interference
     *
     * @var int
     */
    protected $interferenceMax = 30;

    /**
     * symbols used to draw interference (.-_=|~/)
     *
     * @var string
     */
    protected $interferenceSymbols = '-=~';

    /**
     * interference color rgb[0, 0, 0]
     * Only valid if the effect is applied last!
     *
     * @var RgbColorModel
     */
    protected $interferenceColor;

    public function __construct()
    {
        $this->interferenceColor = (new RgbColorModel())
            ->setRed(0)
            ->setGreen(0)
            ->setBlue(0);
    }

    /**
     * @return int
     */
    public function getInterferenceMin()
    {
        return $this->interferenceMin;
    }

    /**
     * @param int $interferenceMin
     *
     * @return $this
     */
    public function setInterferenceMin($interferenceMin)
    {
        $this->interferenceMin = $interferenceMin;

        return $this;
    }

    /**
     * @return int
     */
    public function getInterferenceMax()
    {
        return $this->interferenceMax;
    }

    /**
     * @param int $interferenceMax
     *
     * @return $this
     */
    public function setInterferenceMax($interferenceMax)
    {
        $this->interferenceMax = $interferenceMax;

        return $this;
    }

    /**
     * @return string
     */
    public function getInterferenceSymbols()
    {
        return $this->interferenceSymbols;
    }

    /**
     * @param string $interferenceSymbols
     *
     * @return $this
     */
    public function setInterferenceSymbols($interferenceSymbols)
    {
        $this->interferenceSymbols = $interferenceSymbols;

        return $this;
    }

    /**
     * @return RgbColorModel
     */
    public function getInterferenceColor()
    {
        return $this->interferenceColor;
    }

    /**
     * @param RgbColorModel $interferenceColor
     *
     * @return $this
     */
    public function setInterferenceColor(RgbColorModel $interferenceColor)
    {
        $this->interferenceColor = $interferenceColor;

        return $this;
    }
}
