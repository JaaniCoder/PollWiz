<?php
    session_start();
    if(!isset($_SESSION['userdata'])) {
        header("location: ../login.html");
    }

    $userdata = $_SESSION['userdata'];
    $partiesdata = $_SESSION['partiesdata'];

    if($_SESSION['userdata']['status']==0) {
        $status = '<b style="color:red">Not Voted</b>';
    }
    else {
        $status = '<b style="color:green">Voted</b>';
    }
?>
<html>
    <head>
        <title>PollWiz - Dashboard</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" type="image/x-icon" href="../pollwiz.png">
    </head>
    <body>
        <style>
            body {
                text-align: left;
            }
            #backbtn {
                padding: 5px;
                font-size: 15px;
                border-radius: 5px;
                background-color: skyblue;
                color: whitesmoke;
                float: left;
                margin: 10px;
            }
            #logoutbtn {
                padding: 5px;
                font-size: 15px;
                border-radius: 5px;
                background-color: skyblue;
                color: whitesmoke;
                float: right;
                margin: 10px;
            }
            #Profile {
                background-color: white;
                width: 35%;
                padding: 20px;
                float: left;
            }
            #Party {
                background-color: white;
                width: 55%;
                padding: 20px;
                float: right;   
            }
            #votebtn {
                padding: 5px;
                font-size: 15px;
                border-radius: 5px;
                background-color: skyblue;
                color: whitesmoke;
            }
            #mainpanel {
                padding: 10px;
            }
            #voted {
                padding: 5px;
                font-size: 15px;
                border-radius: 5px;
                color: whitesmoke;
                background-color: green;
            }
        </style>

        <div id="main">

            <div id="header">
            <a href="../login.html"><button id="backbtn">Back</button></a>
            <a href="logout.php"><button id="logoutbtn">Logout</button></a>
            <center>
                <h1>PollWiz - Every Vote Matters</h1>
            </center>
            </div>
            <hr>
            <div id="mainpanel">
            <div id="Profile">
                <center><img src="../upload/<?php echo $userdata['photo'] ?>" height="100" width="100"> </center> <br> <br>
                <b>Name: </b> <?php echo $userdata['name'] ?> <br> <br>
                <b>Mobile No. : </b> <?php echo $userdata['mobile'] ?> <br> <br>
                <b>Address: </b> <?php echo $userdata['address'] ?> <br> <br>
                <b>Status: </b> <?php echo $status ?> <br> <br>
            </div>
            <div id="Party">
                <?php
                    if($_SESSION['partiesdata']) {
                        for ($i=0; $i<count($partiesdata); $i++) {
                            ?>
                            <div>
                                <img style="float:right" src="../upload/<?php echo $partiesdata[$i]['photo']?>" height="100" width="100"> <br> <br>
                                <b>Party Name: </b> <?php echo $partiesdata[$i]['name'] ?> <br> <br>
                                <b>Votes: </b> <?php echo $partiesdata[$i]['votes'] ?> <br> <br>
                                <form action="../api/vote.php" method="post">
                                    <input type="hidden" name="pvotes" value="<?php echo $partiesdata[$i]['votes'] ?>">
                                    <input type="hidden" name="pid" value="<?php echo $partiesdata[$i]['id'] ?>">
                                    <?php
                                        if($_SESSION['userdata']['status']==0) {
                                            ?>
                                            <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>
                                            <?php
                                        }
                                    ?>
                                </form>
                            </div>
                            <hr>
                            <?php
                        }
                    }
                    else {

                    }
                ?>
                </div>
            </div>
        </div>
    </body>
</html>