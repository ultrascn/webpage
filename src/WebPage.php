<?php

	declare(strict_types=1);

	namespace UltraScn\Webpage;


	/**
	 * @property-read WebSite $website
	 * @property-read non-empty-string $title
	 * @property-read Content $content
	 * @property-read Meta[] $metas
	 * @property-read non-empty-string|NULL $language
	 * @property-read bool $isHomepage
	 */
	class WebPage
	{
		/** @var WebSite */
		private $website;

		/** @var non-empty-string */
		private $title;

		/** @var Content */
		private $content;

		/** @var Meta[] */
		private $metas;

		/** @var non-empty-string|NULL */
		private $language;

		/** @var bool */
		private $isHomepage;


		/**
		 * @param non-empty-string $title
		 * @param Meta[] $metas
		 * @param non-empty-string|NULL $language
		 * @param bool $isHomepage
		 */
		public function __construct(
			WebSite $website,
			$title,
			Content $content,
			array $metas,
			$language,
			$isHomepage = FALSE
		)
		{
			$this->website = $website;
			$this->title = $title;
			$this->content = $content;
			$this->metas = $metas;
			$this->language = $language;
			$this->isHomepage = $isHomepage;
		}


		/**
		 * @return mixed
		 */
		public function __get(string $prop)
		{
			return $this->{$prop};
		}
	}
