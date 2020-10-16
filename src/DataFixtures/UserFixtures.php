<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture
{
    private  $encoder;

    /**
     * Dans une class (autre que un controller),
     * on peut récupérer des services par autowiring uniquement dans
     * un constructeur
     */
    public function  __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }




    protected function loadData()
    {
        //utilisateurs
        $this->createMany(5,'user_user',function (int $num){
            $user = new User();
            $password = $this->encoder->encodePassword($user,'admin' . $num);

            return $user
                ->setEmail('user' . $num . '@jesuisunedev.fr')
                ->setPassword($password)
                ->setPseudo('pseudo' . $num)
                ;
        });

    } 
}
