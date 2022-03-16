<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture {

	public function load(ObjectManager $manager) {
		// Exemples de données à insérer dans la base de données
		$product_list = [
			['name' => 'Porte-clés', 'price' => 9.50, 'description' => 'Produit officiel de la marque Red Bull Racing', 'image' => 'https://s.yimg.com/uu/api/res/1.2/TudpiNvSlDuhkXCDVd3H7Q--~B/aD03MjM7dz0xNDQwO3NtPTE7YXBwaWQ9eXRhY2h5b24-/https://media.zenfs.com/en/autos.autoweek.com/b27b8022bb5aebb89769be1535d72a60'],
			['name' => 'T-shirt officiel', 'price' => 75.95, 'description' => 'Produit officiel de la marque Red Bull Racing', 'image' => 'https://s.yimg.com/uu/api/res/1.2/TudpiNvSlDuhkXCDVd3H7Q--~B/aD03MjM7dz0xNDQwO3NtPTE7YXBwaWQ9eXRhY2h5b24-/https://media.zenfs.com/en/autos.autoweek.com/b27b8022bb5aebb89769be1535d72a60'],
			['name' => 'Short officiel', 'price' => 55.95, 'description' => 'Produit officiel de la marque Red Bull Racing', 'image' => 'https://s.yimg.com/uu/api/res/1.2/TudpiNvSlDuhkXCDVd3H7Q--~B/aD03MjM7dz0xNDQwO3NtPTE7YXBwaWQ9eXRhY2h5b24-/https://media.zenfs.com/en/autos.autoweek.com/b27b8022bb5aebb89769be1535d72a60'],
			['name' => 'Mug', 'price' => 12.99, 'description' => 'Produit officiel de la marque Red Bull Racing', 'image' => 'https://s.yimg.com/uu/api/res/1.2/TudpiNvSlDuhkXCDVd3H7Q--~B/aD03MjM7dz0xNDQwO3NtPTE7YXBwaWQ9eXRhY2h5b24-/https://media.zenfs.com/en/autos.autoweek.com/b27b8022bb5aebb89769be1535d72a60'],
		];
		// Boucle pour chaque ligne
		foreach ($product_list as $product_data) {
			// Crée une nouvelle entité
			$product = new Product();
			// Donne des valeurs à ses attributs
			$product->setName($product_data['name']);
			$product->setPrice($product_data['price']);
			$product->setDescription($product_data['description']);

			// Enregistre dans la BDD (INSERT)
			$manager->persist($product);
		}
		$manager->flush();
	}
}