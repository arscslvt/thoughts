<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Thoughts</title>
</head>
<body>

    <?php 
        session_start();
        require 'server.php'; 
        $poll = $_GET['poll'];
        $answer = $_GET['ans'];
        $id = $_SESSION['idUser'];

        $query = "INSERT INTO `voting` (`codUser`, `codAnswer`, `codPoll`) VALUES ('$id', '$answer', '$poll');"
    ?>

    <div class="container">
        <div class="header">
            <span class="logo">THOUGTS</span> 
            <form action="">
                <input type="text" name="search" id="search" placeholder="Cerca" class="search" autocomplete="off">
            </form>
        </div>

        <div class="complete">
            <?php
                if($result = mysqli_query($conn, $query)){
                    header("Location: index.php");
                }else{
                    echo "<p class='error'>Errore durante l'aggiornamento di questo poll: " . mysqli_error($conn) . " </p>";
                }
            ?>
           
        </div>

        <a href="index.php"><div class="post light">←</div></a>
    </div>

    <script src="script.js"></script>
</body>
</html>