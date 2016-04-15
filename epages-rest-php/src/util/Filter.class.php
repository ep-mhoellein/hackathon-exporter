<?php
/**
 * This file represents the Filter class.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @since 0.1.3
 */
namespace ep6;
/**
 * This is a filter class to filter several shop objects.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @package ep6
 * @since 0.1.3
 * @subpackage Util\Filter
 */
class Filter {

	/** @var String The attribute to filter. */
	private $attribute = null;

	/** @var String The value to compare. */
	private $value = null;

	/** @var FilterOperation The operation to check the attribute and the value. */
	private $operator = null;

	/** @var  */
	private $type = null;

	/**
	 * The constructor of the Filter object.
	 *
	 * @param mixed[] $filterParameter The array to setup the filter.
	 * @since 0.1.3
	 */
	public function __construct($filterParameter) {

		$this->attribute = $filterParameter['attribute'];
		$this->value = $filterParameter['value'];
		$this->operator = $filterParameter['operator'];
		$this->type = $filterParameter['type'];
	}

	/**
	 * The function to get the filter attribute.
	 *
	 * @return String Returns the attribute.
	 * @since 0.1.3
	 */
	public function getAttribute() {
		return $this->attribute;
	}

	/**
	 * The function to get the filter value.
	 *
	 * @return String Returns the value.
	 * @since 0.1.3
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * The function to get the filter operator.
	 *
	 * @return FilterOperation Returns the operation of the filter.
	 * @since 0.1.3
	 */
	public function getOperator() {
		return $this->operator;
	}

	/**
	 * The function check wether the item matchs with the filter.
	 *
	 * @param mixed[] $item The array with the attribute as key.
	 * @return boolean True, if the attribute has this item, false if not.
	 * @since 0.1.3
	 */
	public function isElementInFilter($item) {

		if (is_null($item[$this->attribute]) && $this->operator != FilterOperation::UNDEF) {
			return false;
		}

		if ($this->type == "bool") {

			$item[$this->attribute] = $item[$this->attribute] == "" ? "false" : "true";
		}

		switch ($this->operator) {

			case FilterOperation::EQUALS:
				if($item[$this->attribute] != $this->value) {
					return false;
				}
				break;
			case FilterOperation::GREATER:
				if($item[$this->attribute] <= $this->value) {
					return false;
				}
				break;
			case FilterOperation::LOWER:
				if($item[$this->attribute] >= $this->value) {
					return false;
				}
				break;
			case FilterOperation::GREATER_EQUALS:
				if($item[$this->attribute] < $this->value) {
					return false;
				}
				break;
			case FilterOperation::LOWER_EQUALS:
				if($item[$this->attribute] > $this->value) {
					return false;
				}
				break;
			case FilterOperation::CONTAINS:
				if(!preg_match("/" . $this->value ."/", $item[$this->attribute])) {
					return false;
				}
				break;
			case FilterOperation::NOT_CONTAINS:
				if(preg_match("/" . $this->value ."/", $item[$this->attribute])) {
					return false;
				}
				break;
			case FilterOperation::STARTS_WITH:
				if(!preg_match("/^" . $this->value ."/", $item[$this->attribute])) {
					return false;
				}
				break;
			case FilterOperation::ENDS_WITH:
				if(!preg_match("/" . $this->value ."$/", $item[$this->attribute])) {
					return false;
				}
				break;
			case FilterOperation::UNDEF:
				if(!is_null($item[$this->attribute])) {
					return false;
				}
				break;
			default:
				return false;
		}
		return true;
	}
}

?>