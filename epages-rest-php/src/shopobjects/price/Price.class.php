<?php
/**
 * This file represents the Price class.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @since 0.0.0
 */
namespace ep6;
/**
 * This is the class for Price objects.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @package ep6
 * @since 0.0.0
 * @since 0.1.1 This object is echoable.
 * @since 0.1.1 Set attribute to protected to use it in the child classes.
 * @since 0.1.1 Add formatted attribute.
 * @subpackage Shopobjects\Price
 */
class Price {

	/** @var float The amount of the price. */
	protected $amount = 0.0;

	/** @var String|null The curreny of the price. */
	protected $currency = null;

	/** @var String|null The formatted price with currency. */
	protected $formatted = null;

	/** @var PriceTaxModel|null The tax type of the price. */
	protected $taxType = null;

	/**
	 * This is the constructor of the Price object.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param mixed[] $priceParamter The price parameter to create the Price object.
	 * @since 0.0.0
	 * @since 0.1.0 Add functionality to construct.
	 * @since 0.1.1 Parse formatted attribute.
	 */
	public function __construct($priceParameter) {

		if (InputValidator::isArray($priceParameter)) {

			if (!InputValidator::isEmptyArrayKey($priceParameter, "amount")) {

				$this->amount = $priceParameter['amount'];
			}

			if (!InputValidator::isEmptyArrayKey($priceParameter, "taxType")) {

				if ($priceParameter['taxType'] == "GROSS") {
					$this->taxType = PriceTaxModel::GROSS;
				}
				else {
					$this->taxType = PriceTaxModel::NET;
				}
			}

			if (!InputValidator::isEmptyArrayKey($priceParameter, "currency")) {

				$this->currency = $priceParameter['currency'];
			}

			if (!InputValidator::isEmptyArrayKey($priceParameter, "formatted")) {

				$this->formatted = $priceParameter['formatted'];
			}
		}
	}

	/**
	 * Prints the Price object as a string.
	 *
	 * This function returns the setted attributes of the Price object.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @since 0.1.1
	 * @return String The Price as a string.
	 */
	public function __toString() {

		return "<strong>Amount:</strong> " . $this->amount . "<br/>" .
				"<strong>Tax type:</strong> " . $this->taxType . "<br/>" .
				"<strong>Currency:</strong> " . $this->currency . "<br/>" .
				"<strong>Formatted:</strong> " . $this->formatted . "<br/>";
	}

	/**
	 * Returns the amount.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @return float Gets the amount.
	 * @since 0.1.0
	 */
	public function getAmount() {

		return $this->amount;
	}

	/**
	 * Returns the currency.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @return String Gets the currency.
	 * @since 0.1.0
	 */
	public function getCurrency() {

		return $this->currency;
	}

	/**
	 * Returns the formatted price with currency.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @since 0.1.1
	 * @api
	 * @return String Returns the price with currency formatted.
	 */
	public function getFormatted() {

		return $this->formatted;
	}

	/**
	 * Returns the tax type.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @return PriceTaxModel Gets the tax type.
	 * @since 0.1.0
	 */
	public function getTaxType() {

		return $this->taxType;
	}
}
?>