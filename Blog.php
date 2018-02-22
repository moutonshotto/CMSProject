<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/public.css">
</head>
<style>
    
    .col-sm-3{
        background-color: green;
    }
    
</style>
<body>
   <!-- Head Part -->
    <div style="height: 10px; background: #27AAE1;"></div>
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>               
                <a class="navbar-brand" href="Blog.php">
                    <img src="images/logo.png" width="200" height="30">
                </a>
            </div>
            
            <div class="collapse navbar-collapse" id="collapse">
            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
                <li class="active"><a href="#">Blog</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Feature</a></li>
            </ul>
            
            <form action="Blog.php" class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" name="Search" placeholder="Search">  <!-- Search Button code --> 
                </div>
                <button class="btn btn-default" name="SearchButton">Go</button>
            </form>
            </div> 
                    
        </div>
    </nav>
    <div class="Line" style="height: 10px; background: #27AAE1;"></div>
    
    <!-- Body Part -->
    <div class="container"> <!-- Container -->
        
        <div class="blog-header"> <!-- Row -->
            <h1>The Complete Responsive CMS Blog</h1>
            <p class="lead">The Complete CMS Blog by Swapnil Velunde</p>
        </div>
        
        <div class="row">
            <div class="col-sm-8"> <!-- Main Area -->
                
                <?php
                    global $ConnectingDB;
                    if(isset($_GET["SearchButton"]))
                    {
                        $Search = $_GET["Search"];
                        $ViewQuery = "Select * FROM admin_panel 
                        WHERE datetime LIKE '%$Search%'
                        OR title LIKE '%$Search%'
                        OR category LIKE '%$Search%'
                        OR post LIKE '%$Search%'";
                    }else{
                        $ViewQuery = "SELECT * FROM admin_panel ORDER BY datetime desc";
                    }
                    $Execute = mysql_query($ViewQuery);
                    while($DataRows = mysql_fetch_array($Execute))
                    {
                        $PostId = $DataRows["id"];
                        $DateTime = $DataRows["datetime"];
                        $Title = $DataRows["title"];  
                        $Category = $DataRows["category"];
                        $Admin = $DataRows["author"];
                        $Image = $DataRows["image"];
                        $Post = $DataRows["post"];
                        
                ?>
                
                <div class="blogpost thumbnail">
                    <img class="img-responsive img-rounded" src="Upload/<?php echo $Image; ?>">
                    <div class="caption">
                        <h1 id = "heading"><?php echo htmlentities($Title); ?></h1>
                        <p class="description"> Category: <?php echo htmlentities($Category); ?> Published On <?php echo htmlentities($DateTime); ?></p>
                        <p class="post">
                        <?php
                            if(strlen($Post)>150)
                            {
                                $Post = substr($Post,0,150).'...';  
                            }
                            echo htmlentities($Post); 
                        ?></p>
                    </div>
                    <a href="FullPost.php?id=<?php echo $PostId; ?>"><span class="btn btn-info"> Read More &rsaquo;</span></a>
                </div>
                <?php } ?>        
            </div> <!-- Main Area Endng -->
            
            <div class="col-sm-offset-1 col-sm-3"> <!-- Side Area Endng -->
                <h1>Test</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div> <!-- Side Area Endng -->
        </div> <!-- Row -->
        
    </div> <!-- Container Ending -->
    
    <div id="Footer">
    <hr><p>Theme By | Swapnil Velunde |&copy;2016-2020 --- All right reserved.
    </p>
    
    <a style="color: white; text-decoration: none; cursor: pointer; font-weight:bold;" href="http://swapnilvelunde.com/coupons/" target="_blank">
    <p>
    This site is only used for Study purposes , only Swapnil Velunde have all the rights. No one is allowed to distribute
    copies other then <br>&trade; Swapnil Velunde. Doing so will lead to charges of fraud and piracy,and consequences will be inevitable </p><hr>
    </a>

    </div>
    <div style="height: 10px; background: #27AAE1;"></div> 

</body>
</html>