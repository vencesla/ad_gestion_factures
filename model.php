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

    public function read() {
        return $this->getConnection()->query("SELECT * FROM factures ORDER BY id")
                ->fetchAll(PDO::FETCH_OBJ);
    }

    public function countBills():int {
        return (int)$this->getConnection()->query("SELECT COUNT(id) as count FROM factures")->fetch()[0];
    }

    public function getSingleBill(int $id){
        $q = $this->getConnection()->prepare("SELECT * FROM factures WHERE id=:id");
        $q->execute(['id' => $id]);
        return $q->fetch(PDO::FETCH_OBJ);
    }
}