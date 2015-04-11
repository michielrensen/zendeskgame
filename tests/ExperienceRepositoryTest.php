<?php

use \Mockery as m;

class ExperienceRepositoryTest extends PHPUnit_Framework_TestCase {

    protected $repository;

    public function setUp()
    {
        $this->repository = Mockery::mock('Seoshop\Model\ExperienceRepository');
    }

    public function testConstruct()
    {
        $mock = m::mock('Seoshop\Model\ExperienceRepository');
        $mock->shouldReceive('getList');

        $this->assertTrue(is_array($mock->getList()));
//        var_dump($this->repository->shouldReceive('indexAction'));
//        $this->assertTrue($this->repository->shouldReceive('indexAction'));
//        $this->assertTrue($this->repository->shouldReceive('showAction'));
//        $this->assertTrue($this->repository->shouldReceive('updateAction'));
    }
}