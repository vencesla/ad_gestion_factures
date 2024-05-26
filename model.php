<?php

class Database {
    private $host = "mysql:dbname=ad_crud_ajax";
    private $user = "root";
    private $pswd = "laracias";

    private function getConnection()
    {
        try {
            return new PDO($this->host, $this->user, $this->pswd);
        }catch(PDOException $e) {
            die('Erreur: '. $e->getMessage());
        }
    }

    public function create(string $customer, string $cashier, int $amount, int $received, int $returned, string $state)
    {
        $q = $this->getConnection()->prepare(("INSERT INTO factures (customer, cashier, amount, received, returned, state)
                VALUES (:customer, :cashier, :amount, :received, :returned, :state)"));

        return $q->execute([
            'customer' => $customer,
            'cashier' => $cashier,
            'amount' => $amount,
            'received' => $received,
            'returned' => $returned,
            'state' =>$state
        ]);
    }
}