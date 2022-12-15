<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc8c642ae5681d91c72aa4cec5d7af83d
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\Ticket\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\Ticket\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc8c642ae5681d91c72aa4cec5d7af83d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc8c642ae5681d91c72aa4cec5d7af83d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc8c642ae5681d91c72aa4cec5d7af83d::$classMap;

        }, null, ClassLoader::class);
    }
}
