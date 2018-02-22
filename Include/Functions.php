<?php
    function Redirect_to($New_Location)
    {
        header("Location:".$New_Location);  //In case validation fails
        exit;
    }
?>