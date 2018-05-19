<?php

Class News
{
    public function View($id)
    {
        global $con;

        $data = $con->prepare('SELECT * FROM news WHERE id = :id');
        $data->execute(array(
            ':id' => (int)$id
        ));

        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Exist($id)
    {
        global $con;

        $data = $con->prepare('SELECT COUNT(*) FROM news WHERE id = :id');
        $data->execute(array(
            ':id' => (int)$id
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

    public function Show()
    {
        global $con;

        $data = $con->prepare('SELECT * FROM news ORDER BY id DESC');
        $data->execute();

        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
}


Class User
{
    public function Register($username, $email, $password)
    {
        global $con_game;

        $table = strtoupper(substr($username, 0, 1)) . 'GameUser';

        $data = $con_game->prepare("INSERT INTO AllGameUser ([userid],[Passwd],[RegistDay],[DisuseDay],[inuse],[Grade],[EventChk],[SelectChk],[BlockChk],[SpecialChk],[Credit],[DelChk],[Channel],[email])
        VALUES(:username,:password,GETDATE(),'12-12-2020','0','U','0','0','0','0','0','0',:ip,:email)");
        $data->execute(array(
            ':username' => $username,
            ':email'    => $email,
            ':password' => $password,
            ':ip'       => $_SERVER['REMOTE_ADDR']
        ));

        $data = $con_game->prepare("INSERT INTO $table ([userid],[Passwd],[RegistDay],[DisuseDay],[inuse],[Grade],[EventChk],[SelectChk],[BlockChk],[SpecialChk],[Credit],[DelChk],[Channel],[email])
        VALUES(:username,:password,GETDATE(),'12-12-2020','0','U','0','0','0','0','0','0',:ip,:email)");
        $data->execute(array(
            ':username' => $username,
            ':email'    => $email,
            ':password' => $password,
            ':ip'       => $_SERVER['REMOTE_ADDR']
        ));
    }

    public function Login($username, $password)
    {
        global $con_game;

        $data = $con_game->prepare('SELECT COUNT(*) FROM AllGameUser WHERE [userid] = :username AND [Passwd] = :password');
        $data->execute(array(
            ':username' => $username,
            ':password' => $password
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

    public function Captcha($ip)
    {
        global $config;

        $captcha  = $_POST['g-recaptcha-response'];

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $config['CAPTCHA_SECRET'] . "&response=" . $captcha . "&remoteip=" . $ip);
		$decode   = json_decode($response, true);

        if(intval($decode['success']) == 1)
		{
			return true;
		}

		return false;
    }

    public function Duplicate($username)
    {
        global $con_game;

        $table = strtoupper(substr($username, 0, 1)) . 'GameUser';

        $data = $con_game->prepare("SELECT COUNT(*) FROM AllGameUser WHERE [userid] = :username");
        $data->execute(array(
            ':username' => $username
        ));

        if($data->fetchColumn() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function ChangePassword($username, $oldpassword, $newpassword)
    {
        global $con_game;

        $data = $con_game->prepare('SELECT COUNT(*) FROM AllGameUser WHERE [userid] = :username AND [Passwd] = :password');
        $data->execute(array(
            ':username' => $username,
            ':password' => $oldpassword
        ));

        if($data->fetchColumn() == 1)
        {
            $table = strtoupper(substr($username, 0, 1)) . 'GameUser';

            $data = $con_game->prepare('UPDATE AllGameUser SET [Passwd] = :password WHERE [userid] = :username');
            $data->execute(array(
                ':password' => $newpassword,
                ':username' => $username
            ));

            $data = $con_game->prepare("UPDATE $table SET [Passwd] = :password WHERE [userid] = :username");
            $data->execute(array(
                ':password' => $newpassword,
                ':username' => $username
            ));

            return true;
        }
        else
        {
            return false;
        }
    }

    public function ChangeEmail($username, $newemail)
    {
        global $con_game;

        $data = $con_game->prepare('SELECT COUNT(*) FROM AllGameUser WHERE [userid] = :username');
        $data->execute(array(
            ':username' => $username
        ));

        if($data->fetchColumn() == 1)
        {
            $table = strtoupper(substr($username, 0, 1)) . 'GameUser';

            $data = $con_game->prepare('UPDATE AllGameUser SET [email] = :email WHERE [userid] = :username');
            $data->execute(array(
                ':email' => $newemail,
                ':username' => $username
            ));

            $data = $con_game->prepare("UPDATE $table SET [email] = :email WHERE [userid] = :username");
            $data->execute(array(
                ':email' => $newemail,
                ':username' => $username
            ));

            return true;
        }
        else
        {
            return false;
        }
    }

    public function EmailExists($email)
    {
        global $con_game;

        $data = $con_game->prepare('SELECT COUNT(*) FROM AllGameUser WHERE [email] = :email');
        $data->execute(array(
            ':email' => $email
        ));

        if($data->fetchColumn() == 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function UserCP($username, $column)
    {
        global $con_game;

        $data = $con_game->prepare('SELECT * FROM AllGameUser WHERE [userid] = :username');
        $data->execute(array(
            ':username' => $username
        ));

        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $row)
        {
            return $row[$column];
        }
    }

    public function Balance($username)
    {
        global $con;

        $data = $con->prepare('SELECT * FROM coins WHERE username = :username');
        $data->execute(array(
            ':username' => $username
        ));

        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $row)
        {
            $balance = $row['coins'];
        }

        if($balance < 1)
        {
            return 0;
        }
        else
        {
            return $balance;
        }
    }
}


Class Game
{
    public function Download($ip, $type)
    {
        global $con;
        global $config;

        $data = $con->prepare('INSERT INTO downloads (ip_address, type)
        VALUES(:ip, :type)');
        $data->execute(array(
            ':ip'   => $ip,
            ':type' => $type
        ));

        if($type == 'zip')
        {
            header('Location: ' . $config['ZIP_DOWNLOAD']);
            exit;
        }
        elseif($type == 'installer')
        {
            header('Location: ' . $config['INSTALLER_DOWNLOAD']);
            exit;
        }
        else
        {
            die('Something went wrong, please contact administration!');
        }
    }
}

Class Order
{
    public function OrderID($orderid)
    {
        global $con;

        $data = $con->prepare('SELECT * FROM transactions WHERE order_id = :orderid');
        $data->execute(array(
            ':orderid' => $orderid
        ));

        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Check($orderid)
    {
        global $con;

        $data = $con->prepare('SELECT COUNT(*) FROM transactions WHERE order_id = :orderid');
        $data->execute(array(
            ':orderid' => $orderid
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

Class Shop
{
    public function Items()
    {
        global $con;

        $data = $con->prepare('SELECT * FROM shop');
        $data->execute();

        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ItemID($id)
    {
        global $con;

        $data = $con->prepare('SELECT * FROM shop WHERE id = :id');
        $data->execute(array(
            ':id' => $id
        ));

        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Check($id)
    {
        global $con;

        $data = $con->prepare('SELECT COUNT(*) FROM shop WHERE id = :id');
        $data->execute(array(
            ':id' => $id
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

    public function Order($username, $name, $itemid)
    {
        global $con;

        $data = $con->prepare('SELECT COUNT(*) FROM coins WHERE username = :username');
        $data->execute(array(
            ':username' => $username
        ));

        if($data->fetchColumn() == 1)
        {
            $data = $con->prepare('SELECT * FROM coins WHERE username = :username');
            $data->execute(array(
                ':username' => $username
            ));

            $result = $data->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $row)
            {
                $balance = $row['coins'];
            }

            $data = $con->prepare('SELECT * FROM shop WHERE id = :id');
            $data->execute(array(
                ':id' => $itemid
            ));

            $result = $data->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $row)
            {
                $item_price = $row['item_price'];
                $item_name  = $row['item_name'];
            }

            if($item_price <= $balance)
            {
                function Coins($username)
        		{
        			global $con;

        			$data = $con->prepare('SELECT * FROM coins WHERE username = :username');
        			$data->execute(array(
        				':username' => $username
        			));

        			foreach($data->fetchAll(PDO::FETCH_ASSOC) as $row)
        			{
        				return $row['coins'];
        			}
        		}

                $data = $con->prepare('UPDATE coins SET coins = :coins WHERE username = :username');
                $data->execute(array(
                    ':coins'    => Coins($username)-$item_price,
                    ':username' => $username
                ));

                $data = $con->prepare('INSERT INTO purchases (order_id, username, name, item_id, item_name, item_price, order_date)
                VALUES(:orderid, :username, :name, :itemid, :itemname, :itemprice, :odate)');
                $data->execute(array(
                    ':orderid'   => uniqid(),
                    ':username'  => $username,
                    ':name'      => $name,
                    ':itemid'    => $itemid,
                    ':itemname'  => $item_name,
                    ':itemprice' => $item_price,
                    ':odate'     => time()
                ));

                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}

Class Logging
{
    public function Action($username, $page, $action)
    {
        global $con;

        $data = $con->prepare('INSERT INTO logs (page, username, action, ip_address, log_date)
        VALUES(:page, :username, :action, :ip, :logdate)');
        $data->execute(array(
            ':page'     => $page,
            ':username' => $username,
            ':action'   => $action,
            ':ip'       => $_SERVER['REMOTE_ADDR'],
            ':logdate'  => time()
        ));
    }
}

Class Datafile
{
    public function Write($filename, $name, $item, $class = 0, $message = "Bought Item")
    {
        global $con;
        global $con_game;

        $dir  = "";

        $data = $name . " " . $item . " " . $class . " " .'"' . $message . '"' . "\r\n";

        $fp    = fopen($dir . $filename, 'w');
        $write = fwrite($fp, $data);
        fclose($fp);
    }

    public function Read($filename)
    {
        global $con;
        global $con_game;


    }
}

Class Store
{
    var $root = "";

    public function UserInfo($file)
    {
        global $con_game;

        $files = scandir($root . $dir, 1);

        print_r($files);
    }
}

Class Ranking
{
    public function Level()
    {
        global $con_clan;

        $data = $con_clan->prepare("SELECT TOP 50 * FROM playerlevels ORDER BY ChLv DESC");
        $data->execute();

        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
}

/*
$dirUserInfo = $rootDir."DataServer/userinfo/";    // rootdir  = dir server

$charInfo=$dirUserInfo . ($func->numDir($qCharID)) . "/" . $qCharID . ".dat";

if(!file_exists($charInfo))
{
    copy("criarchars/info.dat",$dirUserInfo . ($func->numDir($qCharID)) . "/" . $qCharID. ".dat");

    $fRead=false;
    $fOpen = fopen($charInfo, "r");
    while (!feof($fOpen)) {
    @$fRead = "$fRead" . fread($fOpen, filesize($charInfo) );
    }
    fclose($fOpen);

    // Change character class ----------------------------------------------------------------
    $sourceStr = substr($fRead, 0, 16) . $writeAccName . substr($fRead, 26);
    $fOpen = fopen($charInfo, "wb");
    fwrite($fOpen, $sourceStr, strlen($sourceStr));
    fclose($fOpen);

    echo "<br><center><font color=#CC0000><b>Aviso:</b></font><br><br>- FILE ID CREATED!<br><br><br>";
}

83.128.56.65 Is the gameserver IP
It's stored here.
C:\Users\agency\Desktop\Pristontale EU\Server\DataServer\userinfo
*/

?>
