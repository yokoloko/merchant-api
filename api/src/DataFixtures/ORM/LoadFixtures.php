<?php declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Entity\Commission;
use App\Entity\Merchant;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class LoadFixtures
 * @package App\DataFixtures\ORM
 *
 * @todo implement file fixtures
 */
class LoadFixtures extends Fixture
{
    /** @var PasswordEncoderInterface $encoder */
    protected $encoder;

    /** @var array */
    protected $references;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $this->loadMerchants($manager);
        $this->loadCommissions($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    protected function loadUsers(ObjectManager $manager)
    {
        $fixtures = [
            ['elodie@test.com','testelodie','Elodie','https://randomuser.me/api/portraits/women/40.jpg', '2017-01-01 10:30:20', '2018-02-01 15:17:32'],
            ['eric@test.com','testelodie','Eric','https://randomuser.me/api/portraits/men/3.jpg', '2017-03-02 10:00:50', '2017-03-02 10:05:53'],
            ['pascal@test.com','testelodie','Pascal','https://randomuser.me/api/portraits/men/5.jpg', '2017-05-19 10:53:20', '2017-09-01 12:03:10']
        ];

        foreach ($fixtures as $fixture) {
            $user = new User();
            $user->setEmail($fixture[0]);
            $user->setPassword($this->encoder->encodePassword($user, $fixture[1]));
            $user->setName($fixture[2]);
            $user->setProfileUrl($fixture[3]);
            $user->setLastLogin(new \DateTime($fixture[4]));
            $user->setCreationDate(new \DateTime($fixture[5]));

            $manager->persist($user);
            $this->referenceRepository->addReference($fixture[0], $user);
        }

        $manager->flush();
    }

    protected function loadMerchants(ObjectManager $manager)
    {
        $fixtures = ['Zalando', 'Fnac', 'Castorama', 'Darty'];

        foreach ($fixtures as $name) {
            $merchant = new Merchant();
            $merchant->setName($name);

            $manager->persist($merchant);
            $this->referenceRepository->addReference($name, $merchant);
        }

        $manager->flush();
    }

    protected function loadCommissions(ObjectManager $manager)
    {
        $fixtures = [
            ['2017-12-01 09:00:00', '10.53', 'Zalando', 'eric@test.com'],
            ['2017-12-01 09:00:00', '10.53', 'Zalando', 'eric@test.com'],
            ['2017-12-03 08:50:00', '8.30', 'Fnac', 'elodie@test.com'],
            ['2017-11-01 08:00:19', '0.13', 'Castorama', 'pascal@test.com'],
            ['2017-10-01 04:00:10', '3.10', 'Darty', 'elodie@test.com'],
            ['2017-07-01 06:00:20', '0.42', 'Zalando', 'eric@test.com'],
            ['2017-09-01 05:00:32', '0.78', 'Fnac', 'pascal@test.com'],
            ['2017-12-01 01:00:00', '4.93', 'Castorama', 'elodie@test.com'],
            ['2017-03-01 03:00:00', '2.12', 'Darty', 'elodie@test.com'],
            ['2017-05-01 08:00:00', '3.61', 'Zalando', 'pascal@test.com'],
            ['2017-02-01 11:26:46', '8.93', 'Fnac', 'elodie@test.com'],
            ['2017-01-01 14:40:07', '10.00', 'Zalando', 'eric@test.com']
        ];

        foreach ($fixtures as $fixture) {
            $commission = new Commission();
            $commission->setUser($this->referenceRepository->getReference($fixture[3]));
            $commission->setMerchant($this->referenceRepository->getReference($fixture[2]));
            $commission->setCashback($fixture[1]);
            $commission->setDate(new \DateTime($fixture[0]));

            $manager->persist($commission);
        }

        $manager->flush();
    }
}
