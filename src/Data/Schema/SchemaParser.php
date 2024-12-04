<?php

namespace Kevinfrom\EconomicApi\Data\Schema;

final class SchemaParser
{
    /**
     * Build a PHP class from a JSON schema. NOTE this is a very basic implementation only supposed to work with a single level of properties e.g. entities.
     *
     * @param string $json
     * @param string $className
     * @param string $namespace
     *
     * @return string
     * @internal
     */
    public static function buildClassFromJson(string $json, string $className, string $namespace): string
    {
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Failed to decode JSON response');
        }

        if (isset($data['properties']) === false) {
            throw new \RuntimeException('Failed to find properties in JSON response');
        }

        $properties = [];

        foreach ($data['properties'] as $propertyName => $property) {
            $properties[] = [
                'name'        => $propertyName,
                'description' => $property['description'] ?? '',
                'required'    => $property['required'] ?? false,
                'type'        => match ($property['type']) {
                    'string' => 'string',
                    'integer' => 'int',
                    'boolean' => 'bool',
                    'array' => 'array',
                },
            ];
        }

        usort($properties, function ($a, $b) {
            return $b['required'] <=> $a['required'];
        });

        $t = str_repeat(' ', 4);

        $phpClass = "<?php\n";
        $phpClass .= "\n";
        $phpClass .= "namespace $namespace;\n";
        $phpClass .= "\n";
        $phpClass .= "final class $className\n";
        $phpClass .= "{\n";
        $phpClass .= "{$t}/**\n";
        foreach ($properties as $property) {
            $n  = $property['name'];
            $r  = $property['required'] ? '' : '|null';
            $ty = $property['type'];
            $d  = $property['description'];

            $phpClass .= "{$t} * @param {$ty}{$r} \${$n} $d\n";
        }
        $phpClass .= "{$t} */\n";
        $phpClass .= "{$t}public function __construct(\n";
        foreach ($properties as $index => $property) {
            $n  = $property['name'];
            $r  = $property['required'] ? '' : '?';
            $ty = $property['type'];
            $dv = $r ? ' = null' : '';
            $c  = $index >= count($properties) - 1 ? '' : ',';

            $phpClass .= "{$t}{$t}public {$r}{$ty} \${$n}{$dv}{$c}\n";
        }
        $phpClass .= "{$t})\n{$t}{\n";
        $phpClass .= "{$t}}\n";
        $phpClass .= "}\n";

        return $phpClass;
    }
}
