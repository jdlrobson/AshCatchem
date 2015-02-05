<?php
/**
 * CollectionsListItemCardView.php
 */

/**
 * View for an item card in a mobile collection.
 */
class CollectionsListItemCardView extends View {

	/**
	 * Constructor
	 * @param Collection $collection
	 */
	public function __construct( Collection $collection ) {
		$this->collection = $collection;
	}

	protected $collection;

	/**
	 * Return title of collection
	 * @returns string collection title
	 */
	public function getTitle() {
		return $this->collection->getTitle();
	}

	/**
	 * @inheritdoc
	 */
	public function getHtml() {
		$articleCountMsg = wfMessage(
			'mobile-frontend-collection-article-count',
			$this->collection->getCount()
		);
		// FIXME: should consider privacy in collection
		$followingMsg = wfMessage( 'mobile-frontend-collection-private' );
		$collectionUrl = $this->collection->getUrl();

		$html = Html::openElement( 'div', array( 'class' => 'collection-card' ) ) .
			Html::openElement( 'div', array( 'class' => 'collection-card-overlay' ) ) .
			Html::openElement( 'div', array( 'class' => 'collection-card-title' ) ) .
			Html::element( 'a', array( 'href' => $collectionUrl ), $this->getTitle() ) .
			Html::closeElement( 'div' ) .
			Html::element( 'span', array( 'class' => 'collection-card-following' ), $followingMsg ) .
			Html::element( 'span', array( 'class' => 'collection-card-following' ), '•' ) .
			Html::element( 'span', array( 'class' => 'collectoin-card-article-count' ), $articleCountMsg ) .
			Html::closeElement( 'div' ) .
			Html::closeElement( 'div' );
		return $html;
	}
}
