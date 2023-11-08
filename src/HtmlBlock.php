<?php

	declare(strict_types=1);

	namespace UltraScn\Webpage;

	use Latte\Runtime\HtmlStringable;
	use Nette\Utils\IHtmlString;


	class HtmlBlock implements ContentBlock
	{
		/** @var IHtmlString|HtmlStringable */
		private $html;


		/**
		 * @param IHtmlString|HtmlStringable $html
		 */
		public function __construct($html)
		{
			$this->html = $html;
		}


		public function toHtml()
		{
			return $this->html;
		}
	}
