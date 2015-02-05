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
				// Show specified user's collections
				// FIXME: Add error checking?
				$user = User::newFromName( $args[0] );
			} else {
				// Otherwise use current user
				$user = $this->getUser();
			}
		} else {
			$user = $this->getUser();
		}

		$id = 0;
		if ( isset( $args ) && isset( $args[1] ) ) {
			$id = $args[1];
		}
		$this->renderUserCollection( $user, $id );
	}

	/**
	 * Renders a user collection
	 * @param User $user collection owner
	 * @param int $id collection id
	 */
	public function renderUserCollection( $user, $id ) {
		$collection = new Collection(
			$user,
			$this->msg( 'mobile-frontend-collection-watchlist-title' ),
			$this->msg( 'mobile-frontend-collection-watchlist-description' )
		);
		// Watchlist lives at id 0
		if ( (int)$id === 0 ) {
			// Load from watchlist if the $user is valid
			if ( $this->getUser()->getName() == $user->getName() ) {
				$collection->load( new WatchlistCollectionStore( $user ) );
			}
		}
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
