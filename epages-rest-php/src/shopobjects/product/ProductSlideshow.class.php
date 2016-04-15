<?php
/**
 * This file represents the Product Slideshow class.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @since 0.1.0
 */
namespace ep6;
/**
 * This is the product slideshow class which saves all images of the slideshow.
 *
 * @author David Pauli <contact@david-pauli.de>
 * @package ep6
 * @since 0.1.0
 * @since 0.1.1 Can print the object itself.
 * @since 0.1.1 Delete functionality to reload itself.
 * @since 0.1.1 Use unstatic objects.
 * @since 0.1.2 Add error reporting.
 * @subpackage Shopobjects\Product
 */
class ProductSlideshow {

	use ErrorReporting;

	/** @var String The REST path to the product slideshow ressource. */
	const RESTPATH = "slideshow";

	/** @var Image[] The space for the images.
	 *
	 * It is saved like:
	 *   [0]
	 *     [Thumbnail]
	 *     [Small]
	 *     [...]
	 *   [1]
	 *     [...]
	 */
	private $images = array();

	/**
	 * Constructor of the Slideshow.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param String $productID The product ID to get images.
	 * @since 0.1.0
	 */
	public function __construct($productID) {

		$this->load($productID);
	}

	/**
	 * Prints the Product slideshow object as a string.
	 *
	 * This function returns the setted values of the Product slideshow object.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @return String The Product slideshow as a string.
	 * @since 0.1.1
	 */
	public function __toString() {

		return "<strong>Images:</strong> " . print_r($this->images) . "<br/>";
	}

	/**
	 * Gets the number of available images.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @return int The number of images.
	 * @since 0.1.0
	 * @since 0.1.2 Add error reporting.
	 */
	public function getCountImages() {

		$this->errorReset();

		if (InputValidator::isEmpty($this->images)) {

			return 0;
		}

		return sizeof($this->images);
	}

	/**
	 * Returns a hotdeal image.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param int $image The image number to get
	 * @return Image|null The hotdeal image.
	 * @since 0.1.0
	 * @since 0.1.1 Fix bug with returning image.
	 * @since 0.1.2 Add error reporting and easy the function.
	 */
	public function getHotDealImage($image) {

		$this->errorReset();

		return $this->getImage($image, "HotDeal");
	}

	/**
	 * Returns a large image.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param int $image The image number to get
	 * @return Image|null The large image.
	 * @since 0.1.0
	 * @since 0.1.1 Fix bug with returning image.
	 * @since 0.1.2 Add error reporting and easy the function.
	 */
	public function getLargeImage($image) {

		$this->errorReset();

		return $this->getImage($image, "Large");
	}

	/**
	 * Returns a medium large image.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param int $image The image number to get
	 * @return Image|null The medium large image.
	 * @since 0.1.0
	 * @since 0.1.1 Fix bug with returning image.
	 * @since 0.1.2 Add error reporting and easy the function.
	 */
	public function getMediumLargeImage($image) {

		$this->errorReset();

		return $this->getImage($image, "MediumLarge");
	}

	/**
	 * Returns a medium image.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param int $image The image number to get
	 * @return Image|null The medium image.
	 * @since 0.1.0
	 * @since 0.1.1 Fix bug with returning image.
	 * @since 0.1.2 Add error reporting and easy the function.
	 */
	public function getMediumImage($image) {

		$this->errorReset();

		return $this->getImage($image, "Medium");
	}

	/**
	 * Returns a medium small image.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param int $image The image number to get
	 * @return Image|null The medium small image.
	 * @since 0.1.0
	 * @since 0.1.1 Fix bug with returning image.
	 * @since 0.1.2 Add error reporting and easy the function.
	 */
	public function getMediumSmallImage($image) {

		$this->errorReset();

		return $this->getImage($image, "MediumSmall");
	}

	/**
	 * Returns a small image.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param int $image The image number to get
	 * @return Image|null The small image.
	 * @since 0.1.0
	 * @since 0.1.1 Fix bug with returning image.
	 * @since 0.1.2 Add error reporting and easy the function.
	 */
	public function getSmallImage($image) {

		$this->errorReset();

		return $this->getImage($image, "Small");
	}

