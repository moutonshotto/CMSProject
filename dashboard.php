<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        
    </style>
</head>
<body>
   
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
                    <img src="images/5.png" width="200" height="30">
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
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
               <br><br>
                <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                    <li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span> &nbsp;Dashboard</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-list-alt"></span> &nbsp;Add New Post</a></li>
                    <li><a href="categories.php"><span class="glyphicon glyphicon-tags"></span> &nbsp;Categories</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> &nbsp;Manage Admins</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-comment"></span> &nbsp;Comments</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-equalizer"></span> &nbsp;Live Blog</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> &nbsp;Logout</a></li>
                </ul>
            </div> <!-- Ending Of Side Area -->  
            <div class="col-sm-10"> <!-- Main Area -->
                <?php echo Message();
                      echo SuccessMessage();    
                ?>
                <h1>Admin Dashboard</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>No</th>
                            <th>Post Title</th>
                            <th>Date & Time</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Banner</th>
                            <th>Comments</th>
                            <th>Action</th>
                            <th>Details</th>
                        </tr>
                    <?php
                        $ConnectingDB;
                        $ViewQuery = "Select * FROM admin_panel ORDER BY datetime desc";
                        $Execute = mysql_query($ViewQuery);
                        $SrNo = 0;
                        while($DataRows = mysql_fetch_array($Execute))
                        {
                            $Id = $DataRows["id"];
                            $DateTime = $DataRows["datetime"];
                            $Title = $DataRows["title"];  
                            $Category = $DataRows["category"];
                            $Admin = $DataRows["author"];
                            $Image = $DataRows["image"];
                            $Post = $DataRows["post"];
                            $SrNo++;
                    ?>
                        <tr>
                            <td><?php echo $SrNo;?></td>
                            <td style="color:#5e5eff;">
                               <?php 
                                    if(strlen($Title)>20)
                                    {
                                        $Title = substr($Title,0,20)."..";
                                    }
                                    echo $Title;
                                ?>
                            </td>
                            <td>
                                <?php
                                    if(strlen($DateTime)>11)
                                    {
                                        $DateTime = substr($DateTime,0,20)."..";
                                    }
                                    echo $DateTime;
                                ?>
                            </td>
                            <td>
                                <?php
                                    if(strlen($Admin)>6)
                                    {
                                        $Admin = substr($Admin,0,20)."..";
                                    }
                                    echo $Admin;
                                ?>
                            </td>
                            <td>
                                <?php
                                    if(strlen($Category)>8)
                                    {
                                        $Category = substr($Category,0,8)."..";
                                    }
                                    echo $Category;
                                ?>
                            </td>
                            <td><img src="Upload/<?php echo $Image; ?>" width="170px"; height="50px"></td>
                            <td>Processing</td>
                            <td>
                                <a href="EditPost.php?Edit=<?php $Id?>"><span class="btn btn-warning">Edit</span></a>
                                <a href="DeletePost.php?Delete=<?php $Id?>"><span class="btn btn-danger">Delete</span></a>
                            </td>    
                            <td>
                                <a href="FullPost.php?id=<?php echo $Id;?>" target="_blank">   
                                    <span class="btn btn-primary">Live Preview</span></a>
                            </td>
                        </tr>
                    <?php } ?>    
                    </table>   
                </div>
            </div>  <!-- Ending Of Main Area -->
        </div> <!-- Ending Of Row -->  
    </div> <!-- Ending Of Container -->
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