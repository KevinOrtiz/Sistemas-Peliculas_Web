<?php
session_start();
global $db;

function verificar_login($user,$password,&$result)
{
    $db = new PDO('mysql:host=127.0.0.1;dbname=Sistema_Peliculas;charset=utf8mb4','root','263605kevin');
    $sql = $db->query("SELECT * FROM Usuario WHERE usuario=? and contrasena=?");
	$sql->bindValue(1,$user,PDO::PARAM_STR);
    $sql->bindValue(2,$password,PDO::PARAM_STR);
    $sql->execute();
    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
    $count = 0;
    foreach($rows as $row){
        $count++;
        $result = $row;
    }
	if($count == 1)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}


function verificar_login_administrador($user,$password,&$result)
{
    $db = new PDO('mysql:host=127.0.0.1;dbname=Sistema_Peliculas;charset=utf8mb4','root','263605kevin');
    $sql = "SELECT * FROM Administrador WHERE usuario=? and contrasena=?";
	$sql->bindValue(1,$user,PDO::PARAM_STR);
    $sql->bindValue(2,$password,PDO::PARAM_STR);
    $sql->execute();
    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
    $count = 0;
    foreach($rows as $row){
        $count++;
        $result = $row;
    }
	if($count == 1)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

if(isset($_POST['login-submit']))
    {
	if(verificar_login($_POST['username'],$_POST['password'],$result) == 1)
	{
		$_SESSION['userid'] = $result->idusuario;
		header("location:view/usuario.html");
	}
	else
	{
		echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>';
		echo $_POST["username"];
	}
}
elseif(isset($_POST['login-administrador'])){
    if(verificar_login_administrador($_POST['user-administrador'],$_POST['pass-administrador'],$result) == 1){
        $_SESSION['userid'] = $result->idusuario;
        header("location:view/administrador.html");
    
    }
    else{
        echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>';
		echo $_POST["user-administrador"];
    }

}
?>
