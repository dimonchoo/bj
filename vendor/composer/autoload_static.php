<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8f06a1f96744190685aea45ad28fe5b4
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8f06a1f96744190685aea45ad28fe5b4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8f06a1f96744190685aea45ad28fe5b4::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}