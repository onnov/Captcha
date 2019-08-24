<?php

namespace Onnov\Captcha\Effect;

use Onnov\Captcha\Exception\InvalidGdException;
use Onnov\Captcha\CaptchaConfig;

/**
 * Class WaveDistortion
 * @package Onnov\Captcha\Effect
 */
class WaveDistortionEffect implements EffectInterface
{
    /**
     * @param CaptchaConfig $config
     * @param resource $img
     */
    public function run($config, &$img)
    {
        $width = $config->getWidth();
        $height = $config->getHeight();
        $foregroundColor = $config->getForegroundColor();
        $backgroundColor = $config->getBackgroundColor();

        $center = $width / 2;

        $imgRes = $this->imageCreate($width, $height);
        $bg = imagecolorallocate(
            $imgRes,
            $backgroundColor[0],
            $backgroundColor[1],
            $backgroundColor[2]
        );
        imagefilledrectangle($imgRes, 0, 0, $width - 1, $height - 1, $bg);

        $foreground = imagecolorallocate(
            $img,
            $foregroundColor[0],
            $foregroundColor[1],
            $foregroundColor[2]
        );
        imagefilledrectangle(
            $img,
            0,
            $height,
            $width - 1,
            $height + 12,
            $foreground
        );

        // periods
//        $rand1 = mt_rand(750000, 1200000) / 10000000;
//        $rand2 = mt_rand(750000, 1200000) / 10000000;
//        $rand3 = mt_rand(750000, 1200000) / 10000000;
//        $rand4 = mt_rand(750000, 1200000) / 10000000;

        $rand1 = mt_rand(75, 120) / 1000;
        $rand2 = mt_rand(75, 120) / 1000;
        $rand3 = mt_rand(75, 120) / 1000;
        $rand4 = mt_rand(75, 120) / 1000;
        // phases
        $rand5 = mt_rand(0, 31415926) / 10000000;
        $rand6 = mt_rand(0, 31415926) / 10000000;
        $rand7 = mt_rand(0, 31415926) / 10000000;
        $rand8 = mt_rand(0, 31415926) / 10000000;
        // amplitudes
        //$rand9  = mt_rand(330, 420) / 110;
        //$rand10 = mt_rand(330, 450) / 110;
        $rand9 = mt_rand(220, 330) / 110;
        $rand10 = mt_rand(220, 330) / 110;
        //wave distortion

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $sx = (int)round(
                    $x
                    + (sin($x * $rand1 + $rand5)
                        + sin($y * $rand3 + $rand6)) * $rand9 - $width / 2
                    + $center + 1,
                    0
                );
                $sy = (int)round(
                    $y
                    + (sin($x * $rand2 + $rand7)
                        + sin($y * $rand4 + $rand8)) * $rand10,
                    0
                );

                if ($sx < 0 || $sy < 0 || $sx >= $width - 1
                    || $sy >= $height - 1
                ) {
                    continue;
                } else {
                    $color = imagecolorat($img, $sx, $sy) & 0xFF;
                    $color_x = imagecolorat($img, $sx + 1, $sy) & 0xFF;
                    $color_y = imagecolorat($img, $sx, $sy + 1) & 0xFF;
                    $color_xy = imagecolorat($img, $sx + 1, $sy + 1) & 0xFF;
                }

                if ($color == 255 && $color_x == 255 && $color_y == 255
                    && $color_xy == 255
                ) {
                    continue;
                } elseif ($color == 0 && $color_x == 0 && $color_y == 0
                    && $color_xy == 0
                ) {
                    $newred = $foregroundColor[0];
                    $newgreen = $foregroundColor[1];
                    $newblue = $foregroundColor[2];
                } else {
                    $frsx = $sx - floor($sx);
                    $frsy = $sy - floor($sy);
                    $frsx1 = 1 - $frsx;
                    $frsy1 = 1 - $frsy;

                    $newcolor = (
                        $color * $frsx1 * $frsy1 +
                        $color_x * $frsx * $frsy1 +
                        $color_y * $frsx1 * $frsy +
                        $color_xy * $frsx * $frsy);

                    if ($newcolor > 255) {
                        $newcolor = 255;
                    }
                    $newcolor = $newcolor / 255;
                    $newcolor0 = 1 - $newcolor;

                    $newred = $newcolor0 * $foregroundColor[0] + $newcolor
                        * $backgroundColor[0];
                    $newgreen = $newcolor0 * $foregroundColor[1] + $newcolor
                        * $backgroundColor[1];
                    $newblue = $newcolor0 * $foregroundColor[2] + $newcolor
                        * $backgroundColor[2];
                }

                imagesetpixel(
                    $imgRes,
                    $x,
                    $y,
                    imagecolorallocate(
                        $imgRes,
                        (int)$newred,
                        (int)$newgreen,
                        (int)$newblue
                    )
                );
            }
        }

        $img = $imgRes;
    }

    /**
     * @param int $width
     * @param int $height
     *
     * @return false|resource
     */
    private function imageCreate(int $width, int $height)
    {
        $img = imagecreatetruecolor($width, $height);
        if ($img === false) {
            throw new InvalidGdException('Cannot Initialize new GD image stream');
        }
        return $img;
    }
}
