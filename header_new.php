<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" media="all">
<link href="assets/css/slider.css" rel="stylesheet">
<link href="assets/css/responsive.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="assets/js/slider.js"></script>


<script>
    $(document).ready(function(){
        $( ".toggle_icon" ).click(function() {
            $( ".left-panel" ).addClass( "left_panel_open" );
        }); 
        $( ".remove_toggle_icon" ).click(function() {
            $( ".left-panel" ).removeClass( "left_panel_open" );
        });     

    });
</script>

<?=Get_MetaData(4);?>
<div class="left-panel">
    <div class="remove_toggle_icon">X</div>
    <ul class="">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="how_works.php">How it works</a></li>
        <li><a href="features.php">Features</a></li>
        <li><a href="resources.php">Resources</a></li>
        <li><a href="http://celebrateplus.tumblr.com/">Blog</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Signup</a></li>
    </ul>
</div>
<!-- Modal login -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">

                <div id="wrapper">
                    <div id="login" class="animate form">
                        <form id="site_login" name="site_login" method="post" action="login_process.php" onsubmit="javascript:return login_chk()">
                            <input type="hidden" name="frm" value="<?=$_REQUEST['frm']?>" />

                            <input type="hidden" name="from_search" value="<?=$_REQUEST['eve_id']?>" />

                            <input type="hidden" name="goto" value="<?=$_REQUEST['goto']?>" /> 

                            <h1>Log in</h1> 
                            <p> 
                                <label for="username" class="uname" data-icon="u"> Your email or username </label>

                                <input type="text" name="email" id="email" placeholder="Your Email Address " />
                            </p>
                            <p> 
                                <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                <!-- <input id="password" name="password" required type="password" placeholder="Your Password" />  -->
                                <input type="password" name="password" id="password" placeholder="Your Password" required/>
                            </p>
                            <p class="keeplogin"> 
                                <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
                                <label for="loginkeeping">Keep me logged in</label>
                            </p>
                            <p class="login button"> 
                                <input type="submit" name="Submit" id="Submit" class="login_btn"  value="Login"/>
                            </p>

                        </form>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

<script language="javascript" type="text/javascript">
               function gtg_check1()
               {    
                
                if(document.getElementById("fname").value.split(" ").join("") == "")
                    {
                        alert("Please enter your first name.");
                        document.getElementById("fname").focus();
                        return false;
                    }
                    if(document.getElementById("lname").value.split(" ").join("") == "")
                    {
                        alert("Please enter your last name.");
                        document.getElementById("lname").focus();
                        return false;
                    }
                    if(document.getElementById("country").value.split(" ").join("") == "")
                    {
                        alert("Please select a country.");
                        document.getElementById("country").focus();
                        return false;
                    }
                    if(document.getElementById("state").value.split(" ").join("") == "")
                    {
                        alert("Please select a state.");
                        document.getElementById("state").focus();
                        return false;
                    }

                    if(document.getElementById("email_id").value.split(" ").join("") == "")
                    {
                        alert("Please enter your primary email address.");
                        document.getElementById("email_id").focus();
                        return false;
                    }
                    else
                    {
                        var emailPat=/^(.+)@(.+)$/
                        var matchArray=document.getElementById("email_id").value.match(emailPat)
                    
                        if (matchArray==null) 
                        {
                            alert("Please enter a valid email address.")
                            document.getElementById("email_id").focus();
                            return false;
                        }
                    }
                    if(document.getElementById("password1").value.split(" ").join("") == "")
                    {
                        alert("Please enter your password.");
                        document.getElementById("password1").focus();
                        return false;
                    }
                    if(document.getElementById("password1").value.split(" ").join("") != document.getElementById("cpassword1").value.split(" ").join(""))
                    {
                        alert("Your password and password confirmation do not match.");
                        document.getElementById("cpassword1").focus();
                        return false;
                    }
                    
                    
                    
                    
        }

</script>


