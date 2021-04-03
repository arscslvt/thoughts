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
        if(!$_SESSION['idUser']){
            header("Location: login.php?poll=idpoll");
        }else{
            $id = $_SESSION['idUser'];
        }
        require 'server.php'; 
    ?>
    <div class="container">
        <div class="header">
            <div class="title-bar">
                <a href="login.php?set=logout"><button class="link">< Logout</button></a>
                <span class="logo">THOUGTS</span>
                <a href=""><button class="link right"><?php echo $_SESSION['username'] ?></button></a>
            </div>
            <form action="">
                <input type="text" name="search" id="search" placeholder="Cerca" class="search" autocomplete="off">
            </form>
        </div>
        <div class="scrollable">
            <?php
                $query = "SELECT * FROM poll, user WHERE poll.codUser = user.idUser";

                $result = mysqli_query($conn, $query) or die ("Impossibile trovare questo poll: " . mysqli_error($conn));

                if(mysqli_num_rows($result) > 0){
                
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        if($row['view'] == 1){
                            $author = "👻 Anonimo";
                        }else{
                            $author = $row['username'];
                        }

                        echo "
                            <div class='quest'>
                                <p><span class='author'>" . $author . "</span><span class='pdate'>del " . $row['createdAt'] . "</span></p>
                                <div class='info'>
                                    <p class='title'>" . $row['title'] . "</p>
                                    <div class='reply'>";

                            $poll_id = $row['idPoll'];
                            
                            // CHECK ANSWER
                            $check = "SELECT * FROM voting WHERE codUser = '$id' AND codPoll = '$poll_id'";
                            if($getCheck = mysqli_query($conn, $check)){
                                if(mysqli_num_rows($getCheck) === 1){
                                    echo "<a href='viewpoll.php?poll=" . $poll_id . "' class='viewpoll'><p class='check'>✅ Hai votato, vedi i risultati ></p></a>";
                                }else{
                                    $answers = "SELECT * FROM answer WHERE codPoll = $poll_id";
                                    $getanswers = mysqli_query($conn, $answers) or die ("Non sono riuscito a scaricare gli ultimi post: " . mysqli_error($conn));

                                    if(mysqli_num_rows($getanswers) > 0){
                                        while ($a = mysqli_fetch_array($getanswers, MYSQLI_ASSOC)){
                                            $ans = $a['idAnswer'];
                                            echo "<a href='refresh-poll.php?ans=" . $ans . "&poll=" . $poll_id . "'><input type='button' value='" . $a['answ'] . "' class='select'></a>";
                                        }
                                        echo "</div>
                                                </div>
                                                </div> 
                                        ";
                                    }
                                }
                        }else{
                            echo "Errore durante l'ottenimento delle risposte disponibili";
                        }
                    }
                }else{
                    echo "<p class='error'>❗️ Sto riscontrando dei problemi con la connessione al server. Riprova più tardi.</p>";
                }
            ?>
        </div>

        <a href="addpoll.php"><div class="post deep">+</div></a>
    </div>
</body>
</html>