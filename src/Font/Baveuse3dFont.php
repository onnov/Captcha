<?php

namespace Onnov\Captcha\Font;

use Onnov\Captcha\Model\FontModel;

/**
 * Class Baveuse3dFont
 *
 * @package Onnov\Captcha\Font
 */
class Baveuse3dFont extends FontModel
{
    /**
     * Baveuse3dFont constructor.
     */
    public function __construct()
    {
        $this
            ->setFontPath(__DIR__ . '/../../fonts/baveuse3d.ttf')
            ->setCharWidth(27)
            ->setCharHeight(25);
    }
}
