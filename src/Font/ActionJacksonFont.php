<?php

namespace Onnov\Captcha\Font;

class ActionJacksonFont extends ModelFont
{
    public function __construct()
    {
        $this
            ->setFontPath(__DIR__ . '/../../fonts/actionJackson.ttf')
            ->setCharWidth(25)
            ->setCharHeight(20);
    }
}
