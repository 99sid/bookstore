<?php
session_start();
include "dbconnect.php";

if (isset($_GET['Message'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['Message'] . '");
           </script>';
}

if (isset($_GET['response'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['response'] . '");
           </script>';
}

if(isset($_POST['submit']))
{
  if($_POST['submit']=="login")
  { 
        $username=$_POST['login_username'];
        $password=$_POST['login_password'];
        $query = "SELECT * from users where UserName ='$username' AND Password='$password'";
        $result = mysqli_query($con,$query)or die(mysql_error());
        if(mysqli_num_rows($result) > 0)
        {
             $row = mysqli_fetch_assoc($result);
             $_SESSION['user']=$row['UserName'];
             $_SESSION['email']=$row['useremail'];
             print'
                <script type="text/javascript">alert("successfully logged in!!!");</script>
                  ';
        }
        else
        {    print'
              <script type="text/javascript">alert("Incorrect Username Or Password!!");</script>
                  ';
        }
  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Books">
    <meta name="author" content="Akash Patil">
    <title>Bookstore</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <style>
      .modal-header {background:#0066ff;color:#fff;font-weight:800;}
      .modal-body{font-weight:800;}
      .modal-body ul{list-style:none;}
      .modal .btn {background:#0066ff;color:#fff;}
      .modal a{color:#FF0066;}
      .modal-backdrop {position:inherit !important;}
       #login_button,#register_button{background:none;color:#fff !important;}       
       #query_button {position:fixed;right:0px;bottom:0px;padding:10px 80px;
                      background-color:#FF0066;color:#fff;border-color:#000;border-radius:2px;}
  	@media(max-width:767px){
        #query_button {padding: 5px 20px;}
  	}
    </style>
</head>
<body>

  <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">

      <div class="container-fluid">
     
        <!-- Brand and toggle get grouped for better mobile display -->

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php" style="padding: 1px;">
          	<img class="img-responsive" alt="Brand" src="img/Bookstore_logo.PNG"  style="width:151px; margin:0px;">
         	</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        	
         <ul class="nav navbar-nav navbar-right">
        <?php
        if(!isset($_SESSION['user']))
          {
            echo'
            <li>

                <button type="button" id="login_button" class="btn btn-lg" data-toggle="modal" data-target="#login">Login</button>
                  <div id="login" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center">Login Form</h4>
                            </div>
                            <div class="modal-body">
                                          <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                              <div class="form-group">
                                                  <label class="sr-only" for="username">Username</label>
                                                  <input type="text" name="login_username" class="form-control" placeholder="Username" required>
                                              </div>
                                              <div class="form-group">
                                                  <label class="sr-only" for="password">Password</label>
                                                  <input type="password" name="login_password" class="form-control"  placeholder="Password" required>
                                              </div>
                                              <div class="form-group">
                                                  <button type="submit" name="submit" value="login" class="btn btn-block">
                                                      Sign in
                                                  </button>
                                              </div>
                                          </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                  </div>
            </li>
            <li>
              <button type="button" id="register_button" class="btn btn-lg" data-toggle="modal" data-target="#register">Sign Up</button>
                <div id="register" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title text-center">Registration Form</h4>
                          </div>
                          <div class="modal-body">
                                        <form class="form" role="form" method="post" action="register.php" accept-charset="UTF-8">
                                            <div class="form-group">
                                                <label class="sr-only" for="username">Username</label>
                                                <input type="text" name="register_username" class="form-control" placeholder="Username" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="useremail">Useremail</label>
                                                <input type="email" name="register_useremail" class="form-control" placeholder="Useremail" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="password">Password</label>
                                                <input type="password" name="register_password" class="form-control"  placeholder="Password" required>
                                            </div>                                            
                                            <div class="form-group">
                                                <button type="submit" name="submit" value="register" class="btn btn-block">
                                                    Sign Up
                                                </button>
												
												
                                            </div>
                                        </form>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                      </div>
                  </div>
                </div>
            </li>';
          } 
        else
          {   echo' <li> <a href="#" class="btn btn-lg"> Hello ' .$_SESSION['user']. '.</a></li>
                    <li> <a href="cart.php" class="btn btn-lg"> Cart </a> </li>; 
                    <li> <a href="destroy.php" class="btn btn-lg"> LogOut </a> </li>';
               
          }
?>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <div id="top" >
      <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
          <div>
              <form role="search" method="POST" action="Result.php">
                  <input type="text" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;" placeholder="Search for a Book ,Author Or Category" >
              </form>
          </div>
      </div>

      <div class="container-fluid" id="header">
          <div class="row">
              <div class="col-md-3 col-lg-3" id="category">
                  <div style="background:#FFFF00;color:#101010;font-weight:800;border:none;padding:15px;"> The Book Shop </div>
                  <ul>
                      <li> <a href="Product.php?value=entrance%20exam"> Entrance Exam </a> </li>
                      <li> <a href="Product.php?value=Literature%20and%20Fiction"> Literature & Fiction </a> </li>
                      <li> <a href="Product.php?value=Academic%20and%20Professional"> Academic & Professional </a> </li>
                      <li> <a href="Product.php?value=Biographies%20and%20Auto%20Biographies"> Biographies & Auto Biographies </a> </li>
                      <li> <a href="Product.php?value=Children%20and%20Teens"> Children & Teens </a> </li>
                      <li> <a href="Product.php?value=Regional%20Books"> Regional Books </a> </li>
                      <li> <a href="Product.php?value=Business%20and%20Management"> Business & Management </a> </li>
                      <li> <a href="Product.php?value=Health%20and%20Cooking"> Health and Cooking </a> </li>

                  </ul>
              </div>
              <div class="col-md-6 col-lg-6">
                  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                     
                      <ol class="carousel-indicators">
                          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                          <li data-target="#myCarousel" data-slide-to="1"></li>
                          <li data-target="#myCarousel" data-slide-to="2"></li>
                          <li data-target="#myCarousel" data-slide-to="3"></li>
                          
                      </ol>
                      
                        
                      <div class="carousel-inner" role="listbox">
                          <div class="item active">
                            <img class="img-responsive" src="img/carousel/1.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive "src="img/carousel/2.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive" src="img/carousel/3.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive"src="img/carousel/4.jpg">
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 col-lg-3" id="offer">
              		<h1 style="color: #234f1e">📚 "Take a good book to bed with you - books do not snore” – Thea Dorn 📚</h1>
              
              </div>
          </div>
      </div>
  </div>

  <div class="container-fluid text-center" id="new">
      <div class="row">
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-1&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="book block-center img-responsive" src="img/new/1.jpg">
                  <hr>
                  Computer Science & Engineering <br>
                  Rs 113  &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> 175 </span>
                  <span class="label label-warning">35%</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-2&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/2.jpg">
                  <hr>
                  Advanced Microprocessor<br>
                  Rs 640 &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> 800 </span>
                  <span class="label label-warning">20%</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-3&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/3.jpg">
                  <hr>
                  Java for Beginners <br>
                  Rs 399 &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> 595 </span>
                  <span class="label label-warning">33%</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-4&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/4.jpg">
                  <hr>
                  Python<br>
                  Rs 315 &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> 450 </span>
                  <span class="label label-warning">30%</span>
              </div>
            </a>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-5&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="book block-center img-responsive" src="img/new/5.jpg">
                  <hr>
                  Crptography and network security <br>
                  Rs 150  &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> 175 </span>
                  <span class="label label-warning">25%</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-6&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/6.1.jpg">
                  <hr>
                  Cloud Computing <br>
                  Rs 219 &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> 300 </span>
                  <span class="label label-warning">30%</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-7&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/7.jpg">
                  <hr>
                  IOT <br>
                  Rs 385 &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> 550 </span>
                  <span class="label label-warning">30%</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-8&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/8.jpg">
                  <hr>
                  Software Testing<br>
                  Rs 560 &nbsp
                  <span style="text-decoration:line-through;color:#828282;"> 700 </span>
                  <span class="label label-warning">20%</span>
              </div>
            </a>
          </div>
      </div>
  </div>

  <footer style="margin-left:-6%;margin-right:-6%;">
      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-1 col-md-1 col-lg-1">
              </div>
              <div class="hidden-sm-down col-md-2 col-lg-2">
              </div>
              <div>
                 <center> <h4 style="color:#FFFFFF ;"> &copy; Project by Param Project Team</h4>
				  <br/>
				  <h3>Contact us on :<br> Email :- bookstore@gmail.com <br> Phone :- 1234567890</h3></center>
                 
              </div>
          </div>
      </div>
  </footer>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  
  <script src="js/bootstrap.min.js"></script>
</body>
</html>	