<?php
/**
 * Definition of Gather's ResourceLoader modules.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

$wgResourceModules = array_merge( $wgResourceModules, array(

	'ext.collections.icons' => $wgGatherResourceFileModuleBoilerplate + array(
		'class' => 'ResourceLoaderImageModule',
		'prefix' => 'mw-ui',
		'images' => array(
			// FIXME: ':before' suffix should be configurable in image module.
			'icon' => array(
				'collections-read-more:before' => 'images/icons/next.svg',
			),
		),
	),

	'ext.collections.styles' => $wgGatherResourceFileModuleBoilerplate + array(
		'styles' => array(
			'resources/ext.collections.styles/icons.less',
			'resources/ext.collections.styles/collections.less',
		),
		'dependencies' => array(
			'mediawiki.ui.anchor',
			'skins.minerva.special.styles'
		),
		'position' => 'top',
		'group' => 'other',
	),

) );
