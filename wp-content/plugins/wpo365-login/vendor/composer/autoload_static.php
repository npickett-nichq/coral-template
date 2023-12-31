<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2cfd76d515b746a8bfa6a275aaa60b5e
{
    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'phpseclib\\' => 10,
        ),
        'W' => 
        array (
            'Wpo\\Tests\\' => 10,
            'Wpo\\Sync\\' => 9,
            'Wpo\\Services\\' => 13,
            'Wpo\\Pages\\' => 10,
            'Wpo\\Mail\\' => 9,
            'Wpo\\Graph\\' => 10,
            'Wpo\\Firebase\\' => 13,
            'Wpo\\Core\\' => 9,
            'Wpo\\Blocks\\' => 11,
            'Wpo\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'phpseclib\\' => 
        array (
            0 => __DIR__ . '/../..' . '/phpseclib',
        ),
        'Wpo\\Tests\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Tests',
        ),
        'Wpo\\Sync\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Sync',
        ),
        'Wpo\\Services\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Services',
        ),
        'Wpo\\Pages\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Pages',
        ),
        'Wpo\\Mail\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Mail',
        ),
        'Wpo\\Graph\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Graph',
        ),
        'Wpo\\Firebase\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Firebase/JWT',
        ),
        'Wpo\\Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Core',
        ),
        'Wpo\\Blocks\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Blocks',
        ),
        'Wpo\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2cfd76d515b746a8bfa6a275aaa60b5e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2cfd76d515b746a8bfa6a275aaa60b5e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
