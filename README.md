[![Build Status](https://travis-ci.org/onnov/captcha.svg?branch=master)](https://travis-ci.org/onnov/captcha)

# captcha
![Captchas examples](https://formm.ru/captcha/captcha.png)

[Captcha demo](https://formm.ru/captcha)

Captcha with the most flexible settings.
Are changing:
- Font
- The size
- Colors
- Effects

## Installation

[Composer](https://getcomposer.org) (recommended)
Use Composer to install this library from Packagist: onnov/captcha

Run the following command from your project directory to add the dependency:
```bach
composer require onnov/captcha
```
Alternatively, add the dependency directly to your composer.json file:
```
"require": {
    "onnov/captcha": "^1.0"
}
```
The classes in the project are structured according to the PSR-4 standard, so you can also use your own autoloader or require the needed files directly in your code.


## Usage

### SYMFONY
If you use SYMFONY framework:

in services.yaml file
```yaml
services:
    Onnov\Captcha\Captcha:
        autowire: true
```
in the controller or service
``` php
use Onnov\Captcha\Captcha;
```
```php
    /** @var Captcha */
    protected $captcha;

    public function __construct(Captcha $captcha) {
        $this->captcha = $captcha;
    }
```

### Without framework

```php
use Onnov\Captcha\Captcha;

$captcha = new Captcha();
``` 

#### Get captcha with default settings:

```php
/**
 * Returns CaptchaReturn Object
 *
 * @var CaptchaReturn $result
 */
$result = $captcha->getCaptcha()

// Save the value of the captcha in the session
$_SESSION['CaptchaKeyString'] = $result->getKeyString();

// Send the desired headers
foreach ($result->getHeaders() as $k => $v) {
    header($k.': '.$v);
}

// Send captcha to browser
echo $result->getImg();
```

## Custom setting

The default font is ActionJackson. You can use monsterShadow or baveuse3d fonts already inside.

```php
use Onnov\Captcha\Font\MonsterShadowFont;
use Onnov\Captcha\CaptchaConfig;

$capchaConfig = (new CaptchaConfig())->setFonts([new MonsterShadowFont()]);
$result = $captcha
            ->setConfig($capchaConfig)
            ->getCaptcha();
```

You can use several fonts at the same time, they will be used in random order.
```php
use Onnov\Captcha\Font\ActionJacksonFont;
use Onnov\Captcha\Font\MonsterShadowFont;
use Onnov\Captcha\Font\Baveuse3dFont;
use Onnov\Captcha\CaptchaConfig;

$capchaConfig = (new CaptchaConfig())
            ->setFonts(
                [
                    new ActionJacksonFont(),
                    new MonsterShadowFont(),
                    new Baveuse3dFont(),
                ]
            );
$result = $captcha
            ->setConfig($capchaConfig)
            ->getCaptcha();
```
You can use any TTF font, specifying the path and the proportions to it in the form of two width and height parameters (you will have to select the parameters experimentally)
```php
use Onnov\Captcha\Font\ModelFont;
use Onnov\Captcha\CaptchaConfig;

$font = (new ModelFont())
            ->setFontPath(__DIR__.'/SignboardCpsNr.ttf')
            ->setCharWidth(25)
            ->setCharHeight(30);
$capchaConfig = (new CaptchaConfig())->setFonts([$font]);
$result = $captcha
            ->setConfig($capchaConfig)
            ->getCaptcha();
```

### Distortion effects

By default, two effects are used to distort the image in captcha:
- Interference
- Wave distortion (The algorithm is taken from the site http://captcha.ru/captchas/multiwave/)


You can turn off both effects.
```php
use Onnov\Captcha\CaptchaConfig;

$capchaConfig = (new CaptchaConfig())->setEffects([]);
$result = $captcha
            ->setConfig($capchaConfig)
            ->getCaptcha();
```
You can use only one effect.
```php
use Onnov\Captcha\CaptchaConfig;
use Onnov\Captcha\Effect\WaveDistortionEffect;

$capchaConfig = (new CaptchaConfig())->setEffects([new WaveDistortionEffect()]);
$result = $captcha
            ->setConfig($capchaConfig)
            ->getCaptcha();
```
You can change the sequence of application (by default, first Interference then WaveDistortion)
```php
use Onnov\Captcha\CaptchaConfig;
use Onnov\Captcha\Effect\WaveDistortionEffect;
use Onnov\Captcha\Effect\InterferenceEffect;

$capchaConfig = (new CaptchaConfig())
            ->setEffects(
                [
                    new WaveDistortionEffect(),
                    new InterferenceEffect(),
                ]
            );
$result = $captcha
            ->setConfig($capchaConfig)
            ->getCaptcha();
```
Each effect can be configured.
```php
use Onnov\Captcha\CaptchaConfig;
use Onnov\Captcha\Effect\InterferenceConfig;
use Onnov\Captcha\Effect\InterferenceEffect;
use Onnov\Captcha\Effect\WaveDistortionConfig;
use Onnov\Captcha\Effect\WaveDistortionEffect;

$waveDistortionConfig = (new WaveDistortionConfig())
            ->setAmplitudeStart(300)
            ->setAmplitudeEnd(500)
            ->setAmplitudeDivider(120);

$interferenceConfig = (new InterferenceConfig())
            ->setInterferenceMin(25)
            ->setInterferenceMax(35)
            ->setInterferenceSymbols(':#~');
        
$capchaConfig = (new CaptchaConfig())
            ->setEffects(
                [
                    new WaveDistortionEffect($waveDistortionConfig),
                    new InterferenceEffect($interferenceConfig),
                ]
            );

$result = $captcha
            ->setConfig($capchaConfig)
            ->getCaptcha();
```


### Basic captcha settings
* **setWidth(120)** // image width px
* **setHeight(50)** // image height px
* **setForegroundColor([0,0,0])** // foreground color array [R, G, B]
* **setBackgroundColor([255,255,255])** // background color array [R, G, B]
* **setAllowedSymbols('23456789')** // symbols used to draw CAPTCHA
* number of characters in captcha
    * **setLengthMin(4)** // minimum string length
    * **setLengthMax(5)** // maximum string length
* size gap between symbols
    * **setGapMin(0)** // minimum gap between symbols
    * **setGapMax(10)** // maximum gap between symbols
* **setFluctuationAmplitude(5)** // symbol's vertical fluctuation amplitude 
* **setPadding(5)** // indent from the edge of the image to the inscription
* **setCharRotate(5)** // The angle in degrees for char rotation
* **setJpegQuality(70)** // JPEG quality of CAPTCHA image
* The script tries to return the image sequentially first in the GIF format then jpg further to the PNG
    * **setMaybeReturnGif(false)** // prevents the return of the image GIF
    * **setMaybeReturnJpg(false)** // prevents the return of the image JPG
    * **setMaybeReturnPng(false)** // prevents the return of the image PNG   

configuration example

```php
use Onnov\Captcha\CaptchaConfig;

$capchaConfig = (new CaptchaConfig())
            ->setWidth(120)
            ->setHeight(70)
            ->setPadding(5)
            ->setBackgroundColor([255,255,220])
            ->setForegroundColor([0,100,100]);

$result = $captcha
            ->setConfig($capchaConfig)
            ->getCaptcha();
```

