<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture {

	public function __construct(UserPasswordHasherInterface $passwordEncoder)
	{
		$this->passwordEncoder = $passwordEncoder;
	}

	public function load(ObjectManager $manager) {
		// Exemples de données à insérer dans la base de données
		$user_list = [
			['username' => 'admin', 'email' => 'a@b.c', 'password' => '123', 'roles' => ['ROLE_USER', 'ROLE_ADMIN']],
			['username' => 'simple_user', 'email' => 'd@e.f', 'password' => '456', 'roles' => ['ROLE_USER']],
		];
		// Boucle pour chaque ligne
		foreach ($user_list as $user_data) {
			// Crée une nouvelle entité
			$user = new User();
			// Donne des valeurs à ses attributs
			$user->setUsername($user_data['username']);
			$user->setEmail($user_data['email']);
			$user->setPassword($this->passwordEncoder->hashPassword($user, $user_data['password']));
			$user->setRoles($user_data['roles']);
			// Enregistre dans la BDD (INSERT)
			$manager->persist($user);
		}
		$manager->flush();
	}
}