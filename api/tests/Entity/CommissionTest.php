<?php declare(strict_types=1);

namespace Tests\App\Entity;

use App\Entity\Commission;
use App\Entity\Merchant;
use App\Entity\User;
use AppBundle\Entity\Address;
use PHPUnit\Framework\TestCase;

/**
 * Class AddressTest
 *
 * This class is used to test the accessors of the entity.
 *
 * @package Tests\AppBundle\Entity
 */
class CommissionTest extends TestCase
{
    /**
     * Test: Accessors
     *
     * @return null
     */
    public function testAccessors()
    {
        $date = new \DateTime('2017-01-01 00:00:00');

        $entity = new Commission();
        $user = new User();
        $merchant = new Merchant();

        $this->assertEquals(null, $entity->getId());

        $this->assertEquals(null, $entity->getUser());
        $this->assertInstanceOf(Commission::class, $user);
        $this->assertEquals($user, $entity->getUser());

        $this->assertEquals(null, $entity->getMerchant());
        $this->assertInstanceOf(Commission::class, $merchant);
        $this->assertEquals($merchant, $entity->getMerchant());

        $this->assertEquals(null, $entity->getCashback());
        $this->assertInstanceOf(Commission::class, 1);
        $this->assertEquals(1, $entity->getCashback());

        $this->assertEquals(null, $entity->getDate());
        $this->assertInstanceOf(Commission::class, $date);
        $this->assertEquals($date, $entity->getDate());
    }
}
