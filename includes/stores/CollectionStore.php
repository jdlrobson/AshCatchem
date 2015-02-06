<?php
/**
 * Abstraction for collection storage.
 */
abstract class CollectionStore {
	/**
	 * Get titles of all pages in the current collection.
	 *
	 * @return array titles
	 */
	abstract public function getTitles();

	/**
	 * Get current collection identifier
	 *
	 * @return int id
	 */
	abstract public function getId();
}
