<?php

declare(strict_types=1);

declare(strict_types=1);

declare(strict_types=1);

use Tester\Assert;
use UltraScn\Webpage;

require __DIR__ . '/../bootstrap.php';


class FooPresenter extends \Nette\Application\UI\Presenter
{
}


class BarControl extends \Nette\Application\UI\Control
{
	/** @var array<string, mixed> */
	public $barParams;


	/**
	 * @param array<string, mixed> $params
	 */
	public function __construct(array $params)
	{
		$this->barParams = $params;
	}
}


test('processBlocks', function () {
	$presenter = new FooPresenter;

	Assert::equal(
		[
			new Webpage\NetteControlBlock('ucofkzoguw1'),
			new Webpage\NetteControlBlock('ucofkzoguw2'),
			new Webpage\ComponentBlock('wrong', []),
		],
		Webpage\NetteControlBlock::injectToPresenter(
			[
				new Webpage\ComponentBlock('right', ['param' => 1]),
				new Webpage\ComponentBlock('right', []),
				new Webpage\ComponentBlock('wrong', []),
			],
			$presenter,
			[
				'right' => function ($params) {
					return new BarControl($params);
				}
			]
		)
	);

	Assert::type(BarControl::class, $presenter['ucofkzoguw1']);
	Assert::type(BarControl::class, $presenter['ucofkzoguw2']);
});
