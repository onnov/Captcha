<?php
/**
 * Created by PhpStorm.
 * Project: captcha
 * User: sv
 * Date: 15.09.2019
 * Time: 11:30
 */

namespace Onnov\Captcha\Tests;

use Onnov\Captcha\Captcha;
use Onnov\Captcha\CaptchaConfig;
use Onnov\Captcha\CaptchaReturn;
use Onnov\Captcha\Effect\InterferenceConfig;
use Onnov\Captcha\Effect\InterferenceEffect;
use Onnov\Captcha\Effect\WaveDistortionConfig;
use Onnov\Captcha\Effect\WaveDistortionEffect;
use Onnov\Captcha\Font\ActionJacksonFont;
use Onnov\Captcha\Font\Baveuse3dFont;
use Onnov\Captcha\Font\MonsterShadowFont;
use Onnov\Captcha\Model\MaybeReturnImgModel;
use Onnov\Captcha\Model\RgbColorModel;
use PHPUnit\Framework\TestCase;

class CaptchaTest extends TestCase
{
    public function testInstance()
    {
        /** @var Captcha $captcha */
        $captcha = new Captcha();
        $this->assertInstanceOf(Captcha::class, $captcha);
    }

    /**
     * @param CaptchaReturn $result
     *
     * @return void
     */
    private function resultAssert(CaptchaReturn $result)
    {
        $this->assertInstanceOf(CaptchaReturn::class, $result);

        $this->assertIsArray($result->getHeaders());
        $this->assertIsString($result->getImg());
        $this->assertIsString($result->getKeyString());
    }

    public function testDefaultCaptcha()
    {
        /** @var Captcha $captcha */
        $captcha = new Captcha();

        /** @var CaptchaReturn $result */
        $result = $captcha->getCaptcha();

        $this->resultAssert($result);
    }

    public function testConfigFontCaptcha()
    {
        /** @var CaptchaConfig $captchaConfig */
        $captchaConfig = (new CaptchaConfig())
            ->setFonts(
                [
                    new ActionJacksonFont(),
                    new MonsterShadowFont(),
                    new Baveuse3dFont(),
                ]
            );

        /** @var CaptchaReturn $result */
        $result = (new Captcha())
            ->setConfig($captchaConfig)
            ->getCaptcha();

        $this->resultAssert($result);
    }

    public function testConfigEffectCaptcha()
    {
        /** @var CaptchaConfig $captchaConfig */
        $captchaConfig = (new CaptchaConfig())
            ->setEffects([]);

        /** @var CaptchaReturn $result */
        $result = (new Captcha())
            ->setConfig($captchaConfig)
            ->getCaptcha();

        $this->resultAssert($result);
    }

    public function testConfigEffect2Captcha()
    {
        /** @var WaveDistortionConfig $waveDistortionConfig */
        $waveDistortionConfig = (new WaveDistortionConfig())
            ->setAmplitudeStart(350)
            ->setAmplitudeEnd(500)
            ->setAmplitudeDivider(120);

        /** @var InterferenceConfig $interferenceConfig */
        $interferenceConfig = (new InterferenceConfig())
            ->setInterferenceMin(15)
            ->setInterferenceMax(35)
            ->setInterferenceSymbols('.-_=|~/')
            ->setInterferenceColor(
                (new RgbColorModel())
                    ->setRed(100)
                    ->setGreen(150)
                    ->setBlue(200)
            );

        /** @var CaptchaConfig $captchaConfig */
        $captchaConfig = (new CaptchaConfig())
            ->setEffects(
                [
                    new WaveDistortionEffect($waveDistortionConfig),
                    new InterferenceEffect($interferenceConfig),
                ]
            );


        /** @var CaptchaReturn $result */
        $result = (new Captcha())
            ->setConfig($captchaConfig)
            ->getCaptcha();

        $this->resultAssert($result);
    }

    public function testConfigCaptcha()
    {
        /** @var CaptchaConfig $captchaConfig */
        $captchaConfig = (new CaptchaConfig())
            ->setAllowedSymbols('23456789')
            ->setFluctuationAmplitude(5)
            ->setPadding(1)
            ->setCharRotate(7)
            ->setJpegQuality(81)
            ->setMaybeReturnImg(
                (new MaybeReturnImgModel())
                    ->setMaybeReturnGif(false)
                    ->setMaybeReturnJpg(false)
                    ->setMaybeReturnPng(true)
            );


        /** @var CaptchaReturn $result */
        $result = (new Captcha())
            ->setConfig($captchaConfig)
            ->getCaptcha();

        $this->resultAssert($result);
    }

    public function testConfig2Captcha()
    {
        /** @var CaptchaConfig $captchaConfig */
        $captchaConfig = (new CaptchaConfig())
            ->setMaybeReturnImg(
                (new MaybeReturnImgModel())
                    ->setMaybeReturnGif(false)
                    ->setMaybeReturnPng(false)
            );


        /** @var CaptchaReturn $result */
        $result = (new Captcha())
            ->setConfig($captchaConfig)
            ->getCaptcha();

        $this->resultAssert($result);
    }
}
