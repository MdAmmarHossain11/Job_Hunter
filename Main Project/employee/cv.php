<?php
require '../constants/settings.php'; 
require 'constants/check-login.php';
$fetch2="null";
if ($user_online == "true") {
if ($myrole == "employee") {
}else{
header("location:../");		
}
}else{
header("location:../");	
}
if (isset($_GET['empid'])) {
$empid = $_GET['empid'];
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE role = 'employee' AND member_no = :empid");
    $stmt->bindParam(':empid', $empid);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);

    }
    } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="cv.css">
</head>
<body>
    <div class="container">
        <div class="left_side">
            <div class="profileText">
                <div class="imgBx">

                <?php 
										if ($myavatar == null) {
										print '<center><img class="img-circle autofit2" src="../images/default.jpg" title="'.$myfname.'" alt="image"  /></center>';
										}else{
										echo '<center><img class="img-circle autofit2" alt="image" title="'.$myfname.'"  src="data:image/jpeg;base64,'.base64_encode($myavatar).'"/></center>';	
										}
										?>
                </div>
                <h2><?php echo $myfname ?><br><span><?php echo $mytitle ?></span></h2>
            </div>

            <div class="contactInfo">
            <h3 class="title">Contact Info</h3>
            <ul>
            <li>
                <span class="icon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                <span class="text"><?php echo $myphone; ?></span>
            </li>
            <li>
                <span class="icon"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></span>
                <span class="text"><?php echo $myemail; ?></span>
            </li>
            
    
            <li>
                <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                <span class="text"><?php echo $mycity?></span>
            </li>
        </ul>
            </div>
           

        <div class="contactInfo education">
            <h3 class="title">Education</h3>
            <ul>
            <li>
           <?php 
           require '../constants/db_config.php';
           $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $stmt = $conn->prepare("SELECT * FROM tbl_academic_qualification WHERE member_no = '$myid'");
           $stmt->execute();
           $result = $stmt->fetchAll();
         if($result){foreach($result as $row)
            { 
                ?>
               <h5> <?php echo $row['timeframe']."<br>";?></h5> 
              <h4><?php echo $row['institution']."<br>";?></h4>
               <h4> <?php echo $row['course']."<br>"."<br>";?></h4></li>
               <?php
            }} 
            
?>

    </div>
    <div class="contactInfo language">
            <h3 class="title">Languages</h3>
            <ul>
            <li> 
            <?php 
           require '../constants/db_config.php';
           $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $stmt = $conn->prepare("SELECT * FROM tbl_language WHERE member_no = '$myid'");
           $stmt->execute();
           $result = $stmt->fetchAll();
         if($result){foreach($result as $row)
            { 
                ?>
               <span class="text"> <?php echo $row['language']."<br>";?></span> 
               <span class="percent">
                    <div style="width: <?php if($row['speak']=='Very Good') 
                    {
                        echo 100;
                    }
                    else if($row['speak']=='Good')
                    {
                        echo 60;
                    }
                    else echo 30;
                    ?>%"></div>
                </span>
                <span class="percent">
                    <div style="width: <?php if($row['reading']=='Very Good') 
                    {
                        echo 100;
                    }
                    else if($row['reading']=='Good')
                    {
                        echo 60;
                    }
                    else echo 30;
                    ?>%"></div>
                </span>
                <span class="percent">
                    <div style="width: <?php if($row['writing']=='Very Good') 
                    {
                        echo 100;
                    }
                    else if($row['writing']=='Good')
                    {
                        echo 60;
                    }
                    else echo 30;
                    ?>%"></div>
                </span>
            </li>
               <?php
            }} 
            
?>
            </li>
       </ul>
       </div>
       </div>
        <div class="right_side">
            <div class="about">
            <h2 class="title2">Profile</h2>
            <p><h4><?php echo $mydesc ."<br>"."<br>"; ?></h4></p>
        <div class="about">
        <h2 class="title2">Experience</h2>
        <div class="box">
        <?php 
           require '../constants/db_config.php';
           $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $stmt = $conn->prepare("SELECT * FROM tbl_experience WHERE member_no = '$myid'");
           $stmt->execute();
           $result = $stmt->fetchAll();
         if($result)
         {foreach($result as $row)
            { 
                ?>
                <div class="year_company">
               <h5> <?php echo $row['start_date']?>-<?php echo $row['end_date']?></h5> 
              <h5><?php echo $row['institution']?></h5>
              <div class="text">
            <h4><?php echo $row['title']?></h4>
            <?php echo $row['duties']?>
               <?php
            }} 
            
?>
</div>
        </div>
        </div>
        <div class="contactInfo education">
            <h3>REFERENCE</h3>
            <ul>
            <li>
           <?php 
           require '../constants/db_config.php';
           $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $stmt = $conn->prepare("SELECT * FROM tbl_referees WHERE member_no = '$myid'");
           $stmt->execute();
           $result = $stmt->fetchAll();
         if($result){foreach($result as $row)
            { 
                ?>
               <h5> <?php echo "Name:".$row['ref_name']."<br>";?></h5> 
              <h4><?php echo "Institution:".$row['institution']."<br>";?></h4>
              <h4><?php echo "Phone no:".$row['ref_phone']."<br>";?></h4>
               <?php echo "Email:".$row['ref_mail']."<br>"."<br>";?></li>
               <?php
            }} 
            
?>

    </div>
    <div></div>
        
</body>
</html>