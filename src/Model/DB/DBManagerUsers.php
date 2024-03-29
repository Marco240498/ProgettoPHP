<?php

declare(strict_types=1);

namespace SimpleMVC\Model\DB;

use PDO;

class DBManagerUsers{
    
    private $pdo;

    function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function IsValidLoginParameters($User, $Password): bool
    {
        $sql = 'SELECT * FROM users WHERE NAME = :UserName';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':UserName' => $User]);
        $result = $sth->fetchAll();

        if(!empty($result))
            if(password_verify($Password, $result[0]['PASSWORD']))
                return true;

        return false;
    }

    public function GetUserID($User): int
    {
        $sql = 'SELECT ID FROM users WHERE NAME = :UserName';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':UserName' => $User]);
        $result = $sth->fetchAll();

        return $result[0];
    }

    public function GetUsername($ID)
    {
        $sql = 'SELECT NAME FROM users WHERE ID = :UserID';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':UserID' => $ID]);
        $result = $sth->fetchAll();

        return $result[0];
    }
}