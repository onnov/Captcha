<?php

namespace Onnov\Captcha\Model;

/**
 * Class FontModel
 *
 * @package Onnov\Captcha\Model
 */
class FontModel
{
    /** @var string */
    protected $fontPath;

    /** @var int */
    protected $charWidth;

    /** @var int */
    protected $charHeight;

    /**
     * @return string
     */
    public function getFontPath()
    {
        return $this->fontPath;
    }

    /**
     * @param string $fontPath
     *
     * @return $this
     */
    public function setFontPath($fontPath)
    {
        $this->fontPath = $fontPath;

        return $this;
    }

    /**
     * @return int
     */
    public function getCharWidth()
    {
        return $this->charWidth;
    }

    /**
     * @param int $charWidth
     *
     * @return $this
     */
    public function setCharWidth($charWidth)
    {
        $this->charWidth = $charWidth;

        return $this;
    }

    /**
     * @return int
     */
    public function getCharHeight()
    {
        return $this->charHeight;
    }

    /**
     * @param int $charHeight
     *
     * @return $this
     */
    public function setCharHeight($charHeight)
    {
        $this->charHeight = $charHeight;

        return $this;
    }
}
