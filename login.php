<?php
require_once '/inc/core.inc.php';
if( isset($_POST['username']) && isset($_POST['password'])&&isset($_POST['usertype'])){
$username=$_POST['username'];
$password=$_POST['password'];
$type=$_POST['usertype'];
$_SESSION['usertype']=$type;
				if(!empty($username)&&!empty($password)&&!empty($type))
				{
					if($type=="user")
					{
						$query_run1=$db->query("select count(*) as theCount from users where name ='$username' and password ='$password'");
						$count=$query_run1->fetchColumn();
					}
					elseif($type=="admin")
					{
						$query_run1=$db->query("select count(*) as theCount from admin where name ='$username' and password ='$password'");
						$count=$query_run1->fetchColumn();
					}
					else
						{echo "<html><script type='text/javascript'>alert('result not fetched')</script></html>";}
					
					if($count == 1){
									 if($type=="user")
									 {
									 $stmt=$db->prepare("select * from users where name =? and password =?");
									 $result=$stmt->execute(array($username,$password));
									 }
									 
									 if($type=="admin")
									 {
									 $stmt=$db->prepare("select * from admin where name =? and password =?");
									 $result=$stmt->execute(array($username,$password));
									 }
									 if($result)
									 {
									$userid= $stmt->fetch(); 
									$_SESSION['user_id']=$userid; //['id'];
									//$_SESSION['username']=$userid['name'];
									
									header('Location:index.php');		
									}	
									}
					else 
									echo"<html><script type='text/javascript'>alert('result not fetched')</script></html>";
				}
		else{
		 echo'<html>
		 <script type="text/javascript">
		 alert("INVALID USERNAME/PASSWORD!!!" );
		 </script>
		 </html>';
		}
}
/*else{
	echo'<html>
	 <script type="text/javascript">
	 alert("please enter both username and password");
	 </script>
	 </html>';
	}*/
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/grayscale.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">IIT-INDORE</h1>
                        <p class="intro-text">Welcome to<br>Equipment reservation system.<br></p><small>Move down to Login</small>
                        <a href="#login" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- About Section -->
   <!-- <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About xyz LAB</h2>
                <p>Grayscale is a free Bootstrap 3 theme created by Start Bootstrap. It can be yours right now, simply download the template on the preview page. The theme is open source, and you can use it for any purpose, personal or commercial.</p>
                <p>This theme features stock photos by Gratisography along with a custom Google Maps skin courtesy of Snazzy Maps.</p>
                <p>Grayscale includes full HTML, CSS, and custom JavaScript files along with LESS files for easy customization.</p>
            </div>
        </div>
    </section>
-->
    <!-- Download Section -->
    <section id="login" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>SignIn to reserve an equipment</h2>
                <!--login -->
                  <div class="row">
                    
					<div class="col-lg-3 col-lg-offset-5 col-md-offset-5 col-md-3">
                    <!--form-->
                        <form role="form" action="login.php" method="POST">

                             <div class="form-group ">
                                <p class="form-control-static">Username</p>
                                <input class="form-control" placeholder="xyz120001001" name="username">
                            </div>
                            <div class="form-group">
                                <p class="form-control-static">Password</p>
                                <input class="form-control" type="password" placeholder="********" name="password">
                            </div>
							<div class="form-group">
                                <p class="form-control-static">I am
								<select name="usertype">
                                <option class="form-control" name="usertype" value="admin">Admin</option>
								<option class="form-control" name="usertype" value="user">User</option>
								</select>
								</p>
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                            

                        </form>
						
                </div>
				
            </div>
        </div>
		</div>
    </section>

    <!-- Contact Section -->
	
    <section id="signup" class="content-section text-center">
      
<div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Not Signed Up...<a href="signup.php">SignUp Now</a></h2>
                <!--login -->
                 
		</div>
    </section>
    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; Your Website 2014</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>

</body>

</html>
