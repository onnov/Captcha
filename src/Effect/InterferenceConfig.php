<?php

namespace Onnov\Captcha\Effect;

class InterferenceConfig
{
    /**
     * minimum number of char for interference
     *
     * @var int
     */
    protected $interferenceMin = 10;

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
    protected $interferenceSymbols = '.';

    /**
     * interference color array [R, G, B]
     * Only valid if the effect is applied last!
     *
     * @var array
     */
    protected $interferenceColor = [0, 0, 0];

    /**
     * @return int
     */
    public function getInterferenceMin()
    {
        return $this->interferenceMin;
    }

    /**
     * @param int $interferenceMin
     */
    public function setInterferenceMin($interferenceMin)
    {
        $this->interferenceMin = $interferenceMin;
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
     */
    public function setInterferenceMax($interferenceMax)
    {
        $this->interferenceMax = $interferenceMax;
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
     */
    public function setInterferenceSymbols($interferenceSymbols)
    {
        $this->interferenceSymbols = $interferenceSymbols;
    }

    /**
     * @return array
     */
    public function getInterferenceColor()
    {
        return $this->interferenceColor;
    }

    /**
     * @param array $interferenceColor
     */
    public function setInterferenceColor($interferenceColor)
    {
        $this->interferenceColor = $interferenceColor;
    }
}
