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

Class News
{
    public function All()
    {
        global $con;

        $data = $con->prepare('SELECT * FROM news ORDER BY id DESC');
        $data->execute();

        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Show($id)
    {
        global $con;

        $data = $con->prepare('SELECT * FROM news WHERE id = :id');
        $data->execute(array(
            ':id' => (int)$id
        ));

        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Add($title, $banner, $content)
    {
        global $con;

        $data = $con->prepare('INSERT INTO news (news_title, news_banner, news_content, post_date)
        VALUES(:title, :banner, :content, :pdate)');
        $data->execute(array(
            ':title'   => $title,
            ':banner'  => $banner,
            ':content' => nl2br($content),
            ':pdate'   => time()
        ));
    }

    public function Edit($id, $title, $banner, $content)
    {
        global $con;

        $data = $con->prepare('UPDATE news SET news_title = :title, news_banner = :banner, news_content = :content WHERE id = :id');
        $data->execute(array(
            ':id'      => (int)$id,
            ':title'   => $title,
            ':banner'  => $banner,
            ':content' => $content
        ));
    }

    public function Delete($id)
    {
        global $con;

        $data = $con->prepare('DELETE FROM news WHERE id = :id');
        $data->execute(array(
            ':id' => (int)$id
        ));
    }


    public function Duplicate($title)
    {
        global $con;

        $data = $con->prepare('SELECT COUNT(*) FROM news WHERE news_title = :title');
        $data->execute(array(
            ':title' => $title
        ));

        if($data->fetchColumn() == 1)
        {
            return true;
        }
        else
        {
            return false;
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
