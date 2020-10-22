<?php
namespace Test;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testEmail()
    {
        $user = new User();
        $user->setEmail("zhen@gmail.com");
        $this->assertEquals("zhen@gmail.com", $user->getEmail());
    }
}