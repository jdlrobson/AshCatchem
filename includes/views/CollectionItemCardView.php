<?php
/**
 * CollectionItemCardView.php
 */

/**
 * View for an item card in a mobile collection.
 */
class CollectionItemCardView extends View {
	protected $item;

	/**
	 * Constructor
	 * @param MobilePage $item
	 */
	public function __construct( MobilePage $item ) {
		$this->item = $item;
	}

	/**
	 * @inheritdoc
	 */
	protected function getHtml() {
		$page = $this->item;
		$title = $page->getTitle();
		$html = Html::openElement( 'div', array( 'class' => 'collection-item' ) ) .
			Html::element(
				'h2', array( 'class' => 'collection-item-title' ), $title->getText()
			) .
			Html::openElement( 'div', array( 'class' => 'collection-item-footer' ) ) .
			Html::element( 'a',
				array(
					'href' => $title->getLocalUrl(),
					'class' => MobileUI::anchorClass( 'progressive' ),
				),
				wfMessage( 'mobile-frontend-collection-read-more' )
			) .
			Html::closeElement( 'div' ) .
			Html::closeElement( 'div' );
		return $html;
	}
}
