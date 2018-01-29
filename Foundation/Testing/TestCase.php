<?php

namespace Collejo\Foundation\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Assert if array values are equal
     *
     * @param $a
     * @param $b
     */
    public function assertArrayValuesEquals($a, $b)
    {
        $a = !is_array($a) ? $a->toArray() : $a;
        $b = !is_array($b) ? $b->toArray() : $b;
        if (isset($a['id'])) { unset($a['id']); }
        if (isset($b['id'])) { unset($b['id']); }
        foreach($b as $k => $v) {
            if (isset($a[$k])) {
                if ($v != $a[$k]) {
                    return $this->assertTrue(false);
                }
            }
        }

        return $this->assertTrue(true);
    }

    /**
     * Asserts if array are equal
     *
     * @param $a
     * @param $b
     */
    public function assertArrayEquals($a, $b) {
        $a = !is_array($a) ? $a->toArray() : $a;
        $b = !is_array($b) ? $b->toArray() : $b;
        if (isset($a['id'])) { unset($a['id']); }
        if (isset($b['id'])) { unset($b['id']); }
        if (count(array_diff_assoc($a, $b))) {
            return $this->assertTrue(false);
        }
        foreach($a as $k => $v) {
            if ($v !== $b[$k]) {
                return $this->assertTrue(false);
            }
        }
        return $this->assertTrue(true);
    }
}