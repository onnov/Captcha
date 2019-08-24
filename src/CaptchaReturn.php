<?php

namespace Onnov\Captcha;

/**
 * Class CaptchaReturn
 * @package Onnov\Captcha
 */
class CaptchaReturn
{
    /** @var array */
    protected $headers = [];
    
    /** @var string */
    protected $img;
    
    /** @var string */
    protected $keyString;

    /**
     * CaptchaReturn constructor.
     * @param array $headers
     * @param string $img
     * @param string $keyString
     */
    public function __construct($headers, $img, $keyString)
    {
        $this->headers = $headers;
        $this->img = $img;
        $this->keyString = $keyString;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @return string
     */
    public function getKeyString()
    {
        return $this->keyString;
    }
}
