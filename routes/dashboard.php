<?php
 session_start();
 if(!isset($_SESSION['userdata'])){
    header("location: ../");
 }

 $userdata = $_SESSION['userdata'];
 $groupdata = $_SESSION['groupdata'];

 if($_SESSION['userdata']['status'] == 0){
    $status = '<b style="color:red">Not Voted</b>';
 }
 else{
    $status = '<b style="color:green"> Voted</b>';
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registerStyle.css"/>
    <title>Dashboard</title>
</head>
<body>

<style>
    #backbtn{
        padding:10px;
    margin: 10px;;
    font-size: 15px;
    border-radius: 5px;
    float:left;
    /* margin-right: 30px; */
}
#backbtn:hover{
    background-color: pink;
    cursor: pointer;
}
#logoutbtn{
        padding:10px;
    margin: 10px;;
    font-size: 15px;
    border-radius: 5px;
    float:right;
    /* margin-right: 30px; */
}
#logoutbtn:hover{
    background-color: pink;
    cursor: pointer;
}
#Profile{
    background-color:white;
    width:27%;
    padding:20px;
    margin:20px;
    float: left;
}
#Group{
    background-color:white;
    width:60%;
    padding:20px;
    margin:20px;
    float: right;
}
#votebtn{
    padding:10px;
    margin: 10px;;
    font-size: 15px;
    border-radius: 5px;
    float:left;
}
#votebtn:hover{
    background-color: pink;
    cursor: pointer;
}
#mainpanel{
    padding: 10px;
}
#voted{
    padding:10px;
    margin: 10px;;
    font-size: 15px;
    border-radius: 5px;
    background-color:green;
}
</style>
<div id="mainSection">
<div id="headerSection">
    <a href="../"><button id="backbtn">Back</button></a>
    <a href="logout.php"><button id="logoutbtn">Logout</button></a>
    <h1>Online Voting System</h1>
</div>
    <hr>
   <div id="mainpanel">
   <div id="Profile">
        <center><img src="../uploads/<?php echo $userdata['photo']?>" height="100" width="100"></center><br><br>
        <b>Name: </b> <?php echo $userdata['name']?> <br><br>
        <b>Mobile: </b> <?php echo $userdata['mobile']?> <br><br>
        <b>Address: </b> <?php echo $userdata['address']?> <br><br>
        <b>Status: </b> <?php echo $status?> <br><br>
</div>
<div id="Group">
    <?php
    if($_SESSION ['groupdata']){
        for($i=0; $i<count($groupdata); $i++){
            ?>
            <div>
                <img style="float:right"  src="../uploads/<?php echo $groupdata[$i]['photo'] ?>" height="100" width="100">
                <b>Group Name: </b><?php echo $groupdata[$i]['name']?><br><br>
                <b>Votes: </b><?php echo $groupdata[$i]['votes']?><br><br>
                <form action="../api/vote.php" method="POST">
                    <input type="hidden" name="gvotes" value="<?php echo $groupdata[$i]['votes'] ?>">
                    <input type="hidden" name="gid" value="<?php echo $groupdata[$i]['id'] ?>">
                    <?php
                    if($_SESSION['userdata']['status'] == 0){
                        ?>
                        <input type="submit" name="votebtn" value="Vote" id="votebtn">
                        <?php
                    }
                    else{
                        ?>
                        <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>
                        <?php
                    }
                    ?>
                    <br><br>
        </form>
        </div>
        <br><br>
        <hr>
        <br><br>
        <?php
        }
    }
    else{

    }
    ?>
</div>
</div>
</div>

</body>
</html>