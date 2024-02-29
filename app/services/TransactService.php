<?php

namespace App\services;

use App\Constants\AuthorizatorConstant;
use App\Interface\TransactInterface;
use App\Interface\UserInterface;
use App\Model\Balance;
use Swoole\Exception;
use App\Constants\AccountType;
use App\Interface\ClientInterface;
use App\Interface\NotificationInterface;

class TransactService implements TransactInterface
{
    private UserInterface $userInterface;
    private ClientInterface $client;
    private string $param;
    private NotificationInterface $notification;
    public function __construct(UserInterface $userInterface, ClientInterface $client, NotificationInterface $notification)
    {
        $this->userInterface = $userInterface;
        $this->client = $client;
        $this->notification = $notification;
        $this->param = \Hyperf\Support\env("PARAM_AUTHORIZATOR");
    }

    public function deposit(Array $data)
    {
        if (!$this->userInterface->checkUserValid($data['user'])){
            return json_encode([
                "message" => new Exception("Usuário inválido para deposito!",422)
            ]);
        }

        try {
        $balance = $this->getActualBalance($data['user']);
        $balance += doubleval($data['deposit']);
        $this->updateBalance($data['user'], $balance);

        return json_encode([
            "message" => "Deposito realizado com sucesso!"
        ]);
        } catch (Exception $e){
            return json_encode([
                "message" => $e->getMessage()
            ]);
        }
    }

    public function transfer(Array $data)
    {
        if (AccountType::LOJISTA == $this->userInterface->getUserIdAndType("id",$data['payer'])['type']){
            return json_encode([
               "message" => new Exception("Você não tem permissão para essa ação.",422)
            ]);
        }

        $balance = $this->getActualBalance($data['payer']);
        $balance -= $data['value'];

        if (!$this->checkBalanceValid($balance)){
            return json_encode([
                "message" => new Exception("Não há saldo suficiente.",422)
            ]);
        }

        try{
            $destinationBalance = $this->getActualBalance($data['payee']);
            $destinationBalance += $data['value'];

            if (AuthorizatorConstant::AUTHORIZED == $this->checkAuthorization()["message"]) {
                $this->updateBalance($data['payer'], $balance);
                $this->updateBalance($data['payee'], $destinationBalance);

                return json_encode([
                    "message" => "Transferência realizada com sucesso!",
                    "notification" => $this->notification->send("Transferancia realizada")
                ]);
            }

          return json_encode([
              "message" => "Não autorizado!"
          ]);
        } catch (Exception $e){
            return json_encode([
               "message" => $e->getMessage()
            ]);
        }
    }

    private function getActualBalance(string $user): float
    {
        $arrBalance = Balance::where(["user_id" => $user])->get()->toArray();
        $arrBalance = reset($arrBalance);
        return $arrBalance['balance'];
    }

    private function checkBalanceValid(float $balance)
    {
        if ($balance >= 0.00){
            return true;
        }

        return false;
    }

    private function updateBalance(string $userId, float $balance): void
    {
        Balance::query()->where('user_id',$userId)->update(["balance" => $balance]);
    }

    private function checkAuthorization():array
    {
        $response = $this->client->request($this->param);

        return json_decode((string) $response->getBody(), true);
    }
}