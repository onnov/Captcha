<?php

namespace Onnov\Captcha\Effect;

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
     * @return array
     */
    public function getInterferenceColor()
    {
        return $this->interferenceColor;
    }

    /**
     * @param array $interferenceColor
     *
     * @return $this
     */
    public function setInterferenceColor($interferenceColor)
    {
        $this->interferenceColor = $interferenceColor;

        return $this;
    }
}
