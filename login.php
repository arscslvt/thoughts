<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Login to Thoughts</title>
</head>
<body>

    <?php 
        session_start();
        require 'server.php'; 
    ?>

    <div class="container">
        <div class="header">
            <span class="logo">THOUGTS</span> 
        </div>
        <div class="login">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="text" name="username" id="username" class="input" placeholder="username">
                <input type="password" name="password" id="password" class="input" placeholder="password">
                <input type="submit" name="sign-in" class="button" value="Sign in">
                <p><input type="submit" name="sign-up" value="or Sign up" class="link"></p>
            </form>
        </div>

        <?php

            if(isset($_POST['sign-in'])){
                $user = $_POST['username'];
                $pass = $_POST['password'];
                $test = "test";

                $query = "SELECT * FROM user WHERE username = '$user' AND pass = '$pass';";
                if($result = mysqli_query($conn, $query)){
                    if(mysqli_num_rows($result) === 1){
                        $row = mysqli_fetch_assoc($result);
                        $_SESSION['idUser'] = $row['idUser'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['name'] = $row['nome'];
                        if($row['email']){
                            $_SESSION['email'] = $row['email'];
                        }

                        header("Location: index.php");
                        exit();
                    }else{
                        echo "<p class='error'>Queste credenziali non sono valide, riprova ad inserirle nuovamente.</p>";
                    }
                }
            }

            if(isset($_POST['sign-up'])){
                $user = $_POST['username'];
                $pass = $_POST['password'];

                $query = "  INSERT INTO `user` (`username`, `pass`) 
                            VALUES ('$user', '$pass');
                        ";
                        
                if($result = mysqli_query($conn, $query)){
                    echo "<p class='error'>Registrazione completata con successo. Adesso, effettua il login con i dati che hai appena inserito.</p>";
                }
                else{
                    echo "<p class='error'>Errore durante la creazione di un account con questi dati forniti</p>" . mysqli_error($conn);
                }
            }

            if($_GET['set'] == "logout"){
                session_start();
                session_unset();
                session_destroy();

                // header("Location: index.php");
                echo "<p class='error'>Sei uscito dal tuo account.</p>";
            }

        ?>
    </div>
    <script src="script.js"></script>
</body>
</html>