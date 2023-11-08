<?php

	namespace UltraScn\Webpage;


	class ComponentBlock implements ContentBlock
	{
		/** @var string */
		private $name;

		/** @var array<string|int, mixed> */
		private $parameters;


		/**
		 * @param string $name
		 * @param array<string|int, mixed> $parameters
		 */
		public function __construct($name, array $parameters)
		{
			$this->name = $name;
			$this->parameters = $parameters;
		}


		public function toHtml()
		{
			return new \Latte\Runtime\Html('');
		}


		/**
		 * @return string
		 */
		public function getName()
		{
			return $this->name;
		}


		/**
		 * @return array<string|int, mixed>
		 */
		public function getParameters()
		{
			return $this->parameters;
		}
	}