<!-- Modal registration -->
<div id="myModal_reg" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?=Get_MetaData(4);?>
        <?php include_once("google_analytics.php");?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">

                <div id="wrapper">

                    <div id="register" class="animate form">
                        <form name="site_register" id="site_register" method="post" action="register_new.php" onSubmit="javascript: return gtg_check1();">
                            <?
                            if($_REQUEST['eve_id'])
                            {
                                ?>
                                <input type="hidden" name="eve_id" id="eve_id" value="<?=$_REQUEST['eve_id'];?>">
                                <?
                            }
                            ?>
                            <h1> Sign up </h1> 
                            <p> 
                                <label for="usernamesignup" class="uname" data-icon="u">First Name</label>
                                <input type="text" name="fname" id="fname" placeholder="Your First Name" />
                            </p>
                            <p> 
                                <label for="usernamesignup" class="uname" data-icon="u">Last Name</label>
                                <input type="text" name="lname" id="lname" placeholder="Your Last Name" />
                            </p>
                            <p> 
                                <label for="usernamesignup" class="uname" data-icon="">Phone</label>
                                <input type="text" name="phone" id="phone" required  placeholder="Your Phone Number" />
                            </p>
                            <p> 
                                <label for="usernamesignup" class="uname" data-icon="">Country</label>
                                <select name="country" id="country" class="select_box">
                                    <option value="">Select Country</option>
                                    <option value="United States of America">United States of America</option>
                                </select>
                            </p>
                            <p> 
                                <label for="usernamesignup" class="uname" data-icon="">Country</label>
                                <select name="state" id="state" class="select_box">
                                    <option value="">Select State</option>
                                    <?
                                    $q = "select * from keshavstate order by name";
                                    $r = mysql_query($q);
                                    while($r1 = mysql_fetch_array($r))
                                    {
                                        $name = ucfirst(stripcslashes($r1['name']));
                                        if($name != "I live outside of the U.S")
                                        {
                                            ?><option value="<?=$r1['name'];?>"><?=$name;?></option><?
                                        }
                                    }
                                    ?>
                                </select>
                            </p>
                            <p> 
                                <label for="emailsignup" class="youmail" data-icon="e"> Your email</label>
                                <input type="text" name="email_id" id="email_id" placeholder="Your Email" />
                            </p>
                            <p> 
                                <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                <input type="password" name="password1"  id="password1" placeholder="Password" />
                            </p>
                            <p> 
                                <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                <input type="password" name="cpassword1"  id="cpassword1" placeholder="Password" />
                            </p>
                            <p>
                                <input type="checkbox" name="opted_email" id="opted_email" value="true" />

                                <span> I would like to receive special offers, notifications and updates from CelebratePlus
                                </span>
                            </p>
                            <p class="signin button"> 
                                <div class=""><input type="image" name="submit" id="submit" class="submit_img" src="images/reg_btn.png" /></div>
                            </p>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<div class="">

    <?php //include("header.php"); ?>
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="inner_logo">
                        <i class="fa fa-bars toggle_icon" aria-hidden="true"></i>
                        <a href="index.php"><img src="assets/img/logo-white.png"></a>
                    </div>
                </div>
                <?  if(isset($_SESSION['SESS_USER_ID']) and $_SESSION['SESS_USER_ID'] > 0)
                {
                    $href = "account_find_event.php";
                    $href1 = "create_event.php";
                }
                else
                {
                    $href = "find_event.php";
                    $href1 = "create_event.php";
                }

                ?>
                <div class="">
                    <? if(isset($_SESSION['SESS_USER_ID']) and $_SESSION['SESS_USER_ID'] > 0){?>
                    <div class="col-md-6 login_div">
                        <ul class="pull-right">
                            <li class="login"><a href="logout.php" data-toggle="" data-target=""><i class="fa fa-user" aria-hidden="true"></i> Logout</a></li>
                            <li class="register"><a href="account_welcome.php" data-toggle="" data-target=""><i class="fa fa-sign-in" aria-hidden="true"></i>My Account</a></li>
                        </ul>
                    </div>
                    <? } else {?>

                    <div class="col-md-6 login_div">
                        <ul class="pull-right">
                            <li class="login"><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-user" aria-hidden="true"></i> Login</a></li>
                            <li class="register"><a href="#" data-toggle="modal" data-target="#myModal_reg"><i class="fa fa-sign-in" aria-hidden="true"></i> Signup</a></li>
                        </ul>
                    </div>

                    <? }?>
                </div>

            </div>
        </div>
    </header>