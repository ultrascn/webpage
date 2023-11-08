<?php

	namespace UltraScn\Webpage;


	class NetteControlBlock implements ContentBlock
	{
		/** @var string */
		private $name;


		/**
		 * @param string $name
		 */
		public function __construct($name)
		{
			$this->name = $name;
		}


		public function toHtml()
		{
			return new \Latte\Runtime\Html('');
		}


		/**
		 * @return string
		 */
		public function getControlName()
		{
			return $this->name;
		}


		/**
		 * @param  ContentBlock[] $blocks
		 * @param  array<string, callable> $factories
		 * @return ContentBlock[]
		 */
		public static function injectToPresenter(
			array $blocks,
			\Nette\Application\UI\Presenter $presenter,
			array $factories
		)
		{
			$counts = [];

			foreach ($blocks as &$block) {
				if (($block instanceof ComponentBlock) && isset($factories[$block->getName()])) {
					$name = $block->getName();
					$baseGeneratedName = strtr(substr(md5($name), 0, 10), [
						'0' => 'g',
						'1' => 'i',
						'2' => 'k',
						'3' => 'm',
						'4' => 'o',
						'5' => 'q',
						'6' => 's',
						'7' => 'u',
						'8' => 'w',
						'9' => 'z',
					]);

					if (!isset($counts[$name])) {
						$counts[$name] = 0;
					}

					$controlFactory = $factories[$name];
					$createdControl = $controlFactory($block->getParameters());

					if ($createdControl !== NULL) {
						$counts[$name]++;
						$controlName = $baseGeneratedName . $counts[$name];
						$presenter[$controlName] = $createdControl;
						$block = new self($controlName);
					}
				}
			}

			return $blocks;
		}
	}
