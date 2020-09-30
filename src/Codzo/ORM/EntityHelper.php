<?php

namespace Codzo\ORM;

use Codzo\Config\Config;

class EntityHelper
{
    /**
     * convert to Pascal Case
     * eg. some-kind-of-class => SomeKindOfClass
     *
     * @param $name string
     * @return string converted
     */
    public static function toPascalCase($name)
    {
        return str_replace(
            ' ',
            '',
            ucwords(
                preg_replace(
                    '/[_-]+/',
                    ' ',
                    strtolower($name)
                )
            )
        );
    }


    /**
     * convert to Camel Case
     * eg. some-kind-of-class => someKindOfClass
     *
     * @param $name string
     * @return string converted
     */
    public static function toCamelCase($name)
    {
        return lcfirst(
            str_replace(
                ' ',
                '',
                ucwords(
                    preg_replace(
                        '/[_-]+/',
                        ' ',
                        strtolower($name)
                    )
                )
            )
        );
    }

    /**
     * convert to Kebab Case
     * eg. SomeKindOfClass => some-kind-of-class
     *
     * @param $name string
     * @return string converted
     */
    public function toKebabCase($name)
    {
        return strtolower(
            preg_replace(
                '/([A-Z])([a-z])/',
                '-\1\2',
                $name
            )
        );
    }

    /**
     * convert to snake Case
     * eg. SomeKindOfClass => some_kind_of_class
     *
     * @param $name string
     * @return string converted
     */
    public function toSnakeCase($name)
    {
        return strtolower(
            preg_replace(
                '/([A-Z])([a-z])/',
                '_\1\2',
                $name
            )
        );
    }

    public static function getEntityClassName($entityname)
    {
        $config = Config::getInstance();
        $entity_classname = self::toPascalCase($entityname);

        $namespaces = preg_split(
            '/[,; ]+/',
            $config->get('entity.namespaces', '')
        );

        $entity_namespace = null;
        foreach ($namespaces as $ns) {
            if (class_exists($ns . "\\" . $entity_classname)) {
                $entity_namespace = $ns;
                break;
            }
        }

        if ($entity_namespace) {
            return $entity_namespace . "\\" . $entity_classname;
        }

        throw new \Exception("Can not find class for $entityname");
    }
}
