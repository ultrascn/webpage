<?php

	namespace UltraScn\Webpage;

	use Latte\Runtime\HtmlStringable;
	use Nette\Utils\IHtmlString;


	/**
	 * @property-read non-empty-string $title
	 * @property-read IHtmlString|HtmlStringable|NULL $perex
	 * @property-read ContentBlock[] $blocks
	 * @property-read non-empty-string|NULL $previewImage
	 */
	class Content
	{
		/** @var non-empty-string */
		private $title;

		/** @var IHtmlString|HtmlStringable|NULL */
		private $perex;

		/** @var ContentBlock[] */
		private $blocks;

		/** @var non-empty-string|NULL */
		private $previewImage;



		/**
		 * @param non-empty-string $title
		 * @param IHtmlString|HtmlStringable|NULL $perex
		 * @param ContentBlock[] $blocks
		 * @param non-empty-string|NULL $previewImage
		 */
		public function __construct(
			$title,
			$perex,
			array $blocks,
			$previewImage = NULL
		)
		{
			$this->title = $title;
			$this->perex = $perex;
			$this->blocks = $blocks;
			$this->previewImage = $previewImage;
		}


		public function __get(string $prop): mixed
		{
			return $this->{$prop};
		}
	}
