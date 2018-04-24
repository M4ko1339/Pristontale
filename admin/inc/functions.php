<?php

Class User
{
    public function Login($username, $password)
    {
        global $con;

        $data = $con->prepare('SELECT COUNT(*) FROM users WHERE username = :username AND password = :password');
        $data->execute(array(
            ':username' => $username,
            ':password' => sha1($password)
        ));

        if($data->fetchColumn() == 1)
        {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = sha1($password);

            return true;
        }
        else
        {
            return false;
        }
    }

    public function Access($username)
    {
        global $con;

        $data = $con->prepare('SELECT * FROM users WHERE username = :username');
        $data->execute(array(
            ':username' => $username
        ));

        foreach($data->fetchAll(PDO::FETCH_ASSOC) as $row)
        {
            return $row['access'];
        }
    }

    public function Logout()
    {
        if(isset($_SESSION['username']) && isset($_SESSION['password']))
        {
            if(isset($_GET['logout']) && $_GET['logout'] == 'true')
            {
                session_destroy();
                header('Location: login.php');
                exit;
            }
        }
    }
}

Class Admin
{
    public function Transactions()
    {
        global $con;

        $data = $con->prepare('SELECT * FROM transactions ORDER BY tdate DESC');
        $data->execute();

        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Purchases()
    {
        global $con;

        $data = $con->prepare('SELECT * FROM purchases ORDER BY order_date DESC');
        $data->execute();

        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
