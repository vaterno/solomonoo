<?php

namespace App\Helpers;

class ArrayHelpers
{
    public static function replaceKeysBy(array $array, string $key): array
    {
        $result = [];

        foreach ($array as $item) {
            if (
                is_object($item) &&
                property_exists($item, $key)
            ) {
                $result[$item->{$key}] = $item;
            } elseif (
                is_array($item) &&
                array_key_exists($key, $item)
            ) {
                $result[$item[$key]] = $item;
            }
        }

        return $result;
    }

    public static function deletNumericKeys(array $data): array
    {
        if (empty($data)) {
            return $data;
        }

        foreach ($data as &$items) {
            if (!empty($items)) {
                foreach ($items as $columnName => $value) {
                    if (is_numeric($columnName)) {
                        unset($items[$columnName]);
                    }
                }
            }
        }

        return $data;
    }
}
