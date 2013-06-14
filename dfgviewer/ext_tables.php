<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Sebastian Meyer <sebastian.meyer@slub-dresden.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

if (!defined ('TYPO3_MODE')) die ('Access denied.');

// Register static typoscript.
t3lib_extMgm::addStaticFile($_EXTKEY, 'typoscript/', 'DFG Viewer');

// Register plugins.
t3lib_div::loadTCA('tt_content');

// Plugin "amd".
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_amd'] = 'layout,select_key,pages,recursive';

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_amd'] = 'pi_flexform';

t3lib_extMgm::addPlugin(array('LLL:EXT:dfgviewer/locallang.xml:tt_content.dfgviewer_amd', $_EXTKEY.'_amd'), 'list_type');

t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_amd', 'FILE:EXT:'.$_EXTKEY.'/plugins/amd/flexform.xml');

// Plugin "amd".
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_uri'] = 'layout,select_key,pages,recursive';

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_uri'] = 'pi_flexform';

t3lib_extMgm::addPlugin(array('LLL:EXT:dfgviewer/locallang.xml:tt_content.dfgviewer_uri', $_EXTKEY.'_uri'), 'list_type');

t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_uri', 'FILE:EXT:'.$_EXTKEY.'/plugins/uri/flexform.xml');

// Register modules.
if (TYPO3_MODE == 'BE')	{

	// Module "setup".
	t3lib_extMgm::addModule('txdlfmodules', 'txdfgviewersetup', '', t3lib_extMgm::extPath($_EXTKEY).'modules/setup/');

	t3lib_extMgm::addLLrefForTCAdescr('_MOD_txdlfmodules_txdfgviewersetup','EXT:dfgviewer/modules/setup/locallang_mod.xml');

}

?>