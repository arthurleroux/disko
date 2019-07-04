<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Product;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->encoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

        for($i=1; $i<=10; $i++) {
            $product = new Product();
            $product->setName('Product-' . $i);
            $product->setPrice(rand(1, 200));

            $manager->persist($product);
        }

        $user = new User();
        $user->setEmail('arthur@gmail.com');
        $user->setRoles([
            'ROLE_ADMIN'
        ]);
        $user->setPassword($this->encoder->encodePassword($user, 'password'));
        $manager->persist($user);

        $manager->flush();
    }
}
