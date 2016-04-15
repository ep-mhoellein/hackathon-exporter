<?php
namespace ep6;
/**
 * The Log Output 'enum'.
 *
 * Use this to define where the log messages should be printed.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @package ep6
 * @since 0.0.1
 * @since 0.1.2
 * @subpackage Util\Logger
 */
abstract class LogOutput {
	/** @var String Use this for print something on the screen. **/
	const SCREEN = "SCREEN";
	/** @var String Use this for print something on the screen. **/
	const FILE = "FILE";
}
?>