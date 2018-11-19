<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testReturnsFullName()
    {
        $user = new User;

        $user->first_name   = "Teresa";
        $user->surname      = "Green";

        $this->assertEquals('Teresa Green', $user->getFullName());
    }

    public function testFullNameEmptyByDefaul()
    {
        $user = new User;

        $this->assertEquals('', $user->getFullName());
    }

    public function testNotificationIsSend()
    {
        $user = new User;

        $mock_mailer = $this->createMock(Mailer::class);
        $mock_mailer->expects($this->once())
                    ->method('sendMessage')
                    ->with($this->equalTo('teste@teste.com.br'), $this->equalTo('Hello'))
                    ->willReturn(true);

        $user->setMailer($mock_mailer);

        $user->email = 'teste@teste.com.br';

        $this->assertTrue($user->notify("Hello"));
    }

    public function testCannotNotifyUserWithNoEmail()
    {
        $user = new User;

        $mock_mailer = $this->getMockBuilder(Mailer::class)
                            ->setMethods(null)
                            ->getMock();

        $user->setMailer($mock_mailer);

        $this->expectException(Exception::class);

        $user->notify("Hello");
    }
}