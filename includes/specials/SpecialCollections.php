<?php
/**
 * SpecialCollections.php
 */

/**
 * Render a collection of articles.
 */
class SpecialCollections extends SpecialPage {
	/**
	 * Construct function
	 */
	public function __construct() {
		parent::__construct( 'Collections' );
	}

	/**
	 * Render the special page and redirect the user to the editor (if page exists)
	 * @param string $subpage The name of the page to edit
	 */
	public function execute( $subpage ) {
		if ( $subpage ) {
			$args = explode( '/', $subpage );
			// If there is a user argument, that's what we want to use
			if ( isset( $args[0] ) ) {
				$user = User::newFromName( $args[0] );
			} else {
				// Otherwise just show the users page
				$user = $this->getUser();
			}
		} else {
			$user = $this->getUser();
		}

		$collection = new Collection(
			$user,
			$this->msg( 'mobile-frontend-collection-watchlist-title' ),
			$this->msg( 'mobile-frontend-collection-watchlist-description' )
		);
		$collection->load( new WatchlistCollectionStore( $user ) );
		$this->render( $collection );
	}

	/**
	 * Render the special page using CollectionView and given collection
	 * @param Collection $collection
	 */
	public function render( $collection ) {
		$out = $this->getOutput();
		$this->setHeaders();
		$out->setProperty( 'unstyledContent', true );
		$out->addModuleStyles( array(
			// FIXME: Should be taken care of by MobileFrontend
			'skins.minerva.special.styles',
			'ext.collections.styles',
		) );
		$out->setPageTitle( $collection->getTitle() );
		$view = new CollectionView( $collection );
		$view->render( $out );
	}
}
