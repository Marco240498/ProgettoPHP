<?php

declare(strict_types=1);


class DBManagerUseres
{
    private $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function IsValidUser($User): bool
    {
        $sql = 'SELECT USER FROM users WHERE name = :UserName';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':UserName' => $User]);
        $result = $sth->fetchAll();

        if(sizeof($result) != 0)
            return true;

        return false;
    }

    public function IsValidPassword($User, $Password): bool
    {
        $sql = 'SELECT * FROM users WHERE name = :UserName';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':UserName' => $User]);
        $result = $sth->fetchAll();

        if(password_verify($Password, $result[2]))
            return true;

        return false;
    }

    public function GetUserID($User): int
    {
        $sql = 'SELECT ID FROM users WHERE name = :UserName';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([':UserName' => $User]);
        $result = $sth->fetchAll();

        return $result[0];
    }
}