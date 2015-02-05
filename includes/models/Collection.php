<?php

/**
 * Collection.php
 */

/**
 * A collection of pages, which are represented by the MobilePage class.
 */
class Collection implements IteratorAggregate {
	protected $user, $title, $description;

	/**
	 * @param User $user that owns the collection
	 * @param string $title
	 * @param string $description
	 */
	public function __construct( User $user, $title = '', $description = '' ) {
		$this->user = $user;
		$this->title = $title;
		$this->description = $description;
	}

	/**
	 * The internal collection of pages.
	 *
	 * @var MobilePage[]
	 */
	protected $pages = array();

	/**
	 * Adds a page to the collection.
	 *
	 * @param MobilePage $page
	 */
	public function add( MobilePage $page ) {
		$this->pages[] = $page;
	}

	/**
	 * Gets the iterator for the internal array
	 *
	 * @return ArrayIterator
	 */
	public function getIterator() {
		return new ArrayIterator( $this->pages );
	}

	/**
	 * @return User
	 */
	public function getOwner() {
		return $this->user;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @return array list of pages
	 */
	public function getPages() {
		return $this->pages;
	}

	/**
	 * Adds an array of titles to the collection
	 *
	 * @param CollectionStore $store
	 */
	public function load( CollectionStore $store ) {
		$titles = $store->getTitles();
		foreach ( $titles as $title ) {
			$this->add( new MobilePage( $title ) );
		}
	}

}
