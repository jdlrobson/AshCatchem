<?php
/**
 * View.php
 */

/**
 * Render a view.
 */
abstract class View {
	/**
	 * Returns the html for the view
	 *
	 * @private
	 * @return string Html
	 */
	abstract protected function getHtml();

	/**
	 * Adds HTML of the view to the OutputPage.
	 *
	 * @param OutputPage $out
	 */
	public function render( OutputPage $out ) {
		$out->addHTML( $this->getHtml() );
	}
}
