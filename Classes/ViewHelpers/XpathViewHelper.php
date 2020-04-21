<?php
namespace Slub\Dfgviewer\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Alexander Bigga <alexander.bigga@slub-dresden.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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

use Slub\Dfgviewer\Helpers\GetDoc;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ViewHelper to get xpath elements
 *
 * @package TYPO3
 */
class XpathViewHelper extends AbstractViewHelper
{

    /**
     * initialize Arguments
     */
    public function initializeArguments()
    {
        $this->registerArgument('xpath', 'string', 'xpath of elements', true);
        $this->registerArgument('field', 'string', 'type of field requested', false, '');
        $this->registerArgument('htmlspecialchars', 'bool', 'use htmlspecialchars() on the found result', false, true);
    }

    /**
     * Return elements found
     *
     * @return string
     */
    public function render()
    {
        $doc = GeneralUtility::makeInstance(GetDoc::class);
        $xpath = $this->arguments['xpath'];
        $field = $this->arguments['field'];
        $htmlspecialchars = $this->arguments['htmlspecialchars'];
        $output = '';

        $result = $doc->getXpath($xpath);

        if (is_array($result)) {
          foreach ($result as $row) {
            $output .= trim($row) . ' ';
          }
        } else {
          $output = trim($result);
        }

        if ($htmlspecialchars) {
          return htmlspecialchars(trim($output));
        } else {
          return trim($output);
        }
    }
}
