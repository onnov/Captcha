<?php

namespace Onnov\Captcha\Effect;

class WaveDistortionConfig
{
    /** @var int */
    protected $amplitudeStart = 300;

    /** @var int */
    protected $amplitudeEnd = 450;

    /** @var int */
    protected $amplitudeDivider = 100;

    /**
     * @return int
     */
    public function getAmplitudeStart()
    {
        return $this->amplitudeStart;
    }

    /**
     * @param int $amplitudeStart
     *
     * @return $this
     */
    public function setAmplitudeStart($amplitudeStart)
    {
        $this->amplitudeStart = $amplitudeStart;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmplitudeEnd()
    {
        return $this->amplitudeEnd;
    }

    /**
     * @param int $amplitudeEnd
     *
     * @return $this
     */
    public function setAmplitudeEnd($amplitudeEnd)
    {
        $this->amplitudeEnd = $amplitudeEnd;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmplitudeDivider()
    {
        return $this->amplitudeDivider;
    }

    /**
     * @param int $amplitudeDivider
     *
     * @return $this
     */
    public function setAmplitudeDivider($amplitudeDivider)
    {
        $this->amplitudeDivider = $amplitudeDivider;

        return $this;
    }
}
