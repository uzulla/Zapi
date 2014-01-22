<?php
require "../../vendor/autoload.php";
require "../config.php";
require "../lib/autoload.php";

\Uzulla\Error::strict();
\Uzulla\Error::setDisplayFatalError();
\Uzulla\Error::setConvertErrorToException();

(new \Sample\Dispatcher())->run();

