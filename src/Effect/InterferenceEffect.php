<?php

namespace Onnov\Captcha\Effect;

/**
 * Class InterferenceEffect
 * @package Onnov\Captcha\Effect
 */
class InterferenceEffect implements EffectInterface
{
    /** @var InterferenceConfig */
    protected $interferenceConfig;
    
    public function __construct(InterferenceConfig $interferenceConfig = null)
    {
        $this->interferenceConfig = is_null($interferenceConfig) ? new InterferenceConfig() : $interferenceConfig;
    }

    public function run($config, &$img)
    {
        $width = $config->getWidth();
        $height = $config->getHeight();

        $iConf = $this->getInterferenceConfig();
        $color = $iConf->getInterferenceColor();
        
        $charArr = str_split($iConf->getInterferenceSymbols());

        $intnsv = rand($iConf->getInterferenceMin(), $iConf->getInterferenceMax());
        for ($i = 0; $i < $intnsv; $i++) {
            $x = rand(0, $width);
            $y = rand(0, $height);
            $f = rand(0, 5);

            $c = imagecolorallocate($img, $color[0], $color[1], $color[2]);
            imagechar($img, $f, $x, $y, $charArr[array_rand($charArr)], $c);
        }
    }

    /**
     * @return InterferenceConfig
     */
    public function getInterferenceConfig()
    {
        return $this->interferenceConfig;
    }
}
