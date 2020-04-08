<?php 

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
*  Unit Test for StarterTest Class
*
*  @author Arif RH
*/
final class StarterClassTest extends TestCase
{
  /**
   * set common properties that will be used in all unit test case
   */
	  protected $test_name = null;

    /**
     * Setup inital action that will be used in all unit test case
     */
    public function setUp(): void
    {
        $this->test_name = 'Arifrh\Packages\StarterClass';
    }

    public function tearDown(): void
    {
        $this->test_name = null;
    }

    public function testGetVersion()
    {
      $this->assertEquals('1.0', Arifrh\Packages\StarterClass::getVersion());
    }
}
