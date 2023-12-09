<?php
        print_r($_POST);  //visualizar los datos enviados crudos

        $id =$_POST["id"]; 
        $nombre=$_POST["nombreUsuario"];
        $pwd=$_POST["contrasena"];
        $email=$_POST["correo"];
        $rol=$_POST["rol"];

        include('conection.php');

        $consulta = "UPDATE usuarios SET usuario='".$nombre."', contrasena='".$pwd."', correo='".$email."', rol= '".$rol."' where id=".$id;
        echo $consulta;
        if ($hazconsulta = mysqli_query($conn,$consulta) or die(" no pudo modificarse el registro de la BD")) {	 
        echo "El registro se ha actualizado"; } 
        header("location: cuentas_admins.php");

?>