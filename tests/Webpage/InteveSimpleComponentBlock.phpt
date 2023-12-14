<?php

declare(strict_types=1);

use Tester\Assert;
use UltraScn\Webpage;

require __DIR__ . '/../bootstrap.php';


test('processBlocks', function () {
	Assert::equal(
		[
			new Webpage\InteveSimpleComponentBlock('rightComponent', [
				'test' => 'right',
				'added' => 1,
			]),
			new Webpage\ComponentBlock('wrong', []),
		],
		Webpage\InteveSimpleComponentBlock::processBlocks(
			[
				new Webpage\ComponentBlock('right', ['test' => 'right']),
				new Webpage\ComponentBlock('wrong', []),
			],
			[
				'right' => function ($params) {
					$params['added'] = 1;
					return new Webpage\InteveSimpleComponentBlock('rightComponent', $params);
				}
			]
		)
	);
});
