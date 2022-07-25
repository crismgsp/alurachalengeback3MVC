<?php

namespace Sistema\Models\helper;

use PDO;
use PDOException;


class ModAtualiza extends ModConn
{
   private string $table;
   private $terms;   
   private $data;  
   private array $value = [];
   private string $result;
   private object $update;
   private string $query;
   private object $conn;
   private $parseString;

   function getResult(): string
   {
    return $this->result;
   }

   public function exeUpdate(string $table, $data, $terms, $parseString): void
   {
        $this->table = $table;
        $this->data = $data;
        $this->terms = $terms;
       
        parse_str($parseString, $this->value);
      
        $this->exeReplaceValues();
   }

   
   private function exeReplaceValues():void
   {
    //usa um foreach pra caso tenha mais de 1 dado em id
        foreach($this->data as $key => $value){
                      
            $values[] = $key . "=:" . $key;
        }
        
        //vai converter um array para string usando implode, separando pela virgula 
        $values = implode(',', $values);
        
        $this->query = "UPDATE {$this->table} SET {$values} {$this->terms}";
        
        $this->exeInstruction();
   }

   private function exeInstruction(): void
   {
        $this->connection();
        try{
            
            $this->update->execute(array_merge($this->data, $this->value));
            $this->result = true;
        }catch(PDOException $err){
            $this->result = null;
        }
   }

  
   private function connection(): void
   {
        $this->conn = $this->connectDb();
        $this->update = $this->conn->prepare($this->query);
   }

}