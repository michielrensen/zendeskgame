<?php
namespace Component\Experience\Model;

use Component\Experience\Model\Repository\ExperienceRepository;
use Doctrine\DBAL\Connection;

class ExperienceRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var $fixture ExperienceRepository */
    protected $fixture;

    public function setup()
    {
        $connectionMock = \Mockery::mock(Connection::class);

        $this->fixture = new ExperienceRepository($connectionMock);
    }

    public function testFixtureClass()
    {
        $this->assertInstanceOf(ExperienceRepository::class, $this->fixture);
    }
}