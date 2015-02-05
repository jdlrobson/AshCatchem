<?php

/**
 * CollectionsList.php
 */

/**
 * A list of collections, which are represented by the Collection class.
 */
class CollectionsList implements IteratorAggregate {

	/**
	 * Creates a list of collection cards
	 * @param User $user collection list owner
	 */
	public function __construct( $user ) {
		// Get watchlist collection
		$watchlist = new Collection(
			$user,
			wfMessage( 'mobile-frontend-collection-watchlist-title' ),
			wfMessage( 'mobile-frontend-collection-watchlist-description' )
		);
		$watchlist->load( new WatchlistCollectionStore( $user ) );

		$this->add( $watchlist );

		// FIXME: Add from UserCollectionStore
	}

	/**
	 * The internal list of collection cards.
	 */
	protected $lists = array();

	/**
	 * Adds a page to the collection.
	 *
	 * @param Collection $collection
	 */
	public function add( Collection $collection ) {
		$this->lists[] = $collection;
	}

	/**
	 * Gets the iterator for the internal array
	 * @return ArrayIterator
	 */
	public function getIterator() {
		return new ArrayIterator( $this->lists );
	}
}
