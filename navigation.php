<!-- navbar -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
 
        <div class="navbar-header">
            <!-- to enable navigation dropdown when viewed in mobile device -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
 
            <!--TODO: Change this to your site info page -->
            <a class="navbar-brand" href="<?php echo $home_url; ?>">Mercantec</a>
        </div> 
        
            <?php
            // Check if user is logged in
            // Left button-group header options: Profile, Courses apply, Assigned courses            
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='Customer'){
            ?>
                <ul class="nav navbar-nav">
                <!-- link to the "Index" page, highlight if current page is index.php -->
                <li <?php echo $page_title=="Index" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>">Home</a>
                </li>
                <li <?php echo $page_title=="Mine fag" ? "class='active'" : ""; ?>>
                    <a href="<?php echo $home_url; ?>">Mine fag</a>
                </li>
                <!-- highlight for courses related pages -->
                <li <?php
                        echo $page_title=="Fag" ? "class='active'" : ""; ?> >
                    <a href="<?php echo $home_url; ?>/read_fag.php">Fag oversigt</a>
                </li>
            </ul>
            <!--Right header toggle button-->
            <ul class="nav navbar-nav navbar-right">
                    <!--check this section of code-->
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            &nbsp;&nbsp;<?php echo $_SESSION['firstname']; ?>
                            &nbsp;&nbsp;<span class="caret"></span>
                        </a>
                        <!--user log out button-->
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo $home_url; ?>logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            <?php
            } 
            // if user was not logged in, show the "login" and "register" options
            else{
            ?>
                <ul class="nav navbar-nav navbar-right">
                    <li <?php echo $page_title=="Login" ? "class='active'" : ""; ?>>
                        <a href="<?php echo $home_url; ?>login">
                            <span class="glyphicon glyphicon-log-in"></span> Log In
                        </a>
                    </li>
                 
                    <li <?php echo $page_title=="Register" ? "class='active'" : ""; ?>>
                        <a href="<?php echo $home_url; ?>register">
                            <span class="glyphicon glyphicon-check"></span> Register
                        </a>
                    </li>
                </ul>
                <?php
            }
            ?>
             
        </div><!--/.nav-collapse -->
 
    </div>
</div>
<!-- /navbar -->