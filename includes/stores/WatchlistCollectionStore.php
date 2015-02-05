<?php

/**
 * Abstraction for watchlist storage.
 * FIXME: This should live in core and power Special:EditWatchlist
 */
class WatchlistCollectionStore extends CollectionStore {
	/** @var array[Title] $titles*/
	protected $titles = array();

	/**
	 * @inheritdoc
	 */
	public function getTitles() {
		return $this->titles;
	}

	/**
	 * Initialise WatchlistCollectionStore from database
	 *
	 * @param User $user to lookup watchlist members for
	 */
	public function __construct( $user ) {
		$list = array();
		$dbr = wfGetDB( DB_SLAVE );

		$res = $dbr->select(
			'watchlist',
			array( 'wl_namespace', 'wl_title'),
			array(
				'wl_user' => $user->getId(),
				'wl_namespace' => 0,
			),
			__METHOD__,
			array( 'LIMIT' => 50,)
		);

		$titles = array();
		if ( $res->numRows() > 0 ) {
			foreach ( $res as $row ) {
				$title = Title::makeTitleSafe( $row->wl_namespace, $row->wl_title );
				$titles[] = $title;
			}
			$res->free();

			GenderCache::singleton()->doTitlesArray( $titles );
		}

		$this->titles = $titles;
	}

}
