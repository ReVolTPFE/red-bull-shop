<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture {

	public function load(ObjectManager $manager) {
		// Exemples de données à insérer dans la base de données
		$category_list = [
			['name' => 'Vêtement'],
			['name' => 'Eté'],
			['name' => 'Hiver'],
			['name' => 'Autre'],
		];
		// Boucle pour chaque ligne
		foreach ($category_list as $category_data) {
			// Crée une nouvelle entité
			$category = new Category();
			// Donne des valeurs à ses attributs
			$category->setName($category_data['name']);
			// Enregistre dans la BDD (INSERT)
			$manager->persist($category);
		}
		$manager->flush();
	}
}