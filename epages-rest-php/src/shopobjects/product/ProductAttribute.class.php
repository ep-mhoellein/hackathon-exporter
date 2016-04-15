<?php
/**
 * This file represents the Product Attribute class.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @since 0.1.0
 */
namespace ep6;
/**
 * This is the Product Attribute class which saves all attributes of a product.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @package ep6
 * @since 0.1.0
 * @since 0.1.1 The object can be echoed.
 * @subpackage Shopobjects\Product
 */
class ProductAttribute {

	/** @var String|null The intern name of this attribute. */
	private $internName = null;

	/** @var String|null The written name of this attribute. */
	private $name = null;

	/** @var boolean Can only be set one value. */
	private $oneValue = false;

	/** @var String|null The type of the product attribute value. */
	private $type = null;

	/** @var String[] Space for saving the possible attribute values. */
	private $values = array();

	/**
	 * This function gets the product attributes.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param mixed[] $attribute The attribute in an array.
	 * @since 0.1.0
	 */
	public function __construct($attribute) {

		if (!InputValidator::isEmptyArrayKey($attribute, "key")) {

			$this->internName = $attribute["key"];
		}

		if (!InputValidator::isEmptyArrayKey($attribute, "displayKey")) {

			$this->name = $attribute["displayKey"];
		}

		if (!InputValidator::isEmptyArrayKey($attribute, "singleValue")) {

			$this->oneValue = $attribute["singleValue"];
		}

		if (!InputValidator::isEmptyArrayKey($attribute, "type")) {

			$this->type = $attribute["type"];
		}

		if (!InputValidator::isEmptyArrayKey($attribute, "type") &&
			!InputValidator::isArray($attribute["values"])) {

			foreach ($attribute["values"] as $key => $value) {

				if (!InputValidator::isEmptyArrayKey($value, "value") &&
					!InputValidator::isEmptyArrayKey($value, "displayValue")) {

					$this->values[$value["value"]] = $value["displayValue"];
				}
			}
		}
	}

	/**
	 * Prints the Product attribute object as a string.
	 *
	 * This function returns the setted values of the Product attribute object.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @return String The Product attribute as a string.
	 * @since 0.1.1
	 */
	public function __toString() {

		return "<strong>Internal name:</strong> " . $this->internName . "<br/>" .
				"<strong>Name:</strong> " . $this->name . "<br/>" .
				"<strong>Can have only one value:</strong> " . $this->oneValue . "<br/>" .
				"<strong>Value type:</strong> " . $this->type . "<br/>" .
				"<strong>Values:</strong> " . print_r($this->values) . "<br/>";
	}

	/**
	 * Returns the intern name of the attribute.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @return String|null The intern name of the attribute.
	 * @since 0.1.0
	 */
	public function getInternName() {

		return $this->internName;
	}

	/**
	 * Returns the name of the attribute.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @return String|null The name of the attribute.
	 * @since 0.1.0
	 */
	public function getName() {

		return $this->name;
	}

	/**
	 * Returns the type of the attribute value.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @return String|null The type of the attribute value, like String or int.
	 * @since 0.1.0
	 */
	public function getType() {

		return $this->type;
	}

	/**
	 * Returns the possible values of this attribute.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @return String[] Array of possible values of this attribute.
	 * @since 0.1.0
	 */
	public function getValues() {

		return $this->values;
	}

	/**
	 * Returns whether the attribute can one has one value.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @return boolean True, if the attribute can only have one value.
	 * @since 0.1.0
	 */
	public function isOneValue() {

		return $this->isOneValue;
	}
}
?>