<?php

namespace Onnov\Captcha\Font;

class Baveuse3dFont extends ModelFont
{
    public function __construct()
    {
        $this
            ->setFontPath(__DIR__ . '/../../fonts/baveuse3d.ttf')
            ->setCharWidth(27)
            ->setCharHeight(25);
    }
}
