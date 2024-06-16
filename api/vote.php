<?php
    session_start();
    include("connect.php");

    $votes = $_POST['pvotes'];
    $total_votes = $votes+1;
    $pid = $_POST['pid'];
    $uid = $_SESSION['userdata']['id'];

    $update_votes = mysqli_query($connect, "UPDATE user SET votes = '$total_votes' WHERE id='$pid' ");
    $update_user_status = mysqli_query($connect, "UPDATE user SET status=1 WHERE id='$uid' ");

    if($update_votes and $update_user_status) {
        $parties = mysqli_query($connect, "SELECT * FROM user WHERE role=2");
        $partiesdata = mysqli_fetch_all($parties, MYSQLI_ASSOC);
        $_SESSION['userdata']['status'] = 1;
        $_SESSION['partiesdata'] = $partiesdata;
        echo "
            <script>
                alert('Voting successful.');
                window.location = '../routes/dashboard.php';
            </script>
        ";
    }
    else {
        echo "
            <script>
                alert('Some error occured.');
                window.location = '../routes/dashboard.php';
            </script>
        ";
    }

?>