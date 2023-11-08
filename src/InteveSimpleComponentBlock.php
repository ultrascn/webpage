<?php

	declare(strict_types=1);

	namespace UltraScn\Webpage;


	class InteveSimpleComponentBlock implements ContentBlock
	{
		/** @var string */
		private $componentName;

		/** @var array<string, mixed> */
		private $parameters;


		/**
		 * @param string $componentName
		 * @param array<string, mixed> $parameters
		 */
		public function __construct($componentName, array $parameters)
		{
			$this->componentName = $componentName;
			$this->parameters = $parameters;
		}


		public function toHtml()
		{
			return new \Latte\Runtime\Html('');
		}


		/**
		 * @return string
		 */
		public function getComponentName()
		{
			return $this->componentName;
		}


		/**
		 * @return array<string, mixed>
		 */
		public function getParameters()
		{
			return $this->parameters;
		}


		/**
		 * @param  ContentBlock[] $blocks
		 * @param  array<string, callable> $factories
		 * @return ContentBlock[]
		 */
		public static function processBlocks(
			array $blocks,
			array $factories
		)
		{
			foreach ($blocks as &$block) {
				if (($block instanceof ComponentBlock) && isset($factories[$name = $block->getName()])) {
					$controlFactory = $factories[$name];
					$newBlock = $controlFactory($block->getParameters());

					if (!($newBlock instanceof self)) {
						throw new \RuntimeException('Returned block must be instance of ' . self::class);
					}

					$block = $newBlock;
				}
			}

			return $blocks;
		}
	}
