<?php
declare(strict_types=1);

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
 * @package Onnov\Captcha
 */
class Captcha
{
    /** @var CaptchaConfig */
    protected $config;

    /** @var string */
    protected $keystring;

    /**
     * Captcha constructor.
     * @param CaptchaConfig|null $config
     */
    public function __construct(CaptchaConfig $config = null)
    {
        $this->config = is_null($config) ? new CaptchaConfig() : $config;

        if (is_null($this->config->getFonts())) {
            $this->config->setFonts(
                [
                    new ActionJacksonFont(),
                    new MonsterShadowFont(),
                    new Baveuse3dFont(),
                ]
            );
        }

        if (is_null($this->config->getEffects())) {
            $this->config->setEffects(
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

        $imgOut = trim(ob_get_clean());

        return new CaptchaReturn(
            [
                'cache-control' => 'no-store, no-cache, must-revalidate, max-age=0',
                'content-type' => $imgType,
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

        /** @var EffectInterface $effect */
        foreach ($this->getConfig()->getEffects() as $effect) {
            $effect->run($this->getConfig(), $img);
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
        $fw = $fontObj->getCharWidth();
        $fh = $fontObj->getCharHeight();

        $chars = $conf->getAllowedSymbols();
        $len = strlen($chars) - 1;
        $length = mt_rand($conf->getLengthMin(), $conf->getLengthMax());

        $gap = [];
        $gaps = 0;
        for ($i = 0; $i < ($length - 1); $i++) {
            $g = mt_rand($conf->getGapMin(), $conf->getGapMax());
            $gap[] = $g;
            $gaps += $g;
        }

        $paddingTopCorrector = $conf->getPaddingTopCorrector();
        $padding = $conf->getPadding();
        $x = $padding;
        $charRotate = $conf->getCharRotate();
        $w = $fw * $length + $gaps + $padding * 2;
        $h = $fh + $conf->getFluctuationAmplitude() + $padding * 2;
        $img = $this->imageCreate($w, $h);
        $bg = imagecolorallocate($img, 255, 255, 255);
        imagefill($img, 0, 0, $bg);
        $color = imagecolorallocate($img, 0, 0, 0);

        for ($i = 0; $i < $length; $i++) {
            $ck = mt_rand(0, $len);
            $char = $chars{$ck};
            $this->keystring .= $char;

            $y = mt_rand(0, $conf->getFluctuationAmplitude());

            imagettftext(
                $img,
                30,
                mt_rand(-$charRotate, $charRotate),
                $x,
                $y + $fw + $padding + $paddingTopCorrector,
                $color,
                $font,
                $char
            );

            $g = 0;
            if (isset($gap[$i])) {
                $g = $gap[$i];
            }
            $x += $fw + $g;
        }

        return $img;
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

    /**
     * @return CaptchaConfig
     */
    public function getConfig(): CaptchaConfig
    {
        return $this->config;
    }

    /**
     * @param CaptchaConfig $config
     */
    public function setConfig(CaptchaConfig $config): void
    {
        $this->config = $config;
    }
}
