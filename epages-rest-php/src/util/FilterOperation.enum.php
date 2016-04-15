<?php
namespace ep6;
/**
 * The Filter Operation 'enum'.
 *
 * This are the possible Filter Operations.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @package ep6
 * @since 0.1.3
 * @subpackage Util\FilterOperation
 */
abstract class FilterOperation {
	/** @var String Check if the attribute is equals. **/
	const EQUALS = "=";
	/** @var String Check if the attribute is greater. **/
	const GREATER = ">";
	/** @var String Check if the attribute is lower. **/
	const LOWER = "<";
	/** @var String Check if the attribute is greater or equals. **/
	const GREATER_EQUALS = ">=";
	/** @var String Check if the attribute is lower or equals. **/
	const LOWER_EQUALS = "<=";
	/** @var String Check if the attribute is contains something. **/
	const CONTAINS = "contains";
	/** @var String Check if the attribute is not containing. **/
	const NOT_CONTAINS = "notContains";
	/** @var String Check if the attribute starts with. **/
	const STARTS_WITH = "startsWith";
	/** @var String Check if the attribute ends with. **/
	const ENDS_WITH = "endsWith";
	/** @var String Undefined value. **/
	const UNDEF = "undef";
}
?>