<?php
/**
 * Unit test class for the BacktickOperator sniff.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
<<<<<<< HEAD
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
=======
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
>>>>>>> Development
 */

namespace PHP_CodeSniffer\Standards\Generic\Tests\PHP;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class BacktickOperatorUnitTest extends AbstractSniffUnitTest
{


    /**
     * Returns the lines where errors should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of errors that should occur on that line.
     *
     * @return array<int, int>
     */
    public function getErrorList()
    {
<<<<<<< HEAD
        return [
            2 => 2,
            9 => 2,
        ];
=======
        return [2 => 2];
>>>>>>> Development

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
<<<<<<< HEAD
        // Warning about incorrect annotation will be shown on line 1 once PR #3915 would be merged.
=======
>>>>>>> Development
        return [];

    }//end getWarningList()


}//end class
