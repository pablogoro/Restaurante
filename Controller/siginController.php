<?php
if(isset($_POST['button-login'])){
    require_once '../controller/validate.php';
    require_once '../controller/conexion.php';


    $dni = $_POST['dni'];
    $contraseña = $_POST['password'];
    $pass = sha1($contraseña);



    if (registroCamposVacios($dni, $contraseña) != false) {

        echo "<script>window.location.href='./logval.php?error=camposvacios'</script>";
        exit();
    }

    if (validaDNI($dni) !== false) {
        echo "mal";
        echo "<script>window.location.href='./logval.php?error=validadni'</script>";
        exit();
    }
    $stmt = $pdo->prepare("select * from tbl_cliente where Dni_cli=? and Password_cli=?");
    $stmt-> bindParam(1,$dni);
    $stmt-> bindParam(2,$pass);
    $stmt->execute();
    # Ver cuántas filas devuelve
    $numeroDeFilas = $stmt->rowCount();

    if ($numeroDeFilas==0){
        $stmt = $pdo->prepare("select * from tbl_camarero where Dni_cam=? and Password_cam=?");
        $stmt-> bindParam(1,$dni);
        $stmt-> bindParam(2,$pass);
        $stmt->execute();
        # Ver cuántas filas devuelve
        $numeroDeFilas1 = $stmt->rowCount();
        if ($numeroDeFilas1==0){
            $stmt = $pdo->prepare("select * from tbl_mantenimiento where Dni_man=? and Password_man=?");
            $stmt-> bindParam(1,$dni);
            $stmt-> bindParam(2,$pass);
            $stmt->execute();
            # Ver cuántas filas devuelve
            $numeroDeFilas2 = $stmt->rowCount();
            if ($numeroDeFilas2==0){
                $stmt = $pdo->prepare("select * from tbl_admin where Dni_adm=? and Password_adm=?");
                $stmt-> bindParam(1,$dni);
                $stmt-> bindParam(2,$pass);
                $stmt->execute();
                # Ver cuántas filas devuelve
                $numeroDeFilas3 = $stmt->rowCount();
                if ($numeroDeFilas3==0){
                    echo "<script>window.location.href = '../index.php?error=true'</script>";
                }else{
                    session_start();
                    $_SESSION['dni']=$dni;
                    $_SESSION['nombre']=$nombre;
                    $_SESSION['apellido']=$apellido;
                    $_SESSION['telf']=$telf;
                    $_SESSION['email']=$email;
                    $_SESSION['rol']="admin";
                    echo "<script>window.location.href = '../Views/principal.php'</script>";
                }
            }else{
                session_start();
                $_SESSION['dni']=$dni;
                $_SESSION['nombre']=$nombre;
                $_SESSION['apellido']=$apellido;
                $_SESSION['telf']=$telf;
                $_SESSION['email']=$email;
                $_SESSION['rol']="mant";
                echo "<script>window.location.href = '../Views/principal.php'</script>";
            }
        }else{
            session_start();
            $_SESSION['dni']=$dni;
            $_SESSION['nombre']=$nombre;
            $_SESSION['apellido']=$apellido;
            $_SESSION['telf']=$telf;
            $_SESSION['email']=$email;
            $_SESSION['rol']="cam";
            echo "<script>window.location.href = '../Views/principal.php'</script>";
        }
        echo "<script>window.location.href = '../index.php?error=true'</script>";
    }else{
        session_start();
        $_SESSION['dni']=$dni;
        $_SESSION['nombre']=$nombre;
        $_SESSION['apellido']=$apellido;
        $_SESSION['telf']=$telf;
        $_SESSION['email']=$email;
        $_SESSION['rol']="cli";
        echo "<script>window.location.href = '../Views/home.php'</script>";
    }

// if (errorEmail($correo) !== FALSE) {
//     header('Location:logval.php?error=erroremail');
//     exit();
// }
// echo $num;


}else{
    echo "<script>window.location.href = '../Index.php' </script>";
}
