<?php

namespace Onnov\Captcha\Font;

use Onnov\Captcha\Model\FontModel;

/**
 * Class ActionJacksonFont
 *
 * @package Onnov\Captcha\Font
 */
class ActionJacksonFont extends FontModel
{
    /**
     * ActionJacksonFont constructor.
     */
    public function __construct()
    {
        $this
            ->setFontPath(__DIR__ . '/../../fonts/actionJackson.ttf')
            ->setCharWidth(25)
            ->setCharHeight(20);
    }
}
