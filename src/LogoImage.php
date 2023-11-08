<?php

	namespace UltraScn\Webpage;


	/**
	 * @property-read non-empty-string $path
	 * @property-read positive-int|NULL $width
	 * @property-read positive-int|NULL $height
	 */
	class LogoImage
	{
		/** @var non-empty-string */
		private $path;

		/** @var positive-int|NULL */
		private $width;

		/** @var positive-int|NULL */
		private $height;


		/**
		 * @param non-empty-string $path
		 * @param int|NULL $width
		 * @param int|NULL $height
		 */
		public function __construct(
			$path,
			$width,
			$height
		)
		{
			assert($width > 0);
			assert($height > 0);

			$this->path = $path;
			$this->width = $width;
			$this->height = $height;
		}


		public function __get(string $prop): mixed
		{
			return $this->{$prop};
		}
	}
