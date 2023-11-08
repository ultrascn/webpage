<?php

	namespace UltraScn\Webpage;

	use Latte\Runtime\HtmlStringable;
	use Nette\Utils\IHtmlString;


	interface ContentBlock
	{
		/**
		 * @return IHtmlString|HtmlStringable
		 */
		function toHtml();
	}
