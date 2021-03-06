<?php

/**
 * CollectionsList.php
 */

/**
 * A list of collections, which are represented by the Collection class.
 */
class CollectionsList implements IteratorAggregate {
	protected $includePrivate;

	/**
	 * Creates a list of collection cards
	 * @param User $user collection list owner
	 * @param boolean $includePrivate if the list can show private collections or not
	 */
	public function __construct( $user, $includePrivate = false ) {
		$this->includePrivate = $includePrivate;

		// Get watchlist collection (private)
		// Directly avoid adding if not owner
		if ( $includePrivate ) {
			$watchlist = new Collection(
				$user,
				wfMessage( 'mobile-frontend-collection-watchlist-title' ),
				wfMessage( 'mobile-frontend-collection-watchlist-description' ),
				false
			);
			$watchlist->load( new WatchlistCollectionStore( $user ) );

			$this->add( $watchlist );
		}

		// FIXME: Add from UserCollectionStore
	}

	/**
	 * The internal list of collection cards.
	 */
	protected $lists = array();

	/**
	 * Adds a page to the collection.
	 * If the collection to add is private, and this collection list does not include
	 * private items, the collection won't be added
	 *
	 * @param Collection $collection
	 */
	public function add( Collection $collection ) {
		if ( $this->includePrivate ||
			( !$this->includePrivate && $collection->isPublic() ) ) {
			$this->lists[] = $collection;
		}
	}

	/**
	 * Gets the iterator for the internal array
	 * @return ArrayIterator
	 */
	public function getIterator() {
		return new ArrayIterator( $this->lists );
	}
}
