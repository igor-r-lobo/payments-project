<?php

namespace HyperfTest\Cases;

use App\services\TransactService;
use Monolog\Test\TestCase;

class TransactionTest extends TestCase
{
    public function testShouldDepositCorrect()
    {
        //Arrange
        $data = ["user" => 1, "deposit" => 3.15];
        $return = json_encode(["message" => "Deposito realizado com sucesso!"]);
        $transactMock = $this->getMockBuilder(TransactService::class)->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        //Act
        $transactMock->method("deposit")->willReturn($return);

        //Assert
        $this->assertSame($return,$transactMock->deposit($data));
    }

    public function testShouldTransferCorrect()
    {
        //Arrange
        $data = ["payee" => 1, "payer" => 2, "value" => 6.14];
        $return = json_encode([
            "message" => "Transferência realizada com sucesso!",
            "notification" => true
        ]);
        $transactMock = $this->getMockBuilder(TransactService::class)->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        //Act
        $transactMock->method("transfer")->willReturn($return);

        //Assert
        $this->assertSame($return,$transactMock->transfer($data));
    }
}