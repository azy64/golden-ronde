<?php

namespace App\DataFixtures;

use App\Entity\Pointaux;
use App\Entity\Site;
use App\Entity\TypeEvenements;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setEmail('aladdinaladdin1989@gmail.com');
        $user->setNom('Ally');
        $user->setPrenom('Aladdin');
        $user->setTelephone('0753200240');
        $user->setPseudo('Azy');
        $user->setAdresse('136 RUE DES MURLINS 45000');
        $user->setNumPro('#345678900');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user->setDateNais(new \DateTime('now'));
        $user->setPassword($this->encoder->hashPassword($user, '@Talmud89'));
        $manager->persist($user);
        $site1 = new Site();
        $site1->setNom('Site 1');
        $site1->setAdresse('136 RUE DES MURLINS 45000');
        $site2 = new Site();
        $site2->setNom('Site 2');
        $site2->setAdresse('146 RUE DES MURLINS 45000');
        $tab_envent = [
            'vol','agression','fuite de gaz','intrusion','attaque terroriste', 
            'malaise','arrêt cardiaque', 
            'Client agressive', 
            'fenêtre ouverte','autres'
        ];

        $tab_pointaux = [
            'Point ouest du Bureau','Point Nord du Bureau','Point Sud du Bureau',
            'Point Est du Bureau','Point central du Chateau', 
            'malaise','Palissade','Porte du Chateau','Porte du Bureau',
            'Entrée du Chateau','Entrée du Bureau','Interieur du Chateau',
        ];
        $i = 0;
        foreach($tab_pointaux as $point){
            $pointaux = new Pointaux();
            $pointaux->setLibelle($point);
            if($i<5) $site1->addPointaux($pointaux);
            else $site2->addPointaux($pointaux);
            $i++;
        }
        $manager->persist($site1);
        $manager->persist($site2);

        
        foreach($tab_envent as $event){
            $ev = new TypeEvenements();
            $ev->setLibelle($event);
            $manager->persist($ev);
        }

        $manager->flush();
    }
}
