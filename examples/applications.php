<?php

require(__DIR__.'/../api_key.php');
require (__DIR__.'/../vendor/autoload.php');

use Vultr\VultrPhp\VultrClient;
use Vultr\VultrPhp\Util\ListOptions;
use Vultr\VultrPhp\Applications\ApplicationService;

$client = VultrClient::create(API_KEY);

$apps = [];
$options = new ListOptions(10);
while (true)
{
	foreach ($client->applications->getApplications(ApplicationService::FILTER_ALL, $options) as $app)
	{
		$apps[] = $app;
	}

	if ($options->getNextCursor() == '')
	{
		break;
	}
	$options->setCurrentCursor($options->getNextCursor());
}

var_dump($options);
var_dump($apps);
