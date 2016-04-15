<?php
/**
 * This file represents a special Product Price.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @since 0.1.2
 */
namespace ep6;
/**
 * This is the class for prices which belongs to a product.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @package ep6
 * @see ErrorReporting This trait gives the error reporting functionality.
 * @since 0.1.2
 * @subpackage Shopobjects\Price
 */
class ProductPrice extends Price {

	use ErrorReporting;

	/** @var String|null The refered product ID. */
	private $productID = null;

	/** @var ProductPriceType|null The type of price. */
	private $type = null;

	/**
	 * This is the constructor of the Product Price object.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param String $productID The product ID to which this price belongs.
	 * @param ProductPriceType $type The type of the product price.
	 * @param mixed[] $priceParameter The price parameter.
	 * @since 0.1.2
	 */
	public function __construct($productID, $type, $priceParameter) {

		// if the first parameter is no product ID
		if (!InputValidator::isProductID($productID)) {

			Logger::warning("ep6\ProductPrice\nNew product price has no product ID (" .$type . "," . $priceParameter . ").");
			$this->errorSet("PP-1");
			return;
		}

		$this->productID = $productID;
		$this->type = $type;
		parent::__construct($priceParameter);
	}

	/**
	 * Prints the Product Price object as a string.
	 *
	 * This function returns the setted attributes of the Product Price object.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @return String The Product Price as a string.
	 * @since 0.1.2
	 */
	public function __toString() {

		return "<strong>Product ID:</strong>" . $this->productID . "<br/>" .
				"<strong>Amount:</strong> " . $this->amount . "<br/>" .
				"<strong>Tax type:</strong> " . $this->taxType . "<br/>" .
				"<strong>Currency:</strong> " . $this->currency . "<br/>" .
				"<strong>Formatted:</strong> " . $this->formatted . "<br/>";
	}

	/**
	 * Sets an the amount of a product price.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param float $amount The new amount of price.
	 * @since 0.1.2
	 */
	public function setAmount($amount) {

		$this->errorReset();

		$allowedTypes = array(ProductPriceTypes::PRICE, ProductPriceTypes::MANUFACTURER, ProductPriceTypes::ECOPARTICIPATION, ProductPriceTypes::DEPOSIT);

		// if parameter is no float
		if (!InputValidator::isFloat($amount)) {

			$this->errorSet("PP-2");
			Logger::warning("ep6\ProductPrice\nAmount for product price (" . $amount . ") is not a float.");
			return;
		}

		// if PATCH does not work
		if (!RESTClient::setRequestMethod("PATCH")) {

			$this->errorSet("RESTC-9");
			return;
		}

		// if this operation is not allowed for this price type
		if (InputValidator::isEmptyArrayKey($allowedTypes, $this->type)) {

			$this->errorSet("PP-3");
			Logger::warning("ep6\ProductPrice\nChanging product price is not allowed for this " . $this->type . " product price method.");
			return;
		}

		$parameter = array("op" => "add", "path" => "/priceInfo/" . $this->type . "/amount", "value" => $amount);
		RESTClient::send("product/" . $this->productID, $parameter);
	}

	/**
	 * Unsets the amount of a product price.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @since 0.1.2
	 */
	public function unsetAmount() {

		$this->errorReset();

		$allowedTypes = array(ProductPriceTypes::PRICE, ProductPriceTypes::MANUFACTURER, ProductPriceTypes::ECOPARTICIPATION, ProductPriceTypes::DEPOSIT);

		// if PATCH does not work
		if (!RESTClient::setRequestMethod("PATCH")) {

			$this->errorSet("RESTC-9");
			return;
		}

		// if this operation is not allowed for this price type
		if (InputValidator::isEmptyArrayKey($allowedTypes, $this->type)) {

			$this->errorSet("PP-3");
			Logger::warning("ep6\ProductPrice\nChanging product price is not allowed for this " . $this->type . " product price method.");
			return;
		}

		$parameter = array("op" => "remove", "path" => "/priceInfo/" . $this->type . "/amount");
		RESTClient::send("product/" . $this->productID, $parameter);
	}
}
?>