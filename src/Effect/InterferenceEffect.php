<?php

namespace Onnov\Captcha\Effect;

/**
 * Class InterferenceEffect
 *
 * @package Onnov\Captcha\Effect
 */
class InterferenceEffect implements EffectInterface
{
    /** @var InterferenceConfig */
    protected $interferenceConfig;

    public function __construct(InterferenceConfig $interferenceConfig = null)
    {
        $this->interferenceConfig = is_null($interferenceConfig)
            ? new InterferenceConfig() : $interferenceConfig;
    }

    public function run($config, &$img)
    {
        $size = $config->getImgSize();
        $width = $size->getWidth();
        $height = $size->getHeight();

        $iConf = $this->getInterferenceConfig();
        $color = $iConf->getInterferenceColor();

        $charArr = str_split($iConf->getInterferenceSymbols());

        $intnsv = rand(
            $iConf->getInterferenceMin(),
            $iConf->getInterferenceMax()
        );
        for ($i = 0; $i < $intnsv; $i++) {
            $qrx = rand(0, $width);
            $qry = rand(0, $height);
            $qrf = rand(0, 5);

            $qic = imagecolorallocate(
                $img,
                $color->getRed(),
                $color->getGreen(),
                $color->getBlue()
            );
            imagechar(
                $img,
                $qrf,
                $qrx,
                $qry,
                $charArr[array_rand($charArr)],
                $qic
            );
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
