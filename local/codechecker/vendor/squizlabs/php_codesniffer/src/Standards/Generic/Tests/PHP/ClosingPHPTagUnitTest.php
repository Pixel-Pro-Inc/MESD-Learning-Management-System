<?php
/**
 * Unit test class for the ClosingPHPTag sniff.
 *
 * @author    Andy Grunwald <andygrunwald@gmail.com>
 * @copyright 2010-2014 Andy Grunwald
<<<<<<< HEAD
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
=======
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
>>>>>>> Development
 */

namespace PHP_CodeSniffer\Standards\Generic\Tests\PHP;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class ClosingPHPTagUnitTest extends AbstractSniffUnitTest
{


    /**
     * Returns the lines where errors should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of errors that should occur on that line.
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array<int, int>
     */
    public function getErrorList($testFile='')
    {
        switch ($testFile) {
        case 'ClosingPHPTagUnitTest.1.inc':
            return [9 => 1];
<<<<<<< HEAD

        case 'ClosingPHPTagUnitTest.2.inc':
            return [5 => 1];

        default:
            return [];
=======
        case 'ClosingPHPTagUnitTest.2.inc':
            return [5 => 1];
            break;
        default:
            return [];
            break;
>>>>>>> Development
        }

    }//end getErrorList()


    /**
     * Returns the lines where warnings should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of warnings that should occur on that line.
     *
     * @return array<int, int>
     */
    public function getWarningList()
    {
        return [];

    }//end getWarningList()


}//end class
