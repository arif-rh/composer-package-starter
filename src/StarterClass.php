<?php namespace Arifrh\Packages;

/**
*  Starter Kit for creating composer package
*
*  @author Arif RH
*/
class StarterClass
{
   /**
    * @var string $version class properties - package version
    */
    protected static $version = '1.0';

    public static function getVersion()
    {
       return self::$version;
    }
}