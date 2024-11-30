<?php

namespace Kevinfrom\EconomicApi\Data\Mapper;

use InvalidArgumentException;
use ReflectionClass;

final class EntityMapper
{
    /**
     * Returns a JSON representation of an entity object.
     *
     * @param object $entity
     * @return string
     */
    public static function toJSON(object $entity): string
    {
        return json_encode($entity);
    }

    /**
     * Maps a JSON string to an entity object.
     *
     * @template T
     * @param class-string<T> $entityClass
     * @param string $json
     *
     * @return T
     *
     * @throws \ReflectionException
     */
    public static function toEntity(string $entityClass, string $json): object
    {
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException('Invalid JSON');
        }

        if (!is_array($data)) {
            throw new InvalidArgumentException('JSON must be an array');
        }

        $args = [];

        $reflectionClass = new ReflectionClass($entityClass);
        $constructor = $reflectionClass->getConstructor();

        if ($constructor) {
            foreach ($constructor->getParameters() as $param) {
                $paramName = $param->getName();
                $paramType = $param->getType();
                $paramDefaultValue = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null;

                // @TODO: Handle arrays of entities

                if ($paramType && $paramType->isBuiltin() === false) {
                    $args[] = self::toEntity($paramType->getName(), json_encode($data[$paramName]));
                } elseif (isset($data[$paramName])) {
                    $args[] = $data[$paramName];
                } else {
                    $args[] = $paramDefaultValue;
                }
            }
        }

        return $reflectionClass->newInstanceArgs($args);
    }

    /**
     * Maps an entity object to an associative array.
     *
     * @param string|object $entity
     * @return array
     */
    public static function toArray(string|object $entity): array
    {
        $json = $entity;
        if (is_object($entity)) {
            $json = self::toJSON($entity);
        }

        $result = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException('Invalid JSON');
        }

        if (!is_array($result)) {
            throw new InvalidArgumentException('JSON must be an array');
        }

        return $result;
    }
}
