<?php
declare(strict_types=1);

namespace App\Controller;

use App\Interface\UserInterface;
use Hyperf\HttpServer\Contract\RequestInterface;
use Swoole\Exception;

class UserController extends AbstractController
{
    private UserInterface $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function store(RequestInterface $request)
    {
        $data = $request->all();

        if ($this->userInterface->checkUserData($data['email'],$data['document'])){
            return new Exception("Usuário já cadastrado!",422);
        }

        return $this->userInterface->store($data);
    }

}