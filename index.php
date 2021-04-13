<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php  
// define variables en valores vacio  
$nameErr = $emailErr = $passErr = "";  
$name = $email = $pass = "";  
  
//Recibimos los campos a validar por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
      
    //validamos el nombre
    if (empty($_POST["name"])) {  
         $nameErr = "Nombre es requerido";  
    }
    elseif(strlen($_POST["name"]) > 15){
        $nameErr = "Nombre muy largo (Mayor a 15 caracteres)";
    } 
    else {  
        $name = input_data($_POST["name"]);  
            // comprobamos que el nombre no contenga mas que letras y espacios 
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {  
                $nameErr = "Solo letras y espacios son permitidos";  
            }  
    }  
      
    //validamos el email.  
    if (empty($_POST["email"])) {  
            $emailErr = "Email es requerido";  
    } else {  
            $email = input_data($_POST["email"]);  
            // confirmamos la estructura del email  
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
                $emailErr = "email no valido";  
            }  
     }  
      
    //validamos la contraseña     
    if (empty($_POST["pass"])) {  
        $passErr = "Ingrese una contraseña por favor";  
    } else {  
            $pass = input_data($_POST["pass"]);   
    }   
}  
function input_data($data) {  
  $data = trim($data);  
  $data = stripslashes($data);  
  $data = htmlspecialchars($data);  
  return $data;  
}  
?>  

    <!--Formulario-->
  <div class="container">
    <header>
      <h1 id="title">Formulario</h1>
    </header>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="survey-form">
      <div id="form-group">
        <label id="name-label"for="name">Name</label>
        <span class="error">* <?php echo $nameErr; ?> </span>  
        <input 
          id="name"
          type="text"
          name="name"
          class="form-control"
          placeholder="Tu Nombre"
        />
      </div>
      <div class="form-group">
        <label id="email-label"for="email">Email</label>
        <span class="error">* <?php echo $emailErr; ?> </span>  
        <input 
         type="email"
         id="email"
         name="email"
         class="form-control"
         placeholder="E-mail"
        />
      </div>
      <div class="form-group">
        <label id="password-label" for="pass">Contraseña</label>
        <span class="error">* <?php echo $passErr; ?> </span>  
        <input
          type="password"
          name="pass"
          id="password"
          class="form-control"
        />
      </div>
      <div class="form-group">
        <button type="submit" name ="submit" id="submit" class="submit-button">
          Enviar</button>
      </div>
    </form>
  </div>
  <!--Mostramos los datos si se ingresaro correctamente.-->
  <?php  
    if(isset($_POST['submit'])) {  
    if($nameErr == "" && $emailErr == "" && $passErr =="") {  
        echo "<h3 color = #FF0001> <b>Te has registrado exitosamente.</b> </h3>";  
        echo "<h2>Tus datos:</h2>";  
        echo "nombre: " .$name;  
        echo "<br>";  
        echo "Email: " .$email;    
    } else {  
        echo "<h3> <b>El formulario no se ha completado.</b> </h3>";  
    }  
    }  
?>  
</body>
</html>