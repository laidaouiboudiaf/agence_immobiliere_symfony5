<?php
namespace App\tests;
use App\Repository\OwnersRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AppTest extends KernelTestCase
{
    public function testPushAndPop()
    {
        self::bootKernel();
        $owners= static::getContainer()->get(OwnersRepository::class)->count([]);
        $this->assertEquals(100, $owners);

    }


}