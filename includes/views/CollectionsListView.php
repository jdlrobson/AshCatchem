<?php
/**
 * CollectionsListView.php
 */

/**
 * Renders a mobile collection card list
 */
class CollectionsListView extends View {
	/**
	 * Constructor
	 * @param MobileCollection $collection
	 */
	public function __construct( $collectionList ) {
		$this->collectionList = $collectionList;
	}

	/**
	 * Returns the html for the items of a collection
	 *
	 * @return string Html
	 */
	public static function getListItemsHtml( $collectionList ) {
		$html = Html::openElement( 'div', array( 'class' => 'collection-cards' ) );
		foreach ( $collectionList as $item ) {
			$view = new CollectionsListItemCardView( $item );
			$html .= $view->getHtml();
		}
		// FIXME: Pagination
		$html .= Html::closeElement( 'div' );
		return $html;
	}

	/**
	 * Return title of collection
	 * @return string collection title
	 */
	public function getTitle() {
		// FIXME: i18n
		return 'Collections';
	}

	/**
	 * @inheritdoc
	 */
	public function getHtml() {
		$html = Html::openElement( 'div', array( 'class' => 'collection content' ) );
		// Get items
		$html .= $this->getListItemsHtml( $this->collectionList );
		$html .= Html::closeElement( 'div' );
		return $html;
	}
}
