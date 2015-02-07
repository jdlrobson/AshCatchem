<?php

/**
 * Collection.php
 */

/**
 * A collection of pages, which are represented by the MobilePage class.
 */
class Collection implements IteratorAggregate {
	protected $user, $title, $description, $public;

	/**
	 * @param User $user that owns the collection
	 * @param string $title
	 * @param string $description
	 */
	public function __construct( User $user, $title = '', $description = '', $public = true ) {
		$this->user = $user;
		$this->title = $title;
		$this->description = $description;
		$this->public = $public;
	}

	/**
	 * The internal collection of pages.
	 *
	 * @var MobilePage[]
	 */
	protected $pages = array();

	/**
	 * The internal id of a collection
	 *
	 * @var int id
	 */
	protected $id;

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
	 * Returns if the list is public
	 *
	 * @return boolean
	 */
	public function isPublic() {
		return $this->public;
	}

	/**
	 * Set if the list is public
	 *
	 * @param boolean $public
	 */
	public function setPublic( $public ) {
		$this->public = $public;
	}

	/**
	 * Returns internal collection identifier
	 *
	 * @return int collection id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Returns pages count
	 * @return int count of pages in collection
	 */
	public function getCount() {
		return count( $this->pages );
	}

	/**
	 * Return local url for collection
	 * Example: /wiki/Special:Gather/user/id
	 *
	 * @return [type] [description]
	 */
	public function getUrl() {
		return SpecialPage::getTitleFor( 'Gather' )
			->getSubpage( $this->getOwner() )
			->getSubpage( $this->getId() )
			->getLocalURL();
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
		$this->id = $store->getId();
		$titles = $store->getTitles();
		foreach ( $titles as $title ) {
			$this->add( new MobilePage( $title ) );
		}
	}

}
