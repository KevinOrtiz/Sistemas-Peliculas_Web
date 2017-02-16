<?php
session_start();
header("X-XSS-Protection: 0");
global $db;
$db=new PDO('mysql:host=127.0.0.1;dbname=Sistema_Peliculas;charset=utf8mb4','root','263605kevin');

function verificar_login($user,$password,&$result,$db)
{
    $sql = $db->prepare("SELECT * FROM Usuario WHERE usuario=:usuario and contrasena=:contrasena");
    $sql->execute(array(':usuario'=>$user,':contrasena'=>$password));
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


function verificar_login_administrador($user,$password,&$result,$db)
{
    $sql = $db->prepare("SELECT * FROM Administrador WHERE usuario=:usuario and contrasena=:contrasena");
    $sql->execute(array(':usuario'=>$user,':contrasena'=>$password));
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
function ingresar_nuevo_usuario($nombre,$apellido,$user,$contrasena,$db){
	$sql = $db->prepare("INSERT INTO Usuario(nombre,apellido,usuario,contrasena) VALUES (:nombre,:apellido,:usuario,:contrasena)");
    $sql->execute(array(':nombre'=>$nombre,':apellido'=>$apellido,':usuario'=>$user,':contrasena'=>$contrasena));
	return 1;	
}
if(isset($_POST['login-submit']))
    {
	if(verificar_login($_POST['username'],$_POST['password'],$result,$db) == 1)
	{
		$_SESSION['userid'] = $result->idusuario;
		echo $_POST["username"];
		header("location:view/usuario.html");
	}
	else
	{
		
		echo $_POST["username"];
		echo ("<div>usuario no autorizado</div>");
		
	}
}
elseif(isset($_POST['login-administrador'])){
    if(verificar_login_administrador($_POST['user-administrador'],$_POST['pass-administrador'],$result,$db) == 1){
        $_SESSION['userid'] = $result->idusuario;
		echo $_POST["user-administrador"];
		header("location:view/administrador.html");
    
    }
    else{
		
		echo $_POST["user-administrador"];
		echo ("<div>usuario no autorizado</div>");
		
		
    }

}

elseif(isset($_POST['register-submit'])){
	if(ingresar_nuevo_usuario($_POST['nombre'],$_POST['apellido'],$_POST['username'],$_POST['password'],$db) == 1){
		$descripcion = "se ingresa correctamente el usuario";
		echo $_POST["nombre"].$descripcion;

	}

}
?>
