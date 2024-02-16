<?php
    include '../connection.php';
    session_start();
    $username = $_SESSION['username'];
    if(!isset($username)){
        header("location:http://localhost/studentAMS/index.php");
    }
    if(isset($_POST['Register'])){
        /* $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $dept = mysqli_real_escape_string($conn, $_POST['dept']);
        $mail = mysqli_real_escape_string($conn, $_POST['mail']); */
        $batch = $_POST['batch'];
        $sem = $_POST['sem'];
        $course_name = mysqli_real_escape_string($conn, $_POST['course']);
        $course_code = mysqli_real_escape_string($conn, $_POST['code']);

        $select_query = "SELECT * FROM admin WHERE username='{$username}'";
        $result_test = mysqli_query($conn,$select_query);
        if($row1=mysqli_fetch_assoc($result_test)){
            $fname = $row1['fname'];
            $lname = $row1['lname'];
           // $dept = $row1['dept'];
            $mail = $row1['email'];
        }
        //$result1 = mysqli_query($conn,$select_query);
        if($result_test==TRUE){
            $sql = "INSERT INTO teacher(fname,lname,username,mail,batch,sem,course_name,course_code) VALUES('{$fname}','{$lname}','{$username}','{$mail}',{$batch},{$sem},'{$course_name}','{$course_code}')";
            if(mysqli_query($conn,$sql)){
                $err = "<font color='green'>Added Successfully</font>"; 
            }else{
                $err = "<font color='red'>Username does not matched...!</font>";
            }
        }
        
       /*  if(mysqli_num_rows($result1)>0){
            $err = "<font color='red'>Username already Exist...!</font>";
        }else{
            $sql = "INSERT INTO teacher(fname,lname,username,dept,mail,batch,sem,course_name,course_code) VALUES('{$fname}','{$lname}','{$username}','{$dept}','{$mail}',{$batch},{$sem},'{$course_name}','{$course_code}')";
            if(mysqli_query($conn,$sql)){
                $err = "<font color='green'>Add Teacher Successfully</font>"; 
            }else{
                $err = "<font color='red'>Invalid Teacher information...!</font>";
            }
        }
 */
       
    }

?>


<!DOCTYPE html>
<html>
<head>

	<title>Student Attendance Management System</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Bitter:wght@100;300;400&family=Bree+Serif&family=Handlee&family=Numans&family=Odibee+Sans&family=PT+Serif:wght@400;700&family=Patrick+Hand&family=Simonetta:ital,wght@0,400;0,900;1,400&family=Trade+Winds&family=Volkhov:wght@400;700&display=swap" rel="stylesheet"> 
	<!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css.map">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="../css/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/fontawesome/css/all.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/singup.css">

</head>


<body>
	
<!-- <header>
  <h1 class="title center y-5">Student Attendance Management System</h1>
</header> -->
<nav class="navbar navbar-expand-lg navbar-dark static-top" style="background-color: #5a0533; border-bottom:1px solid black;box-shadow: 3px 3px 5px;">
    <div class="container" style = "font-family:'PT Serif';font-size:22px;padding-right:0px;margin-right:0%;">
        <a class="navbar-brand" href="index.php">
            <h3 style = "font-family:'Bitter';" ><img src="../images/logo.png" width="70" style = "border-radius:50%;border:1px black;" height="70" alt="JKKNIU"/> <span class = "mh3">JKKNIU</span><br />  <p style="margin-left:4%;font-size:12px;margin-top:0;position:absolute;top:65px">Trishal,Mymensingh<br />Estd. 2006</p></h3>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mnav" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <!-- <li class="nav-item">
                    <a class="nav-link" href="student.php"><i class="fa fa-users"></i> Students</a>
                    <span class="sr-only">(current)</span>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="Index.php"><i class="fa fa-home"></i> Home</a>
                    <span class="sr-only">(current)</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="addteacher.php"><i class="fa fa-plus"></i> Add Course</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="teacher.php"><i class="fa fa-user"></i> My Report</a>
                </li>
                
                 <li class="nav-item">
                    <a class="nav-link" href="attendance.php"><i class="fa fa-check"></i> Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="report.php"><i class="fa fa-file"></i> Student Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container" style="font-family:'PT Serif';font-size:40px;">
        <div class="mt-1">
           <div class="row">
                    <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <p class="text-center text-dark" style="margin-right: 30%;">Education Class Control System</p>
                    </div>
                    <div class="col-md-3"></div>
            </div>
        </div>
                
    </div>

<div class="container">
    <div class=" mcontainer">
        <form name="register" method="post" class="myform" action="" enctype="multipart/form-data">
            <h1 class="tit mb-5">Add Courses</h1>
            <p align='center'><b><?php echo @$err; ?></b></p> 
            <hr class="mhr" color="black" height="15px" />
            <table width="100%">

                <tr>
                    <td>
                        <label>Batch</label>
                    </td>
                    <td>

                    </td>
                    <td class="td1">
                        <input type="number" autocomplete="off" name="batch" id="phone" placeholder="Which Batch" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Semester</label>
                    </td>
                    <td>

                    </td>
                    <td class="td1">
                        <input type="number" autocomplete="off" name="sem" id="phone" placeholder="Semester" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label class="label required">Course Name</label>
                    </td>
                    <td>

                    </td>
                    <td class="td1" class="label required">
                        <input type="text" name="course" id="course" placeholder="Course Name" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="label required">Course Code</label>
                    </td>
                    <td>

                    </td>
                    <td class="td1" class="label required">
                        <input type="text" name="code" id="course" placeholder="Course Code" required />
                    </td>
                </tr>
 
                <tr>
                    <td>
                        <input type="submit" onclick="return matchPassword()" name="Register" class="login_btn" value="Add Courses" />
                    </td>
                    <td>

                    </td>
                    <td class="td1">
                        <input type="reset" onClick="window.location.href=window.location.href" class="reset_btn" value="Reset" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<!-- JS -->
<script src="../js/jquery_library.js"></script>
<script src="../js/bootstrap.js"></script>

</body>
</html>