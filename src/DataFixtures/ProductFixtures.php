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
			['name' => 'Dynamic Bull T-Shirt', 'price' => 65.50, 'description' => 'Produit officiel de la marque Red Bull Racing', 'image' => 'https://assets.redbullshop.com/images/f_auto,q_auto/t_product-list/products/RBR/2022/RBR22005_13_1/Dynamic-Bull-T-Shirt.jpg'],
			['name' => 'World Champion T-Shirt', 'price' => 75.95, 'description' => 'Produit officiel de la marque Red Bull Racing', 'image' => 'https://assets.redbullshop.com/images/f_auto,q_auto/t_product-list/products/RBR/2021/RBR21186_13_1/Max-Verstappen-World-Champion-2021-T-Shirt.jpg'],
			['name' => 'Traction Hoodie', 'price' => 55.95, 'description' => 'Produit officiel de la marque Red Bull Racing', 'image' => 'https://assets.redbullshop.com/images/f_auto,q_auto/t_product-list/products/RBR/2022/RBR22010_2_1/Traction-Hoodie.jpg'],
			['name' => 'Balance Hoodie', 'price' => 57.99, 'description' => 'Produit officiel de la marque Red Bull Racing', 'image' => 'https://assets.redbullshop.com/images/f_auto,q_auto/t_product-list/products/RBR/2022/RBR22007_1G_1/Balance-Hoodie.jpg'],
			['name' => 'Chicane T-Shirt', 'price' => 36.99, 'description' => 'Produit officiel de la marque Red Bull Racing', 'image' => 'https://assets.redbullshop.com/images/f_auto,q_auto/t_product-list/products/RBR/2022/RBR22002_2D_1/Chicane-T-Shirt.jpg'],
			['name' => 'Balance Polo Shirt', 'price' => 50.50, 'description' => 'Produit officiel de la marque Red Bull Racing', 'image' => 'https://assets.redbullshop.com/images/f_auto,q_auto/t_product-list/products/RBR/2022/RBR22008_13_1/Balance-Polo-Shirt.jpg'],
			['name' => 'Double Bull T-Shirt', 'price' => 46.95, 'description' => 'Produit officiel de la marque Red Bull Racing', 'image' => 'https://assets.redbullshop.com/images/f_auto,q_auto/t_product-list/products/RBR/2022/RBR22006_13_1/Double-Bull-T-Shirt.jpg'],
			['name' => 'Track Sweatpants', 'price' => 65.95, 'description' => 'Produit officiel de la marque Red Bull Racing', 'image' => 'https://assets.redbullshop.com/images/f_auto,q_auto/t_product-list/products/RBR/2022/RBR22015_1J_1/Track-Sweatpants.jpg'],
			['name' => 'Leadcat 2.0 Slides', 'price' => 25.99, 'description' => 'Produit officiel de la marque Red Bull Racing', 'image' => 'https://assets.redbullshop.com/images/f_auto,q_auto/t_product-list/products/RBR/2022/RBR22027_13_1/Leadcat-2-0-Slides.jpg'],
			
		];
		// Boucle pour chaque ligne
		foreach ($product_list as $product_data) {
			// Crée une nouvelle entité
			$product = new Product();
			// Donne des valeurs à ses attributs
			$product->setName($product_data['name']);
			$product->setPrice($product_data['price']);
			$product->setDescription($product_data['description']);
			$product->setImage($product_data['image']);

			// Enregistre dans la BDD (INSERT)
			$manager->persist($product);
		}
		$manager->flush();
	}
}