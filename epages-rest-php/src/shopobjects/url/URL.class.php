<?php
/**
 * This file represents the URL class.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @since 0.1.3
 */
namespace ep6;
/**
 * This is the URL class which is used for URLs.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @package ep6
 * @since 0.1.3
 * @subpackage Shopobjects\URL
 */
class URL {

	/** @var string This is the path to the URL. */
	private $URL = null;

	/**
	 * To create a new URL object use this constructor with the original URL.
	 *
 	 * @author David Pauli <contact@david-pauli.de>
	 * @param String $url The path of the URL.
 	 * @since 0.1.3
	 */
	public function __construct($url) {

		$this->URL = $url;
	}

	/**
	 * Prints the URL object as a string.
	 *
	 * This function returns the setted values of the URL object.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @return String The URL as a string.
	 * @since 0.1.3
	 */
	public function __toString() {

		return "<strong>URL:</strong> " . $this->URL . "<br/>";
	}

	/**
	 * Gets the path of the URL.
	 *
 	 * @author David Pauli <contact@david-pauli.de>
	 * @return String The full path.
 	 * @since 0.1.3
	 */
	public function getURL() {

		return $this->URL;
	}
}