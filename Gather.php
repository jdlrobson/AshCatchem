<?php
/**
 * Extension Gather
 *
 * @file
 * @ingroup Extensions
 * @author Jon Robson
 * @author Joaquin Hernandez
 * @author Rob Moen
 * @licence GNU General Public Licence 2.0 or later
 */

// Needs to be called within MediaWiki; not standalone
if ( !defined( 'MEDIAWIKI' ) ) {
	echo "This is a MediaWiki extension and cannot run standalone.\n";
	die( -1 );
}
if ( !defined( 'MOBILEFRONTEND' ) ) {
	echo "This requires Gather.\n";
	die( -1 );
}

// Extension credits that will show up on Special:Version
$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'Gather',
	'author' => array( 'Jon Robson', 'Joaquin Hernandez', 'Rob Moen' ),
	'descriptionmsg' => 'ext-gather-desc',
	'url' => 'https://www.mediawiki.org/wiki/Gather',
	'license-name' => 'GPL-2.0+',
);

$wgMessagesDirs['Gather'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['GatherAlias'] = __DIR__ . "/Gather.alias.php";

// autoload extension classes
$autoloadClasses = array (
	'GatherHooks' => 'Gather.hooks',

	'Collection' => 'models/Collection',
	'CollectionsList' => 'models/CollectionsList',

	'CollectionStore' => 'stores/CollectionStore',
	'WatchlistCollectionStore' => 'stores/WatchlistCollectionStore',

	'View' => 'views/View',
	'CollectionView' => 'views/CollectionView',
	'CollectionItemCardView' => 'views/CollectionItemCardView',
	'CollectionsListView' => 'views/CollectionsListView',
	'CollectionsListItemCardView' => 'views/CollectionsListItemCardView',

	'SpecialGather' => 'specials/SpecialGather',
);

foreach ( $autoloadClasses as $className => $classFilename ) {
	$wgAutoloadClasses[$className] = __DIR__ . "/includes/$classFilename.php";
}

// use array_merge to ensure we do not override existing values set by core
$wgSpecialPages = array_merge( $wgSpecialPages, array(
	'Gather' => 'SpecialGather',
) );

// ResourceLoader modules

/**
 * A boilerplate for RL modules that do not support templates
 * Agnostic to whether desktop or mobile specific.
 */
$wgGatherResourceBoilerplate = array(
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'Gather',
);

/**
 * A mobile enabled ResourceLoaderFileModule template
 */
$wgGatherResourceFileModuleBoilerplate = $wgGatherResourceBoilerplate + array(
	'targets' => array( 'mobile', 'desktop' ),
);

/**
 * A boilerplate containing common properties for all RL modules served to mobile site special pages
 * Restricted to mobile site.
 */
$wgGatherMobileSpecialPageResourceBoilerplate = $wgGatherResourceBoilerplate + array(
	'targets' => 'mobile',
	'group' => 'other',
);


require_once __DIR__ . "/includes/Resources.php";

/**
 * Begin configuration variables
 */
$wgMFEnableCollectionsFeature = true;
