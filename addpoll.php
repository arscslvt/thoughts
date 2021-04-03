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
    ?>

    <div class="container">
        <div class="header">
            <span class="logo">THOUGTS</span> 
            <form action="">
                <input type="text" name="search" id="search" placeholder="Cerca" class="search" autocomplete="off">
            </form>
        </div>

        <div class="scrollable">
            <div class='quest'>
                <div>
                    <form action="" class='info'>
                        <input type="text" name="title" id="title" placeholder="What is this poll about?" class="input-space" maxlength="80" required>
                        <div class='reply' id="reply">
                            <input type="text" name="answer[]" placeholder="Enter a reply here" class="input">
                            <input type="text" name="answer[]" placeholder="Enter a reply here" class="input">
                            <input type="text" name="answer[]" placeholder="Enter a reply here" class="input">
                        </div>
                        <input type="button" id="add-field" class="link" value="+ Add a field">
                        <input type="submit" name="sign-in" class="button" value="Pubblica">
                    </form>
                </div>
            </div> 
        </div>

        <a href="index.php"><div class="post light">←</div></a>
    </div>

    <script>
        document.getElementById("title").focus();
        var count = 0;
        document.getElementById("add-field").addEventListener("click", () => {
            if(count < 2){
                var next = document.createElement("input");
                next.type = "text";
                next.classList = "input";
                next.placeholder = "Enter a reply here";
                next.name = "answer[]";
                document.getElementById("reply").appendChild(next);
                count++;
                if(count==2){
                    document.getElementById("add-field").style.display = "none";
                }
            }
        })
    </script>
</body>
</html>