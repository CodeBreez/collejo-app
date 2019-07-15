<?php

namespace Collejo\Foundation\Repository\Tests;

use Collejo\Foundation\Repository\BaseRepository;
use Collejo\Foundation\Testing\TestCase;
use Uuid;

class RepositoryTest extends TestCase
{
    /**
     * Test if a new UUID could be generated.
     */
    public function testNewUuid()
    {
        $uuid = $this->getRepository()->newUuid();

        $this->assertTrue(is_string($uuid));
        $this->assertEquals(strlen((string) $uuid), 36);
        $this->assertTrue(Uuid::validate((string) $uuid));
    }

    /**
     * Returns a new instance of the TestableRepository.
     *
     * @return TestableRepository
     */
    private function getRepository()
    {
        return new TestableRepository();
    }
}

class TestableRepository extends BaseRepository
{
}
