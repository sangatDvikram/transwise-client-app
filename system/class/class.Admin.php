<?php

class Admin {

    private $db;
    private $data;

    function __construct()
    {
        global $dataBase;
        $this->db = $dataBase;
    }

    function getData($input)
    {
        $input = array_map('stripslashes', $input);
        $this->data = $input;
    }

    public function insert_tax()
    {
        try
        {
            $statement = "Insert Into transwise_taxes (name,rate,tax_id,date,status) values(:name,:rate,:tax_id,:time,:status)";
            $query = $this->db->prepare($statement);
            $query->execute(array(

                ":name"   => $this->data['name'],
                ":rate"   => $this->data['rate'],
                ":tax_id" => $this->data['tax_id'],
                ":status" => $this->data['status'],
                ":time"   => time()
            ));

            return "<div class='alert alert-success'> Tax has been successfully created.</div>";
        } catch (PDOException $e)
        {
            return $e->getMessage();
        }
    }

    public function update_tax()
    {
        try
        {
            $statement = "UPDATE transwise_taxes SET name = :name, rate = :rate , status=:status WHERE  tax_id = :tax_id ";
            $query = $this->db->prepare($statement);
            $query->execute(array(
                ":name"   => $this->data['name'],
                ":rate"   => $this->data['rate'],
                ":status" => $this->data['status'],
                ":tax_id" => $this->data['tax_id']
            ));

            //$this->updateEditLog($this->generate_soft_link($this->data['name']));
            return "<div class='alert alert-success'> Tax has been successfully updated.</div>";
        } catch (PDOException $e)
        {
            return $e->getMessage();
        }
    }

    public function delete_tax()
    {
        try
        {
            $statement = "DELETE FROM transwise_taxes WHERE  tax_id = :tax_id ";
            $query = $this->db->prepare($statement);
            $query->execute(array(
                ":tax_id" => $this->data['tax_id']
            ));

            //$this->updateEditLog($this->generate_soft_link($this->data['name']));
            return "<div class='alert alert-success'> Service has been successfully Deleted.</div>";
        } catch (PDOException $e)
        {
            return $e->getMessage();
        }
    }

    public function get_tax_details($id = null, $field = null)
    {
        try
        {
            global $dataBase;
            if ($id == null && $field == null)
            {
                $stmt = $dataBase->prepare("SELECT * FROM transwise_taxes ");
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_NAMED);
            }
            if ($id != null && $field == null)
            {
                $stmt = $dataBase->prepare("SELECT * FROM transwise_taxes where tax_id=:tax_id ");
                $stmt->execute(array(':tax_id' => $id));

                return $stmt->fetch(PDO::FETCH_NAMED);
            }
            if ($id != null && $field != null)
            {
                $stmt = $dataBase->prepare("SELECT $field FROM transwise_taxes where tax_id=:tax_id ");
                $stmt->execute(array(':tax_id' => $id));
                $row = $stmt->fetch(PDO::FETCH_NAMED);

                return $row[$field];
            }

        } catch (PDOException $e)
        {
            return $e->getMessage();
        }
    }
}

?>
