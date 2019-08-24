<?php

namespace Onnov\Captcha\Font;

class MonsterShadowFont extends ModelFont
{
    public function __construct()
    {
        $this
            ->setFontPath(__DIR__ . '/../../fonts/monsterShadow.ttf')
            ->setCharWidth(22)
            ->setCharHeight(20);
    }
}
