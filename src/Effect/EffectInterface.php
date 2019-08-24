<?php

namespace Onnov\Captcha\Effect;

use Onnov\Captcha\CaptchaConfig;

interface EffectInterface
{
    /**
     * @param CaptchaConfig $config
     * @param resource $img
     * @return void
     */
    public function run($config, &$img);
}
