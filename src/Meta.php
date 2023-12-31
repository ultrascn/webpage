<?php

	declare(strict_types=1);

	namespace UltraScn\Webpage;


	/**
	 * @property-read non-empty-string $name
	 * @property-read string $content
	 */
	class Meta
	{
		/** @var non-empty-string */
		private $name;

		/** @var string */
		private $content;


		/**
		 * @param non-empty-string $name
		 * @param string $content
		 */
		public function __construct(
			$name,
			$content
		)
		{
			$this->name = $name;
			$this->content = $content;
		}


		/**
		 * @return mixed
		 */
		public function __get(string $prop)
		{
			return $this->{$prop};
		}
	}
