<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

    <div class="menu" >
        <div class="left" style="margin-top:5px;">
            <span style="color: violet;font-size: xx-large;">NOAP </span><span style="font-size: x-large;color:white;"> Notes Editor</span>
        </div>
        <div class="right">
            <button type = "button" id = "create"
            style="margin-right:20px;margin-top:5px; width:140px;height:50px;border-radius: 2em; background: linear-gradient( 45deg, #cc95c0,#dbd4b4, #7aa1d2) ; color:black;" 
            name = 'submit' onclick="window.location.href='dashboard.php' ">Create Note</button>
        </div>
    </div>
   
    <?php         
        session_start();
        require_once('db_connect.php');

        if (isset($_POST['delete'])){
            $title = $_POST['delete'];
        
            $del = "DELETE FROM data WHERE Title= '$title' ";
            $execute = mysqli_query($con, $del);
        }

        $retrieve = 'SELECT Title,Content,Date_Created,Date_Edited FROM data';
        $result = mysqli_query($con,$retrieve);
        $contents = mysqli_fetch_all($result,MYSQLI_ASSOC);
    ?>
        
    <div class="container">
        <div class="row">
            <?php foreach($contents as $content){ ?>
                <div>
                    <div class="box" style="width:80%;">
                        <div class = "c2" style="text-transform: capitalize ; text-align:center;width:100%;">
                            <h2 ><?php echo htmlspecialchars($content['Title']); ?></h2>
                            <div class = "c1"><?php echo $content['Content']; ?></div> 
                        </div>
                        <div class="redirect" style="text-align: right; color:white;">
                            <div class="datebox"> 
                                <div class="dateCreated">
                                <?php echo "<span class = 'd d1'><b>Created On </b>-". "    ". $content['Date_Created']."</span>" ?>
                                <?php echo "<span class = 'd'><b>Last Edited On</b> -". "    ". $content['Date_Edited']."</span>" ?>
                                </div><br>
                                <div class="dateEdited">
                                <?php //echo "  Last Edited On -". "    ". $content['Date_Edited'] ?>
                                </div>
                            </div>
                            <div class="form">
                                <form action="index.php" method="POST">
                                <button type="submit" name = 'delete' class="delete" style="width:100px;height:40px;font-size: 15px;margin-right:20px;background-color: #19bbbb; color:white;" value="<?php echo $content['Title']; ?>">Delete Note</button>
                                </form>
                                <form action="retrieve.php" method="POST">
                                    <button type="submit" name = 'open' class="open" style="width:100px;height:40px;font-size: 15px;margin-right:20px;background-color: #19bbbb; color:white;" value="<?php echo $content['Title']; ?>">More Info</button>
                                </form>
                            </div>     
                        </div>
                    </div>
                </div>
            <?php } ?>           
        </div>
    </div>
    
</body>
</html>