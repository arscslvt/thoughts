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
        $id = $_SESSION['idUser'];
        

        $verify = "SELECT * FROM voting WHERE codUser = '$id' AND codPoll = '$poll';";
        if($getverify = mysqli_query($conn, $verify)){
            if(mysqli_num_rows($getverify) == 0){
                header("Location: index.php");
            }
        }
    ?>

    <div class="container">
        <div class="header">
            <span class="logo">THOUGTS</span> 
            <form action="">
                <input type="text" name="search" id="search" placeholder="Cerca" class="search" autocomplete="off">
            </form>
        </div>

        <div class="scrollable">
            <?php
                $query = "SELECT * FROM poll, user WHERE poll.codUser = user.idUser AND idPoll = '$poll'";
                if($result = mysqli_query($conn, $query)){
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

                            $answers = "SELECT * FROM answer WHERE codPoll = $poll";
                            $getanswers = mysqli_query($conn, $answers) or die ("Non sono riuscito a scaricare gli ultimi post: " . mysqli_error($conn));
    
                            if(mysqli_num_rows($getanswers) > 0){
                                while ($a = mysqli_fetch_array($getanswers, MYSQLI_ASSOC)){
                                    $ans = $a['answ'];
                                    $ans_id = $a['idAnswer'];

                                    $votes = "SELECT COUNT(codUser) AS tot FROM voting WHERE codAnswer = '$ans_id' ORDER BY tot";
                                    $getvotes = mysqli_query($conn, $votes) or die ("Non sono riuscito a scaricare gli ultimi post: " . mysqli_error($conn));
                                    if(mysqli_num_rows($getvotes) > 0){
                                        while ($v = mysqli_fetch_array($getvotes, MYSQLI_ASSOC)){
                                            echo "<p class='check'>" . $ans . " - " . $v['tot'] ."</a>";
                                        }
                                    }else{
                                        echo "<p class='check'>" . $ans . " - 0</a>";
                                    }
                                }
                                echo "</div>
                                    <p class='link' id='sharebt'>Share with friends ⌲</p>
                                    <div class='share' id='share'>
                                        <p class='title'>👀 Share this link with your friends.</p>
                                        <input type='text' name='share-link' id='share-link' class='input-w' value='http://" . $_SERVER['SERVER_NAME'] . "/poll.php?poll=" . $poll . "' readonly>
                                    </div>
                                        </div>
                                        </div> 
                                ";
                            }
                        }
                    }
                }
            ?>
           
        </div>

        <a href="index.php"><div class="post light">←</div></a>
    </div>

    <script src="share.js"></script>
</body>
</html>