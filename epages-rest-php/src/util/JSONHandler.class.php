<?php
/**
 * This file represents the JSON Handler class.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @since 0.0.0
 */
namespace ep6;
/**
 * This is a small simple handler to convert JSON into an array and otherwise.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @package ep6
 * @since 0.0.0
 * @since 0.1.2 Add error reporting.
 * @subpackage Util
 */
class JSONHandler {

	use ErrorReporting;

	/**
	 * Call this function to create a JSON string from a array.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param mixed[] $array The array to make a JSON.
	 * @return String The JSON string.
	 * @since 0.0.0
	 * @since 0.1.2 Extend the encoding with avoid encode slashes.
	 * @since 0.1.2 Better the warnings.
	 * @since 0.1.2 Add error reporting.
	 */
	public static function createJSON($array) {

		self::errorReset();

		if (!InputValidator::isArray($array)) {

			Logger::warning("ep6\JSONHandler\nArray (" . $array . ") is not valid.");
			self::errorSet("JSONH-3");
			return null;
		}

		$result = json_encode($array, JSON_UNESCAPED_SLASHES);

		if (!InputValidator::isJSON($result)) {

			Logger::warning("ep6\JSONHandler\nThere is an error with creating a JSON with the array (" . $array . "): " . json_last_error() . ": " . json_last_error_msg());
			self::errorSet("JSONH-4");
			return null;
		}

		return $result;
	}

	/**
	 * Call this function with the JSON in parameter.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param String $JSON The JSON string to parse.
	 * @return mixed[] The array of the JSON element or null if there is an error.
	 * @since 0.0.0
	 * @since 0.1.2 Better the warnings.
	 * @since 0.1.2 Add error reporting.
	 */
	public static function parseJSON($JSON) {

		self::errorReset();

		if (!InputValidator::isJSON($JSON)) {

			Logger::warning("ep6\JSONHandler\nJSON string (" . $JSON . ") is not valid.");
			self::errorSet("JSONH-1");
			return array();
		}

		$result = json_decode($JSON, true);

		if (!InputValidator::isArray($result)) {

			Logger::warning("ep6\JSONHandler\nThere is an error with parsing the follwing JSON (" . $JSON . "): " . json_last_error() . ": " . json_last_error_msg());
			self::errorSet("JSONH-2");
			return array();
		}

		return $result;
	}
}
?>