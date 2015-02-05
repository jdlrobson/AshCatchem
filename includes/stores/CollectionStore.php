<?php
/**
 * Abstraction for collection storage.
 */
abstract class CollectionStore {
	/**
	 * Get titles of all pages in the current collection.
	 * @return Array titles
	 */
	abstract public function getTitles();
}
