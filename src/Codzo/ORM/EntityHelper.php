<?php

namespace Codzo\ORM;

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
}
