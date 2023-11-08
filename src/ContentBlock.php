<?php

	declare(strict_types=1);

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
