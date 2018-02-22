<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php
    if(isset($_POST["Submit"]))
    {
        $Category = mysql_real_escape_string($_POST["Category"]);
        date_default_timezone_set("Asia/Kolkata");
        $CurrentTime=time();
        //$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
        $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
        $DateTime;
        $Admin = "Swapnil Velunde";
        if(empty($Category))
        {
            $_SESSION["ErrorMessage"] = "All Fields must be filled out";
            Redirect_to("categories.php");
        }elseif(strlen($Category)>99)
        {
            $_SESSION["ErrorMessage"] = "Too Long Name";
            Redirect_to("categories.php");
        }else
        {
            global $ConnectingDB;
            $Query = "INSERT INTO category(datetime,name,creatorname) VALUES('$DateTime','$Category','$Admin')";
            $Execute = mysql_query($Query);
            if($Execute)
            {
                $_SESSION["SuccessMessage"] = "Category Added Successfully";
                Redirect_to("categories.php");
            }else
            {
                $_SESSION["ErrorMessage"] = "Category Failed to Add";
                Redirect_to("categories.php");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .FieldInfo
        {
            color: rgb(251,174,44);
            font-family: Bitter,Georgia,"Times New Roman",Times,serif;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-sm-2">
                <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                    <li><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span> &nbsp;Dashboard</a></li>
                    <li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span> &nbsp;Add New Post</a></li>
                    <li class="active"><a href="#"><span class="glyphicon glyphicon-tags"></span> &nbsp;Categories</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> &nbsp;Manage Admins</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-comment"></span> &nbsp;Comments</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-equalizer"></span> &nbsp;Live Blog</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> &nbsp;Logout</a></li>
                </ul>
            </div> <!-- Ending Of Side Area -->  
            
            <div class="col-sm-10">
            <h1>Manage Categories</h1>
               <?php echo Message();
                      echo SuccessMessage();    
                ?>
                <div>
                    <form action="categories.php" method="post">
                        <fieldset>
                           <div class="form-group">
                               <label for="categoryname"><span class="FieldInfo">Name</span></label>
                            <input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name">
                           </div>
                           <br>
                           <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category">
                           <br>
                           <br>
                        </fieldset>
                    </form>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Sr. No.</th>
                            <th>Date & Time</th>
                            <th>Category Name</th>
                            <th>Creator Name</th>
                        </tr>
                        
                        <?php
                            global $ConnectingDB;
                            $ViewQuery = "SELECT * FROM category ORDER BY datetime desc";
                            $Execute = mysql_query($ViewQuery);
                            $SrNo = 0;
                        
                            while($DataRows = mysql_fetch_array($Execute))
                            {
                                $Id = $DataRows["id"];    
                                $DateTime = $DataRows["datetime"];    
                                $CategoryName = $DataRows["name"];    
                                $CreatorName = $DataRows["creatorname"];   
                                $SrNo++;
                        ?>
                        
                        <tr>
                            <td><?php echo $SrNo;?></td>
                            <td><?php echo $DateTime;?></td>
                            <td><?php echo $CategoryName;?></td>
                            <td><?php echo $CreatorName;?></td>
                        </tr>
                        
                        <?php }?>
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