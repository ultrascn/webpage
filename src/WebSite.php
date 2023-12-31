<?php

	declare(strict_types=1);

	namespace UltraScn\Webpage;


	/**
	 * @property-read non-empty-string $name
	 * @property-read non-empty-string|NULL $motto
	 * @property-read Logo $logo
	 */
	class WebSite
	{
		/** @var non-empty-string */
		private $name;

		/** @var non-empty-string|NULL */
		private $motto;

		/** @var Logo */
		private $logo;


		/**
		 * @param non-empty-string $name
		 * @param non-empty-string|NULL $motto
		 * @param Logo $logo
		 */
		public function __construct(
			$name,
			$motto,
			Logo $logo
		)
		{
			$this->name = $name;
			$this->motto = $motto;
			$this->logo = $logo;
		}


		/**
		 * @return mixed
		 */
		public function __get(string $prop)
		{
			return $this->{$prop};
		}
	}
