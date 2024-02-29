<?php
declare(strict_types=1);

namespace App\Controller;

use App\Interface\TransactInterface;
use App\Interface\UserInterface;
use Hyperf\HttpServer\Contract\RequestInterface;

class TransactController extends AbstractController
{
    private TransactInterface $transactInterface;
    private UserInterface $userInterface;

    public function __construct(TransactInterface $transact, UserInterface $userInterface)
    {
        $this->transactInterface = $transact;
        $this->userInterface = $userInterface;
    }

    public function deposit(RequestInterface $request)
    {
        return $this->transactInterface->deposit($request->all());
    }

    public function transfer(RequestInterface $request)
    {
        $data = $request->all();
        $user = $this->userInterface->getUserIdAndType("document",$data['payee']);
        $data['payee'] = $user['id'];

        return $this->transactInterface->transfer($data);
    }
}