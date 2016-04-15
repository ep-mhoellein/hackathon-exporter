<?php
namespace ep6;
/**
 * The Price Tax Model 'enum'.
 *
 * This are the possible Price Tax Model.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @package ep6
 * @since 0.1.3
 * @subpackage Shobojects\Price
 */
abstract class PriceTaxModel {
	/** @var String The gross price. **/
	const GROSS = "GROSS";
	/** @var String The net price. **/
	const NET = "NET";
}
?>