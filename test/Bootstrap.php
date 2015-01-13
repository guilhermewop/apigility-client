<?php
namespace ApigilityClientTest;

use ApigilityClientTest\Utils\Bootstrap;

// enable all error reporting
error_reporting(E_ALL | E_STRICT);

// require Bootstrap class
require __DIR__.'/ApigilityClientTest/Utils/Bootstrap.php';

// init Boostrap class
Bootstrap::init();

// Trick ZF2 into thinking this is all being executed in the browser.
\Zend\Console\Console::overrideIsConsole(false);
