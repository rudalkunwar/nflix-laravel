<?php

namespace App\Services;
use Illuminate\Support\Collection;

class BubbleSortAlgorithm
{
    public function sortAscending(Collection $collection, string $attribute): Collection
    {
        $array = $collection->all();
        $n = count($array);

        if ($n < 2) {
            return $collection;
        }

        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($array[$j]->{$attribute} > $array[$j + 1]->{$attribute}) {
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }

        return new Collection($array);
    }

    public function sortDescending(Collection $collection, string $attribute): Collection
    {
        $array = $collection->all();
        $n = count($array);

        if ($n < 2) {
            return $collection;
        }

        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($array[$j]->{$attribute} < $array[$j + 1]->{$attribute}) {
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }

        return new Collection($array);
    }
}