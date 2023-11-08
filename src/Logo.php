<?php

	declare(strict_types=1);

	namespace UltraScn\Webpage;


	/**
	 * @property-read non-empty-string $title
	 * @property-read non-empty-string|NULL $motto
	 * @property-read LogoImage|NULL $image
	 */
	class Logo
	{
		/** @var non-empty-string */
		private $title;

		/** @var non-empty-string|NULL */
		private $motto;

		/** @var LogoImage|NULL */
		private $image;


		/**
		 * @param non-empty-string $title
		 * @param non-empty-string|NULL $motto
		 * @param LogoImage|NULL $image
		 */
		public function __construct(
			$title,
			$motto,
			?LogoImage $image = NULL
		)
		{
			$this->title = $title;
			$this->motto = $motto;
			$this->image = $image;
		}


		public function __get(string $prop): mixed
		{
			return $this->{$prop};
		}
	}
