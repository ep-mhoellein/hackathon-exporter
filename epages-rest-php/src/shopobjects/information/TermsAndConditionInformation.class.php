<?php
/**
 * This file represents the Terms And Condition Information class.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @since 0.0.0
 */
namespace ep6;
/**
 * This class is required for showing the information of Terms And Condition.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @package ep6
 * @see InformationTrait This trait has all information needed objects.
 * @see ErrorReporting This trait gives the error reporting functionality.
 * @since 0.0.0
 * @since 0.1.1 This object is now echoable.
 * @since 0.1.1 Unstatic every attributes.
 * @since 0.1.2 Add error reporting.
 * @subpackage Shopobjects\Information
 */
class TermsAndConditionInformation {

	use Information, ErrorReporting;

	/** @var String The REST path for terms and condition. */
	const RESTPATH = "legal/terms-and-conditions";

	/** @var int Timestamp in ms when the next request needs to be done. */
	private $NEXT_REQUEST_TIMESTAMP = 0;

}
?>