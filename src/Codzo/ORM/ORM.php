<?php

namespace Codzo\ORM;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Codzo\Config\Config;

class ORM
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private static $entityManager = null;

    /**
     * @var Array
     */
    private static $orm_config_paths = [];

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public static function getEntityManager()
    {
        if (static::$entityManager === null) {
            $rootpath = '.';
            if (defined('APP_ROOTPATH')) {
                $rootpath = APP_ROOTPATH;
            }

            $paths = self::getORMConfigPaths();
            $config = new Config($rootpath . '/config');

            // convert setting to true/false
            $isDevMode = !! $config->get('app.debug.mode', false);

            // define credentials...
            $connectionOptions = array(
                'driver'   => $config->get('db.driver'),
                'host'     => $config->get('db.host'),
                'dbname'   => $config->get('db.dbname'),
                'user'     => $config->get('db.user'),
                'password' => $config->get('db.password'),
                'charset'  => 'UTF8'
            );

            static::$entityManager = EntityManager::create(
                $connectionOptions,
                Setup::createXMLMetadataConfiguration($paths, $isDevMode)
            );
        }

        return static::$entityManager;
    }


    /**
     * @param  $path    String list of config path
     * @return Array    list of config path
     */
    public static function addORMConfigPath($path)
    {
        self::$orm_config_paths[] = $path;
        return self::$orm_config_paths;
    }

    /**
     * @return Array list of config path
     */
    public static function getORMConfigPaths()
    {
        return self::$orm_config_paths;
    }
}
