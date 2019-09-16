<?php

namespace Onnov\Captcha\Effect;

use Onnov\Captcha\CaptchaConfig;
use Onnov\Captcha\Model\RgbColorModel;

/**
 * Class WaveDistortion
 *
 * @package Onnov\Captcha\Effect
 */
class WaveDistortionEffect implements EffectInterface
{
    /** @var WaveDistortionConfig */
    protected $waveDistortionConfig;

    public function __construct(
        WaveDistortionConfig $waveDistortionConfig = null
    ) {
        $this->waveDistortionConfig = is_null($waveDistortionConfig)
            ? new WaveDistortionConfig() : $waveDistortionConfig;
    }

    /**
     * @param RgbColorModel $bgColor
     * @param resource      $imgRes
     *
     * @return int
     */
    private function getBackgroundColor($bgColor, &$imgRes)
    {
        $res = imagecolorallocate(
            $imgRes,
            $bgColor->getRed(),
            $bgColor->getGreen(),
            $bgColor->getBlue()
        );

        return $res;
    }

    /**
     * @param RgbColorModel $fgColor
     * @param resource      $imgRes
     *
     * @return int
     */
    private function getForegroundColor($fgColor, &$imgRes)
    {
        $res = imagecolorallocate(
            $imgRes,
            $fgColor->getRed(),
            $fgColor->getGreen(),
            $fgColor->getBlue()
        );

        return $res;
    }

    private function getRand()
    {
        $conf = $this->getWaveDistortionConfig();
        // случайные параметры (можно поэкспериментировать с коэффициентами):
        // frequency
        return [
            mt_rand(700000, 1000000) / 15000000,
            mt_rand(700000, 1000000) / 15000000,
            mt_rand(700000, 1000000) / 15000000,
            mt_rand(700000, 1000000) / 15000000,
            // phases
            mt_rand(0, 3141592) / 1000000,
            mt_rand(0, 3141592) / 1000000,
            mt_rand(0, 3141592) / 1000000,
            mt_rand(0, 3141592) / 1000000,
            // amplitudes
            mt_rand($conf->getAmplitudeStart(), $conf->getAmplitudeEnd())
            / $conf->getAmplitudeDivider(),
            mt_rand($conf->getAmplitudeStart(), $conf->getAmplitudeEnd())
            / $conf->getAmplitudeDivider(),
        ];
    }

    /**
     * @param CaptchaConfig $config
     * @param resource      $img
     *
     * @return void
     */
    public function run($config, &$img)
    {
        $size = $config->getImgSize();
        $width = $size->getWidth();
        $height = $size->getHeight();
        $bgColor = $config->getBackgroundColor();
        $fgColor = $config->getForegroundColor();
        $center = $width / 2;

        $imgRes = $this->imageCreate($width, $height);
        $qbg = $this->getBackgroundColor($bgColor, $imgRes);

        imagefilledrectangle($imgRes, 0, 0, $width - 1, $height - 1, $qbg);

        $foreground = $this->getForegroundColor($fgColor, $imgRes);

        imagefilledrectangle(
            $img,
            0,
            $height,
            $width - 1,
            $height + 12,
            $foreground
        );

        $rnd = $this->getRand();
        $newRed = $fgColor->getRed();
        $newGreen = $fgColor->getGreen();
        $newBlue = $fgColor->getBlue();

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $qsx = (int)($x + (sin($x * $rnd[0] + $rnd[4]) + sin($y * $rnd[2]
                            + $rnd[5])) * $rnd[8] - $width / 2 + $center + 1);
                $qsy = (int)($y + (sin($x * $rnd[1] + $rnd[6]) + sin($y * $rnd[3]
                            + $rnd[7])) * $rnd[9]);

                if ($qsx < 0 || $qsy < 0 || $qsx >= $width - 1
                    || $qsy >= $height - 1
                ) {
                    continue;
                }

                $color = imagecolorat($img, $qsx, $qsy) & 0xFF;
                $colorX = imagecolorat($img, $qsx + 1, $qsy) & 0xFF;
                $colorY = imagecolorat($img, $qsx, $qsy + 1) & 0xFF;
                $colorXY = imagecolorat($img, $qsx + 1, $qsy + 1) & 0xFF;


                if ($color == 0 && $colorX == 0 && $colorY == 0
                    && $colorXY == 0
                ) {
                    $newRed = $fgColor->getRed();
                    $newGreen = $fgColor->getGreen();
                    $newBlue = $fgColor->getBlue();
                } elseif ($color < 255 && $colorX < 255 && $colorY < 255
                    && $colorXY < 255
                ) {
                    $frsx = $qsx - floor($qsx);
                    $frsy = $qsy - floor($qsy);
                    $frsx1 = 1 - $frsx;
                    $frsy1 = 1 - $frsy;

                    $newcolor = (
                        $color * $frsx1 * $frsy1 +
                        $colorX * $frsx * $frsy1 +
                        $colorY * $frsx1 * $frsy +
                        $colorXY * $frsx * $frsy
                    );

                    $newcolor = $newcolor > 255 ? 255 : $newcolor;

                    $newcolor = $newcolor / 255;
                    $newcolor0 = 1 - $newcolor;

                    $newRed = ceil($newcolor0 * $bgColor->getRed()
                        + $newcolor * $bgColor->getRed());
                    $newGreen = ceil($newcolor0 * $bgColor->getGreen()
                        + $newcolor * $bgColor->getGreen());
                    $newBlue = ceil($newcolor0 * $bgColor->getBlue()
                        + $newcolor * $bgColor->getBlue());
                }

                imagesetpixel(
                    $imgRes,
                    $x,
                    $y,
                    imagecolorallocate($imgRes, $newRed, $newGreen, $newBlue)
                );
            }
        }

        $img = $imgRes;
    }

    /**
     * @param int $width
     * @param int $height
     *
     * @return resource
     */
    private function imageCreate($width, $height)
    {
        $img = imagecreatetruecolor($width, $height);

        return $img;
    }

    /**
     * @return WaveDistortionConfig
     */
    public function getWaveDistortionConfig()
    {
        return $this->waveDistortionConfig;
    }
}
