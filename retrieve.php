<?php
session_start();
require_once('db_connect.php');

//open
if (isset($_POST['open'])){
    $title = $_POST['open'];
    $content='';
    $fontname = '';
    $fontsize = "";

    $opn = "SELECT * FROM data WHERE Title= '$title' ";

    $res = mysqli_query($con,$opn);
    $insights = mysqli_fetch_all($res,MYSQLI_ASSOC);

    foreach($insights as $insight){
        $content = $insight['Content'];
        $Date_Created = $insight['Date_Created'];
        $Date_Edited = $insight['Date_Edited'];
    }
    $fontname = $insight['Font'];
    $fontsize = $insight['Size'];
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="retrieve.css">

</head>
<body style="background:linear-gradient(100deg,#16a085,#f4d03f)">

    <div class="menu">
        <div class="left" style="margin-top:12px">
            <span style="color: white;font-size: xx-large;margin-left:30px;">NOAP </span><span style="font-size: x-large;color:white;"> Notes Editor</span>
        </div>
        
        <form method = "POST" action = "dashboard.php">
            <button class = "but" type = 'submit' style="width:90px;height:45px;background: linear-gradient(45deg,#085078,#85d8ce); color:white;" name = 'submit_data' onclick = "S();" id = 'save'>Save</button>
            <button class = "but" type = 'submit' style="width:90px;height:45px;background: linear-gradient(45deg,#085078,#85d8ce); color:white;" name = 'update_data' onclick = "S();" id = 'update'>Update</button>
            <button class = "but" type = 'button' style="width:150px;height:45px;background: linear-gradient(45deg,#ff8008,#ffc837); color:white;" name = 'back_to' id = 'back'  value = "Back to Index">Back to index</button>
            <button class = "but" type = 'button' style="width:150px;height:45px;background: linear-gradient(45deg, #dd5e89,#f7bb97); color:white;" name = 'create_new' id = 'new' >Create New Note</button><br/>  
    </div>
    <header>
        <select onclick = "font()" id = "font-select">
          <option style = "font-family: Arial" value = "Arial">Arial</option>
          <option style = "font-family: 'Arial Black'" value = "Arial Black">Arial Black</option>
          <option style = "font-family: 'Comic Sans MS', monospace" value = "Comic Sans MS">Comic Sans MS</option>
          <option style = "font-family: 'Courier', monospace" value = "Courier">Courier</option>
          <option style = "font-family: 'Courier New', Courier, monospace" value = "Courier New">Courier New</option>
          <option style = "font-family: 'Georgia'"value = "Georgia">Georgia</option>
          <option style = "font-family: 'Verdana'"value = "Verdana">Verdana</option>
          <option style = "font-family: 'Papyrus'"value = "Papyrus">Papyrus</option>
          <option style = "font-family: 'Tahoma'"value = "Tahoma">Tahoma</option>
          <option style = "font-family: 'Times New Roman'"value = "Times New Roman">Times New Roman</option>
        </select>
        
        <select onclick = "abc()" id = "size-select">
          <option value = '14pt'>14</option>
          <option value = '15pt'>15</option>
          <option value = '16pt'>16</option>
        </select>

        <select onchange = "A('bggcolor', 'backcolor')" id = "bggcolor">
            <option id = "x">Highlight</option>
            <option value = "#ffffff">no color</option>
            <option value = "green">Green</option>
            <option value = "yellow">Yellow</option>
            <option value = "red">Red</option>
            <option value = "blue">Blue</option>
            <option value = "black">Black</option>
        </select>

        <select onchange = "A('fggcolor', 'forecolor')" id = "fggcolor">
            <option>Font-Color</option>
            <option value = "white">White</option>
            <option value = "green">Green</option>
            <option value = "yellow">Yellow</option>
            <option value = "red">Red</option>
            <option value = "blue">Blue</option>
            <option value = "#000000">Black</option>
        </select>
       
        <select id = "formatting" onchange="A('formatting','formatblock')">
            <option selected>Formatting</option>
            <option value="h1">Title 1 &lt;h1&gt;</option>
            <option value="h2">Title 2 &lt;h2&gt;</option>
            <option value="h3">Title 3 &lt;h3&gt;</option>
            <option value="h4">Title 4 &lt;h4&gt;</option>
            <option value="h5">Title 5 &lt;h5&gt;</option>
            <option value="h6">Subtitle &lt;h6&gt;  </option>
            <option value="p">Paragraph &lt;p&gt;</option>
            <option value="pre">Preformatted &lt;pre&gt;</option>
        </select>

        <button type = "button" id = "l"onclick = "B('justifyleft')" value = "justifyleft"><i class="fa fa-align-left" aria-hidden="true"></i></button>
        <button type = "button" id = "c"onclick = "B('justifycenter')" value = "justifycenter"><i class="fa fa-align-center" aria-hidden="true"></i></button>
        <button type = "button" id = "r"onclick = "B('justifyright')" value = "justifyright"><i class="fa fa-align-right" aria-hidden="true"></i></button>
        <button type = "button" id = "j"onclick = "B('justifyfull')" value = "justifyfull"><i class="fa fa-align-justify" aria-hidden="true"></i></button>
        
        <button type = "button" id = 'b' onclick = "formatDoc('bold');"><i class="fa fa-bold" aria-hidden="true"></i></button>
        <button type = "button" id = 'u' onclick = "formatDoc('underline');"><i class="fa fa-underline" aria-hidden="true"></i></button>
        <button type = "button" id = 'i' onclick = "formatDoc('italic');"><i class="fa fa-italic" aria-hidden="true"></i></button>
        <button type = "button" id = "uolist" onclick = "formatDoc('insertunorderedlist');"><i class="fa fa-list-ul"></i></button>
        <button type = "button" id = "olist" onclick = "formatDoc('insertorderedlist');" ><i class="fa fa-list-ol"></i></button>
        <button type = "button" id = "link" onclick = "formatDoc('createLink');"><i class="fa fa-link" aria-hidden="true"></i></button>
        <button type = "button" id = "strike" onclick = "formatDoc('strikeThrough');"><i class="fa fa-strikethrough" aria-hidden="true"></i></button>
        <button type = "button" id = "super" onclick = "formatDoc('superscript');"><i class="fa fa-superscript" aria-hidden="true"></i></button>
        <button type = "button" id = "sub" onclick = "formatDoc('subscript');"><i class="fa fa-subscript" aria-hidden="true"></i></button>
        
    </header>
        <br/><br/>
        
        <div id = 'Date_Created' name = 'Date_Created' style="font-size: x-large"><?php echo "Created On -". "    ". $Date_Created;echo " Last Edited -". "    ". $Date_Edited;?></div>

        <div id = 'head' class="top">
            <div id = 'title' name = 'title' contenteditable = 'true'><?php echo $title ?></div>
        </div><br/>
        <div id = "parent">
            <div name = 'div' onkeydown="onKeyDown(event)" id = 'div' contenteditable="true" ><?php echo $content ?></div>
        </div>
        <div style = "display:none">
            <input type="hidden" name = 'hidden' id = "hidden" >
            <input type="hidden" name = 'hidden2' id = "hidden2">
            <input type="hidden" name = 'hidden4' id = "hidden4" value = <?php echo $insight['Font'] ?> >
            <input type="hidden" name = 'hidden5' id = "hidden5" value = <?php echo $insight['Size'] ?> >
        </div>
    </form>
    <script src = "retrieve.js"></script>
    <?php
      if(isset($_POST['open'])){
        echo "<script>
        document.getElementById('font-select').selectedIndex = $fontname;
        document.getElementById('size-select').selectedIndex = $fontsize;
        document.getElementById('div').style.fontFamily = document.getElementById('font-select').value;
        document.getElementById('div').style.fontSize = document.getElementById('size-select').value;
        </script>";
      }
    ?>
</body>
</html> 