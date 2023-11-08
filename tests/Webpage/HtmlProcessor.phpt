<?php

declare(strict_types=1);

use Tester\Assert;
use UltraScn\Webpage;

require __DIR__ . '/../bootstrap.php';


test('Scripts', function () {
	Assert::equal([
		new Webpage\HtmlBlock(new \Latte\Runtime\Html('<h1>Nothing</h1>')),
	], Webpage\HtmlProcessor::processScripts('<h1>Nothing</h1>'));

	Assert::equal([
		new Webpage\HtmlBlock(new \Latte\Runtime\Html('<h1>Nothing</h1>')),
		new Webpage\ComponentBlock('script', [
			0 => 'param',
		]),
		new Webpage\HtmlBlock(new \Latte\Runtime\Html('{{1:}}')),
	], Webpage\HtmlProcessor::processScripts('<h1>Nothing</h1>{{script: param}}{{1:}}'));
});


test('ComponentComments', function () {
	$factory = function ($componentName, $data) {
		return new Webpage\ComponentBlock($componentName, ['data' => $data]);
	};

	Assert::equal([
		new Webpage\HtmlBlock(new \Latte\Runtime\Html('<h1>Nothing</h1>')),
	], Webpage\HtmlProcessor::processComponentComments('<h1>Nothing</h1>', $factory));

	Assert::equal([
		new Webpage\HtmlBlock(new \Latte\Runtime\Html('<h1>Nothing</h1>')),
		new Webpage\ComponentBlock('block:script', [
			'data' => 'param data',
		]),
		new Webpage\ComponentBlock('inline:script2', [
			'data' => 'data2',
		]),
	], Webpage\HtmlProcessor::processComponentComments('<h1>Nothing</h1><!-- componentBlock({"type": "script", "data": "param data"}) --><!-- componentInline({"type": "script2", "data": "data2"}) -->', $factory));
});


test('Parameters', function () {
	Assert::same([
		0 => 'param',
		1 => 'param2',
	], Webpage\HtmlProcessor::parseParameters('param, param2'));

	Assert::same([
		'param' => '10',
		0 => 'param2',
		'nullable' => NULL,
		'nullable2' => NULL,
	], Webpage\HtmlProcessor::parseParameters('param=10, param2, nullable=, nullable2=NuLL'));
});
