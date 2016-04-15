<?php
namespace ep6;
/**
 * The HTTP Request 'enum'.
 *
 * This are the possible HTTP Request Methods.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @package ep6
 * @since 0.0.1
 * @subpackage Util\RESTClient
 */
abstract class HTTPRequestMethod {
	/** @var String Use this for a GET request. **/
	const GET = "GET";
	/** @var String Use this for a POST request. **/
	const POST = "POST";
	/** @var String Use this for a PUT request. **/
	const PUT = "PUT";
	/** @var String Use this for a DELETE request. **/
	const DELETE = "DELETE";
	/** @var String Use this for a PATCH request. **/
	const PATCH = "PATCH";
}
?>