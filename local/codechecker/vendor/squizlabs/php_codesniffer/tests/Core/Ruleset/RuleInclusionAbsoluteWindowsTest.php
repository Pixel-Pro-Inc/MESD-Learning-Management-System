<?php
/**
 * Tests for the \PHP_CodeSniffer\Ruleset class using a Windows-style absolute path to include a sniff.
 *
 * @author    Juliette Reinders Folmer <phpcs_nospam@adviesenzo.nl>
 * @copyright 2019 Juliette Reinders Folmer. All rights reserved.
<<<<<<< HEAD
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
=======
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
>>>>>>> Development
 */

namespace PHP_CodeSniffer\Tests\Core\Ruleset;

use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Ruleset;
use PHPUnit\Framework\TestCase;

class RuleInclusionAbsoluteWindowsTest extends TestCase
{

    /**
     * The Ruleset object.
     *
     * @var \PHP_CodeSniffer\Ruleset
     */
    protected $ruleset;

    /**
     * Path to the ruleset file.
     *
     * @var string
     */
    private $standard = '';

    /**
     * The original content of the ruleset.
     *
     * @var string
     */
    private $contents = '';


    /**
     * Initialize the config and ruleset objects.
     *
<<<<<<< HEAD
     * @before
     *
     * @return void
     */
    public function initializeConfigAndRuleset()
=======
     * @return void
     */
    public function setUp()
>>>>>>> Development
    {
        if (DIRECTORY_SEPARATOR === '/') {
            $this->markTestSkipped('Windows specific test');
        }

<<<<<<< HEAD
=======
        if ($GLOBALS['PHP_CODESNIFFER_PEAR'] === true) {
            // PEAR installs test and sniff files into different locations
            // so these tests will not pass as they directly reference files
            // by relative location.
            $this->markTestSkipped('Test cannot run from a PEAR install');
        }

>>>>>>> Development
        $this->standard = __DIR__.'/'.basename(__FILE__, '.php').'.xml';
        $repoRootDir    = dirname(dirname(dirname(__DIR__)));

        // On-the-fly adjust the ruleset test file to be able to test sniffs included with absolute paths.
        $contents       = file_get_contents($this->standard);
        $this->contents = $contents;

        $adjusted = str_replace('%path_slash_back%', $repoRootDir, $contents);

        if (file_put_contents($this->standard, $adjusted) === false) {
            $this->markTestSkipped('On the fly ruleset adjustment failed');
        }

        // Initialize the config and ruleset objects for the test.
        $config        = new Config(["--standard={$this->standard}"]);
        $this->ruleset = new Ruleset($config);

<<<<<<< HEAD
    }//end initializeConfigAndRuleset()
=======
    }//end setUp()
>>>>>>> Development


    /**
     * Reset ruleset file.
     *
<<<<<<< HEAD
     * @after
     *
     * @return void
     */
    public function resetRuleset()
=======
     * @return void
     */
    public function tearDown()
>>>>>>> Development
    {
        if (DIRECTORY_SEPARATOR !== '/') {
            file_put_contents($this->standard, $this->contents);
        }

<<<<<<< HEAD
    }//end resetRuleset()
=======
    }//end tearDown()
>>>>>>> Development


    /**
     * Test that sniffs registed with a Windows absolute path are correctly recognized and that
     * properties are correctly set for them.
     *
     * @return void
     */
    public function testWindowsStylePathRuleInclusion()
    {
        // Test that the sniff is correctly registered.
<<<<<<< HEAD
=======
        $this->assertObjectHasAttribute('sniffCodes', $this->ruleset);
>>>>>>> Development
        $this->assertCount(1, $this->ruleset->sniffCodes);
        $this->assertArrayHasKey('Generic.Formatting.SpaceAfterCast', $this->ruleset->sniffCodes);
        $this->assertSame(
            'PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\SpaceAfterCastSniff',
            $this->ruleset->sniffCodes['Generic.Formatting.SpaceAfterCast']
        );

        // Test that the sniff property is correctly set.
        $this->assertSame(
            '10',
            $this->ruleset->sniffs['PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\SpaceAfterCastSniff']->spacing
        );

    }//end testWindowsStylePathRuleInclusion()


}//end class
