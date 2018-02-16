<?php

namespace Collejo\Foundation\Tests;

require_once __DIR__.'/../helpers.php';

use Collejo\Foundation\Database\Eloquent\LoadFactories;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, LoadFactories, DatabaseMigrations, DatabaseTransactions;

    /**
     * Assert if two array have same values
     *
     * @param $a
     * @param $b
     */
    public function assertArraysEquals($a, $b)
    {
        $a = !is_array($a) ? $a->toArray() : $a;
        $b = !is_array($b) ? $b->toArray() : $b;

        $a = array_values($a);
        $b = array_values($b);

        return $this->assertTrue($a == $b);
    }

    /**
     * Assert if array key and values are equal.
     *
     * @param $a
     * @param $b
     */
    public function assertArrayValuesEquals($a, $b)
    {

        $a = !is_array($a) ? $a->toArray() : $a;
        $b = !is_array($b) ? $b->toArray() : $b;


        if (isset($a['id'])) {
            unset($a['id']);
        }

        if (isset($b['id'])) {
            unset($b['id']);
        }

        foreach ($b as $k => $v) {

            if (isset($a[$k])) {

                if ($v != $a[$k]) {

                    return $this->assertTrue(false);
                }
            }
        }

        return $this->assertTrue(true);
    }

    /**
     * Setup.
     */
    public function setup()
    {
        parent::setup();

        $this->loadFactories();
    }
}
