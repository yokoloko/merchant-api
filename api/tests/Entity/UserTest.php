<?php declare(strict_types=1);

namespace Tests\App\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class AddressTest
 *
 * This class is used to test the accessors of the entity.
 *
 * @package Tests\AppBundle\Entity
 */
class UserTest extends TestCase
{
    /**
     * Test: Accessors
     *
     * @return null
     */
    public function testAccessors()
    {
        $date = new \DateTime('2017-01-01 00:00:00');

        $entity = new User();

        $this->assertEquals(null, $entity->getId());

        $this->assertEquals(null, $entity->getCreationDate());
        $this->assertInstanceOf(User::class, $entity->setCreationDate($date));
        $this->assertEquals($date, $entity->getCreationDate());

        $this->assertEquals(null, $entity->getLastLogin());
        $this->assertInstanceOf(User::class, $entity->setLastLogin($date));
        $this->assertEquals($date, $entity->getLastLogin());

        $this->assertEquals(null, $entity->getProfileUrl());
        $this->assertInstanceOf(User::class, $entity->setProfileUrl('url'));
        $this->assertEquals('url', $entity->getProfileUrl());

        $this->assertEquals(null, $entity->getEmail());
        $this->assertInstanceof(User::class, $entity->setEmail('email'));
        $this->assertEquals('email', $entity->getEmail());

        $this->assertEquals(null, $entity->getPassword());
        $this->assertInstanceof(User::class, $entity->setPassword('password'));
        $this->assertEquals('password', $entity->getPassword());

        $this->assertEquals(null, $entity->getCommissions());
        $this->assertInstanceof(User::class, $entity->setCommissions(['1']));
        $this->assertEquals(['1'], $entity->getCommissions());
    }
}
