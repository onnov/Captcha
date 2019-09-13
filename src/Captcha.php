<?php

namespace Onnov\Captcha;

use Onnov\Captcha\Effect\EffectInterface;
use Onnov\Captcha\Effect\InterferenceEffect;
use Onnov\Captcha\Effect\WaveDistortionEffect;
use Onnov\Captcha\Exception\InvalidGdException;
use Onnov\Captcha\Font\ActionJacksonFont;
use Onnov\Captcha\Font\Baveuse3dFont;
use Onnov\Captcha\Font\ModelFont;
use Onnov\Captcha\Font\MonsterShadowFont;

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
    protected $keystring;

    /**
     * @return void
     */
    protected function fixConfig()
    {
        $fonts = $this->getConfig()->getFonts();
        if (count($fonts) === 0) {
            $this
                ->getConfig()
                ->setFonts(
                    [
                        new ActionJacksonFont(),
                    ]
                );
        }

        $effects = $this->getConfig()->getEffects();
        if (is_array($effects) == false) {
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
        if ($this->getConfig() == null) {
            $this->setConfig(new CaptchaConfig());
        }
        $this->fixConfig();
        $conf = $this->getConfig();

        $img = $this->getImg();

        $imgType = '';

        ob_start();

        if (function_exists("imagegif") && $conf->isMaybeReturnGif()) {
            $imgType = 'image/gif';
            imagegif($img);
        } elseif (function_exists("imagejpeg") && $conf->isMaybeReturnJpg()) {
            $imgType = "image/jpeg";
            imagejpeg($img, null, $conf->getJpegQuality());
        } elseif (function_exists("imagepng") && $conf->isMaybeReturnPng()) {
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
            $this->keystring
        );
    }

    /**
     * @return resource
     */
    private function getImg()
    {
        $width = $this->getConfig()->getWidth();
        $height = $this->getConfig()->getHeight();

        $img = $this->getImgF();
        $img = imagescale($img, $width, $height);

        if ($img == false) {
            throw new InvalidGdException('imageScale error');
        }

        $effects = $this->getConfig()->getEffects();

        if (is_array($effects)) {
            /** @var EffectInterface $effect */
            foreach ($effects as $effect) {
                $effect->run($this->getConfig(), $img);
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

        /** @var ModelFont $fontObj */
        $fontObj = $fonts[array_rand($fonts)];

        $font = $fontObj->getFontPath();
        $qfw = $fontObj->getCharWidth();
        $qfh = $fontObj->getCharHeight();

        $chars = $conf->getAllowedSymbols();
        $len = strlen($chars) - 1;
        $length = mt_rand($conf->getLengthMin(), $conf->getLengthMax());

        $gap = [];
        $gaps = 0;
        for ($i = 0; $i < ($length - 1); $i++) {
            $qrg = mt_rand($conf->getGapMin(), $conf->getGapMax());
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
            $this->keystring .= $char;

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
        if ($img === false) {
            throw new InvalidGdException('Cannot Initialize new GD image stream');
        }

        return $img;
    }

    /**
     * @return CaptchaConfig
     */
    private function getConfig()
    {
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