	/**
	 * Returns a small image.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param int $image The image number to get
	 * @return Image|null The small image.
	 * @since 0.1.0
	 * @since 0.1.1 Fix bug with returning image.
	 * @since 0.1.2 Add error reporting and easy the function.
	 */
	public function getThumbnailImage($image) {

		$this->errorReset();

		return $this->getImage($image, "Thumbnail");
	}

	/**
	 * Basic function to return an image.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param int $image The image number to get
	 * @param String $type The type of the image.
	 * @return Image|null The thumbnail image.
	 * @since 0.1.2
	 */
	private function getImage($image, $type) {

		if ($this->getCountImages() == 0 ||
			!InputValidator::isRangedInt($image, 0, $this->getCountImages() - 1) ||
			InputValidator::isEmptyArrayKey($this->images[$image], $type)) {

			$reason = $this->getCountImages() == 0 ? "noImages" :
						(!InputValidator::isRangedInt($image, 0, $this->getCountImages() - 1)) ? "IDunknown" :
						"imageCorrupt";

			switch ($reason) {

				case "noImages":
					$this->errorSet("PS-4");
					Logger::warning("ep6\ProductSlideshow\nThere are no slideshow images.");
					break;

				case "IDunknown":
					$this->errorSet("PS-5");
					Logger::warning("ep6\ProductSlideshow\nThe slideshow image number is unknown.");
					break;

				case "imageCorrupt":
					$this->errorSet("PS-6");
					Logger::warning("ep6\ProductSlideshow\nThe required slideshow image exists but is empty.");
					break;
			}

			return null;
		}

		return $this->images[$image][$type];
	}


	/**
	 * This function gets the product images.
	 *
	 * @author David Pauli <contact@david-pauli.de>
	 * @param String $productID The product ID to get images.
	 * @since 0.1.0
	 * @since 0.1.1 Fix bug with nonsetted product URL and delete reload functionality.
	 * @since 0.1.1 Use unstatic variables.
	 * @since 0.1.2 Add error reporting.
	 */
	private function load($productID) {

		// if parameter is wrong
		if (!InputValidator::isProductId($productID)) {

			$this->errorSet("PS-1");
			Logger::warning("ep6\ProductSlideshow\nInvalid product ID " . $productId . " to load slideshow.");
			return;
		}

		// if GET is blocked
		if (!RESTClient::setRequestMethod(HTTPRequestMethod::GET)) {

			$this->errorSet("RESTC-9");
			return;
		}

		$content = RESTClient::send("products/" . $productID . "/" . self::RESTPATH);

		// if respond is empty
		if (InputValidator::isEmpty($content)) {

			$this->errorSet("PS-2");
			Logger::warning("ep6\ProductSlideshow\nEmpty response while getting product slideshow.");
			return;
		}

		// if there is items
		if (InputValidator::isEmptyArrayKey($content, "items")) {

			$this->errorSet("PS-3");
		    Logger::error("Respond for product slidehows can not be interpreted.");
			return;
		}

		// is there any images found: load the images.
		foreach ($content['items'] as $number => $image) {

			// parse every image size
			if (!InputValidator::isEmptyArrayKey($image, "sizes")) {

				$object = null;
				foreach ($image["sizes"] as $size) {

					// if there is "url" and "classifier" set in the image
					if (!InputValidator::isEmptyArrayKey($size, "url") &&
						!InputValidator::isEmptyArrayKey($size, "classifier")) {

						$object[$size["classifier"]] = $size["url"];
					}
				}

				// if all needed sizes are available, save it
				if (!InputValidator::isEmptyArrayKey($object, "Thumbnail") &&
					!InputValidator::isEmptyArrayKey($object, "Small") &&
					!InputValidator::isEmptyArrayKey($object, "HotDeal") &&
					!InputValidator::isEmptyArrayKey($object, "MediumSmall") &&
					!InputValidator::isEmptyArrayKey($object, "Medium") &&
					!InputValidator::isEmptyArrayKey($object, "MediumLarge") &&
					!InputValidator::isEmptyArrayKey($object, "Large")) {

					array_push($this->images, $object);
				}
			}
		}
	}
}
?>