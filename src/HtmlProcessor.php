<?php

	declare(strict_types=1);

	namespace UltraScn\Webpage;

	use Nette\Utils\Json;
	use Nette\Utils\Strings;


	class HtmlProcessor
	{
		/**
		 * Replaces {{script: arg1=val, arg2=val}} with ComponentBlock
		 * @param  string $html
		 * @return array<ContentBlock>
		 */
		public static function processScripts($html)
		{
			$res = [];
			$parts = Strings::split($html, '#(\{\{(?:[^{][^}]++|[}])+\}\})#U', PREG_SPLIT_NO_EMPTY);

			foreach ($parts as $part) {
				if (($m = Strings::match($part, '#\{\{((?:[^{][^}]++|[}])+)\}\}#U')) && is_array($m) && isset($m[1])) {
					$block = self::parseComponentBlock($m[1]);

					if ($block !== NULL) {
						$res[] = $block;

					} else {
						$res[] = new HtmlBlock(new \Latte\Runtime\Html($part));
					}

				} else {
					$res[] = new HtmlBlock(new \Latte\Runtime\Html($part));
				}
			}

			return $res;
		}


		/**
		 * Replaces <!-- componentBlock({"type": "type", "data": "data"}) --> with ComponentBlock
		 * @param  string $html
		 * @return array<ContentBlock>
		 */
		public static function processComponentComments($html, callable $componentBlockFactory)
		{
			$res = [];
			$parts = Strings::split($html, '#(\\<\\!\\-\\-\\s+.+\\s+\\-\\-\\>)#U', PREG_SPLIT_NO_EMPTY);

			foreach ($parts as $part) {
				$values = NULL;
				$blockType = NULL;

				if (Strings::startsWith($part, '<!-- componentBlock({') && Strings::endsWith($part, '}) -->')) {
					$data = Strings::substring($part, 20, -5);
					$data = stripcslashes($data);
					$values = Json::decode($data, Json::FORCE_ARRAY);
					$blockType = 'block';

				} elseif (Strings::startsWith($part, '<!-- componentInline({') && Strings::endsWith($part, '}) -->')) {
					$data = Strings::substring($part, 21, -5);
					$data = stripcslashes($data);
					$values = Json::decode($data, Json::FORCE_ARRAY);
					$blockType = 'inline';
				}

				$block = NULL;

				if (is_array($values) && isset($values['type'], $values['data']) && is_string($values['type']) && is_string($values['data'])) {
					$block = $componentBlockFactory($blockType . ':' . $values['type'], $values['data']);
				}

				if ($block !== NULL) {
					$res[] = $block;

				} else {
					$res[] = new HtmlBlock(new \Latte\Runtime\Html($part));
				}
			}

			return $res;
		}


		/**
		 * @param  string $cmd
		 * @return ComponentBlock|NULL
		 */
		private static function parseComponentBlock($cmd)
		{
			if (($matches = Strings::match($cmd, '#^([a-z_][a-z0-9_-]*)(?:\s*(?::\s*|\s+)(.*))?$#ui')) && is_array($matches)) {
				return new ComponentBlock($matches[1], isset($matches[2]) ? self::parseParameters($matches[2]) : []);
			}

			return NULL;
		}


		/**
		 * @param  string $raw
		 * @return array<string|int, mixed>
		 */
		public static function parseParameters($raw)
		{
			$parameters = [];
			$args = preg_split('#\s*,\s*#u', $raw);

			if (!is_array($args)) {
				$args = []; // or throw exception?
			}

			foreach ($args as $arg) {
				$argName = NULL;

				if (strpos($arg, '=')) { // pos > 0
					$parts = explode('=', $arg, 2);
					$parts[0] = trim($parts[0]);
					$parts[1] = trim($parts[1]);

					if ($parts[0] !== '') {
						$argName = $parts[0];
						$arg = $parts[1];
					}
				}

				if (strtolower($arg) === 'null' || trim($arg) === '') {
					$arg = NULL;
				}

				if ($argName !== NULL) {
					$parameters[$argName] = $arg;

				} else {
					$parameters[] = $arg;
				}
			}

			return $parameters;
		}
	}
