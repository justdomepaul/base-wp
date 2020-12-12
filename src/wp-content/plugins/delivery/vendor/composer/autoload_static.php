<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6a14d6d9e6b0475407e3baf5dd31bc18
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6a14d6d9e6b0475407e3baf5dd31bc18::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6a14d6d9e6b0475407e3baf5dd31bc18::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}