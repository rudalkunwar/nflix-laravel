<?php

namespace App\Services;

class RegexSearchAlgorithm
{
    public function search($items, $query, $fields)
    {
        $results = [];

        $pattern = '/' . preg_quote($query, '/') . '/i';

        foreach ($items as $item) {
            foreach ($fields as $field) {
                $value = $this->getFieldValue($item, $field);
                if ($value && preg_match($pattern, $value)) {
                    $results[] = $item;
                    break;
                }
            }
        }

        return collect($results);
    }

    private function getFieldValue($item, $field)
    {
        $fieldParts = explode('.', $field);

        foreach ($fieldParts as $part) {
            if (is_object($item)) {
                $item = $item->$part;
            } elseif (is_array($item)) {
                $item = $item[$part];
            } else {
                return null;
            }
        }
        return $item;
    }
}
