<?php
namespace Component\Experience;

use Component\Experience\Service\ExperienceService;

class ExperienceServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var ExperienceService */
    protected $fixture;

    public function setUp()
    {
        $this->setFixture();
    }

    public function setFixture()
    {
        $this->fixture = null;
    }

    public function testDummy()
    {
        $this->assertTrue(true);
    }
}