<?php

namespace Onnov\Captcha\Font;

use Onnov\Captcha\Model\FontModel;

/**
 * Class MonsterShadowFont
 *
 * @package Onnov\Captcha\Font
 */
class MonsterShadowFont extends FontModel
{
    /**
     * MonsterShadowFont constructor.
     */
    public function __construct()
    {
        $this
            ->setFontPath(__DIR__ . '/../../fonts/monsterShadow.ttf')
            ->setCharWidth(22)
            ->setCharHeight(20);
    }
}
