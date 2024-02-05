<?php
/**
 * Unit test class for the RequireStrictType sniff.
 *
 * @author    Sertan Danis <sdanis@squiz.net>
 * @copyright 2006-2019 Squiz Pty Ltd (ABN 77 084 670 600)
<<<<<<< HEAD
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
=======
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
>>>>>>> Development
 */

namespace PHP_CodeSniffer\Standards\Generic\Tests\PHP;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class RequireStrictTypesUnitTest extends AbstractSniffUnitTest
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
<<<<<<< HEAD
        case 'RequireStrictTypesUnitTest.2.inc':
        case 'RequireStrictTypesUnitTest.5.inc':
        case 'RequireStrictTypesUnitTest.6.inc':
        case 'RequireStrictTypesUnitTest.10.inc':
            return [1 => 1];

        default:
            return [];
        }

=======
        case 'RequireStrictTypesUnitTest.1.inc':
            return [];
            break;
        }

        return [1 => 1];

>>>>>>> Development
    }//end getErrorList()


    /**
     * Returns the lines where warnings should occur.
     *
<<<<<<< HEAD
     * @param string $testFile The name of the file being tested.
     *
     * @return array<int, int>
     */
    public function getWarningList($testFile='')
    {
        switch ($testFile) {
        case 'RequireStrictTypesUnitTest.11.inc':
        case 'RequireStrictTypesUnitTest.12.inc':
        case 'RequireStrictTypesUnitTest.14.inc':
        case 'RequireStrictTypesUnitTest.15.inc':
            return [3 => 1];

        default:
            return [];
        }
=======
     * The key of the array should represent the line number and the value
     * should represent the number of warnings that should occur on that line.
     *
     * @return array<int, int>
     */
    public function getWarningList()
    {
        return [];
>>>>>>> Development

    }//end getWarningList()


}//end class
