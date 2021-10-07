<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb239930e9c2e2f4ea6e7779ec120cdf0
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb239930e9c2e2f4ea6e7779ec120cdf0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb239930e9c2e2f4ea6e7779ec120cdf0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb239930e9c2e2f4ea6e7779ec120cdf0::$classMap;

        }, null, ClassLoader::class);
    }
}
