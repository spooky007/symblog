<?php

namespace FutureTech\SymblogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use FutureTech\SymblogBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
	/**
	 * @var ContainerInterface
	 */
	private $container;

	/**
	 * Load Data fixtures with passed Entity Manager
	 * 
	 * @param ObjectManager $manager
     */
	public function Load(ObjectManager $manager)
	{
		$user = new User();
		$user->setUserName('admin');
		$user->setEmail('minangeric@gmail.com');
		$encoder = $this->container->get('security.password_encoder');
		$password = $encoder->encodePassword($user, 'password');
		$user->setPassword($password);

		$manager->persist($user);
		$manager->flush();
	}

	/**
	 * Sets the Container
	 *
	 * @param ContainerInterface|null $container
	 */
	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}
}