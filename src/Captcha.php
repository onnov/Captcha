<?php

namespace Onnov\Captcha;

use Onnov\Captcha\Effect\EffectInterface;
use Onnov\Captcha\Effect\InterferenceEffect;
use Onnov\Captcha\Effect\WaveDistortionEffect;
use Onnov\Captcha\Model\FontModel;

/**
 * Class Captcha
 *
 * @package Onnov\Captcha
 */
class Captcha
{
    /** @var CaptchaConfig */
    protected $config;

    /** @var string */
    protected $keyString;

    /**
     * @return void
     */
    protected function fixConfig()
    {
        $effects = $this->getConfig()->getEffects();
        if ($effects == null) {
            $this
                ->getConfig()
                ->setEffects(
                    [
                        new InterferenceEffect(),
                        new WaveDistortionEffect(),
                    ]
                );
        }
    }

    /**
     * generates keystring and image
     *
     * @return CaptchaReturn
     */
    public function getCaptcha()
    {
        $this->fixConfig();
        $conf = $this->getConfig();

        $img = $this->getImg();

        $imgType = '';

        ob_start();

        $rImg = $conf->getMaybeReturnImg();

        if (function_exists("imagegif") && $rImg->isMaybeReturnGif()) {
            $imgType = 'image/gif';
            imagegif($img);
        } elseif (function_exists("imagejpeg") && $rImg->isMaybeReturnJpg()) {
            $imgType = "image/jpeg";
            imagejpeg($img, null, $conf->getJpegQuality());
        } elseif (function_exists("imagepng") && $rImg->isMaybeReturnPng()) {
            $imgType = "image/x-png";
            imagepng($img);
        }

        $imgOut = (string)ob_get_clean();

        return new CaptchaReturn(
            [
                'cache-control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'content-type'  => $imgType,
            ],
            $imgOut,
            $this->keyString
        );
    }

    /**
     * @return resource
     */
    private function getImg()
    {
        $conf = $this->getConfig();
        $size = $conf->getImgSize();
        $width = $size->getWidth();
        $height = $size->getHeight();

        $img = $this->getImgF();
        $img = imagescale($img, $width, $height);

        $effects = $conf->getEffects();

        if (is_array($effects)) {
            /** @var EffectInterface $effect */
            foreach ($effects as $effect) {
                $effect->run($conf, $img);
            }
        }

        return $img;
    }

    /**
     * @return resource
     */
    private function getImgF()
    {
        $conf = $this->getConfig();
        $fonts = $conf->getFonts();

        /** @var FontModel $fontObj */
        $fontObj = $fonts[array_rand($fonts)];

        $font = $fontObj->getFontPath();
        $qfw = $fontObj->getCharWidth();
        $qfh = $fontObj->getCharHeight();

        $chars = $conf->getAllowedSymbols();
        $len = strlen($chars) - 1;
        $lenKS = $conf->getLengthKeyString();
        $length = mt_rand($lenKS->getMin(), $lenKS->getMax());

        $gap = [];
        $gaps = 0;
        for ($i = 0; $i < ($length - 1); $i++) {
            $charG = $conf->getCharacterGap();
            $qrg = mt_rand($charG->getMin(), $charG->getMax());
            $gap[] = $qrg;
            $gaps += $qrg;
        }

        // correct paddind 10 px
        $padding = $conf->getPadding() + 10;
        $qpx = $padding;
        $charRotate = $conf->getCharRotate();
        $qwi = $qfw * $length + $gaps + $padding * 2;
        $qhi = $qfh + $conf->getFluctuationAmplitude() + $padding * 2;
        $img = $this->imageCreate($qwi, $qhi);
        $qbg = imagecolorallocate($img, 255, 255, 255);
        imagefill($img, 0, 0, $qbg);
        $color = imagecolorallocate($img, 0, 0, 0);

        for ($i = 0; $i < $length; $i++) {
            $qck = mt_rand(0, $len);
            $char = $chars{$qck};
            $this->keyString .= $char;

            $qry = mt_rand(0, $conf->getFluctuationAmplitude());

            imagettftext(
                $img,
                30,
                mt_rand(-$charRotate, $charRotate),
                $qpx,
                $qry + $qfw + $padding,
                $color,
                $font,
                $char
            );

            $qrg = 0;
            if (isset($gap[$i])) {
                $qrg = $gap[$i];
            }
            $qpx += $qfw + $qrg;
        }

        return $img;
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
     * @return CaptchaConfig
     */
    private function getConfig()
    {
        if ($this->config == null) {
            $this->setConfig(new CaptchaConfig());
        }
        return $this->config;
    }

    /**
     * @param CaptchaConfig $config
     *
     * @return $this
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }
}
