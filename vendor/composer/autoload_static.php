<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7a6d019a5541edf14029988aa3785b38
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SEKLock\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SEKLock\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7a6d019a5541edf14029988aa3785b38::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7a6d019a5541edf14029988aa3785b38::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
