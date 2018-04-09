<?php declare(strict_types=1);

namespace Tests\App\Entity;

use App\Entity\Merchant;
use AppBundle\Entity\Address;
use PHPUnit\Framework\TestCase;

/**
 * Class AddressTest
 *
 * This class is used to test the accessors of the entity.
 *
 * @package Tests\AppBundle\Entity
 */
class MerchantTest extends TestCase
{
    /**
     * Test: Accessors
     *
     * @return null
     */
    public function testAccessors()
    {
        $entity = new Merchant();

        $this->assertEquals(null, $entity->getId());

        $this->assertEquals(null, $entity->getName());
        $this->assertInstanceOf(Merchant::class, $entity->setName('name'));
        $this->assertEquals('name', $entity->getName());
    }
}
