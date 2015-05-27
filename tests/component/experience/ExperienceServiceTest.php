<?php
namespace Component\Experience;

use Component\Experience\Service\ExperienceService;
use Component\Experience\Model\Repository\ExperienceRepository;

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
        $experienceRepositoryMock = \Mockery::mock(ExperienceRepository::class);

        $this->fixture = new ExperienceService($experienceRepositoryMock);
    }

    public function testFixtureClass()
    {
        $this->assertInstanceOf(ExperienceService::class, $this->fixture);
    }
}