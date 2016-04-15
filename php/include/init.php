<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("../epages-rest-php/src/Shop.class.php");
#$shop = new ep6\Shop("royals.epages.com", "Hackathon", "I4UqHzGdLa5OMgMv4tZzMb3njoU4QQM6", true);
$shop = new ep6\Shop("sandbox.epages.com", "Hackathon03", "wmnD25OzrE0IM6ct6Qge9YMfrsiY3sZX", true);
ep6\Logger::setLogLevel(ep6\LogLevel::NONE);
ep6\Logger::setOutput(ep6\LogOutput::FILE);
ep6\Logger::setOutputFile('/var/www/html/output.log');
?>