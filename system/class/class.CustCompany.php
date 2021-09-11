<?php

/**
 * Created by PhpStorm.
 * User: The Samir
 * Date: 9/1/14
 * Time: 7:35 PM
 */
class CustCompany {

    private $_post,
        $_pdo,
        $_companyId = '',
        $_companySQL,
        $_contactSQL = array();

    public function InsertNewCompany($postObj)
    {
        try
        {
            $this->_post = $postObj;

            $this->_pdo = myDB::getInstance()->getPdo();
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo->beginTransaction();
            //execute add company query
            $this->AddCompany();
            $this->addContactPerson();
            //execute user insert query
            $this->_pdo->commit();

            return true;
        } catch (exception $e)
        {
            $this->_pdo->rollBack();
            echo $e->getMessage();

            return false;
        }
    }

    public function AddCompany()
    {

        $this->_companyId = ProcessForm::generate_id('transwise_companies', 'company-');
        $this->_pdo->exec("INSERT INTO transwise_companies (company_id, name, address) VALUES (
        '{$this->_companyId}',
        '{$this->_post['name']}',
        '{$this->_post['address']}'
        )");

    }

    public function addContactPerson()
    {
        //add contact person
        //$cpname = $this->_post['contactPerson'];
        $cpemail = $this->_post['email'];
        $cpc = $this->_post['contact'];
        $cpadd = $this->_post['address'];
        // $cpid = ProcessForm::generate_id('transwise_user', 'user-'); //ask for array of row id here total =no of project +company contact
        $this->_pdo->exec("INSERT INTO transwise_user ( user_id,name,email,contact,address,timestamp,type,company_id,project_Name) VALUES (
       '" . ProcessForm::generate_id('transwise_user', 'user-') . "',
       '{$this->_post['contactPerson']}',
       '{$this->_post['email']}',
        '{$this->_post['contact']}',
        '{$this->_post['address']}',
        " . time() . ",
        '101',
        '{$this->_companyId}',
        'AllProject'
        )");


        //adding more user as Project contacts


        $projectCount = $this->_post['projectCount'];
        $arryIndex = 1;
        $str = '';
        //$newcpid = ProcessForm::generate_id('transwise_user', 'user-');
        //return $projectCount;
        for ($p = 1; $p <= $projectCount; $p ++)
        {
            $projcntName = "ProjectName" . "{$p}";
            $projcntContact = "ContactPerson" . "{$p}";
            $projcntno = "contactNo" . "{$p}";
            if (isset($this->_post[$projcntName]))
            {
                //         $str .= $this->_post[$projcntName] . "_" . $this->_post[$projcntContact] . "_".$this->_post[$projcntno]."_";
                $this->_pdo->exec("INSERT INTO transwise_user ( user_id,name,email,contact,address,timestamp,type,company_id,project_Name) VALUES (
        '" . ProcessForm::generate_id('transwise_user', 'user-') . "',
       '{$this->_post[$projcntContact]}',
       '',
        '{$this->_post[$projcntno]}',
        '',
        " . time() . ",
        '100',
        '{$this->_companyId}',
        '{$this->_post[$projcntName]}'
        )");
                $arryIndex ++;
            } else
            {
                $projectCount ++;
            }
        }

    }

    public function UpdateProjects($postObj)
    {
        //insert all project
        try
        {
            $this->_post = $postObj;

            $this->_pdo = myDB::getInstance()->getPdo();
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo->beginTransaction();
            //delete all exisitng project here
            $this->_pdo->exec("DELETE FROM transwise_user WHERE company_id='" . $this->_post['companyID'] . "' AND project_Name!='AllProject'");

            //Inset New project Here

            //adding more user as Project contacts
            $projectCount = $this->_post['projectCount'];
            $arryIndex = 1;
            $str = '';
            //$newcpid = ProcessForm::generate_id('transwise_user', 'user-');
            //return $projectCount;
            for ($p = 1; $p <= $projectCount; $p ++)
            {
                $projcntName = "ProjectName" . "{$p}";
                $projcntContact = "ContactPerson" . "{$p}";
                $projcntno = "contactNo" . "{$p}";
                if (isset($this->_post[$projcntName]))
                {
                    //         $str .= $this->_post[$projcntName] . "_" . $this->_post[$projcntContact] . "_".$this->_post[$projcntno]."_";
                    $this->_pdo->exec("INSERT INTO transwise_user ( user_id,name,email,contact,address,timestamp,type,company_id,project_Name) VALUES (
        '" . ProcessForm::generate_id('transwise_user', 'user-') . "',
       '{$this->_post[$projcntContact]}',
       '',
        '{$this->_post[$projcntno]}',
        '',
        " . time() . ",
        '100',
        '{$this->_post['companyID']}',
        '{$this->_post[$projcntName]}'
        )");
                    $arryIndex ++;
                } else
                {
                    $projectCount ++;
                }
            }


            $this->_pdo->commit();

            return true;
        } catch (exception $e)
        {
            $this->_pdo->rollBack();
            echo $e->getMessage();

            return false;
        }

    }
}