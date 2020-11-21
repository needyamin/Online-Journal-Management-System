<?php 
require"../function/database.php";?> 

<html>
<header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    
   <!--<script>alert('We are working on our site. Please visit us next month 1 July 2020')</script>-->
    
<!-- Keywords Made by Yamin -->
  <meta name="description" content="Open Source Journal">
  <meta name="keywords" content="bio-science, journal, Bangladesh">
  <meta name="author" content="Md Hassan Shamim">
<!-- SEO Meta Tag end -->

    
    
    <title>Welcome to Opaar </title>
    <link href="../style.css" rel="stylesheet" type="text/css">
     

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script>
      $(document).ready(function() {
        $('.container').addClass('container-loaded');
      });
    </script>
      

<ul>
  <li><a class="active" href="index.php">Home</a></li>
  <li><a href="#news">Sitemap</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
    
<div class="desktop-only">
<div id="license">ISSN xxxx-xxxx (Online), ISSN xxxx-xxxx (Print)</div>
</div>
    
</ul>
    
    
    
    
    
    
    
    

<div class="header">
    <table id="header_table_logo" width="80%"> 
        <tr><td> <img src="../assets/img/logo.png" id="header_logo" > </td> 
        <td></td>
        </tr></table>
    
    
    </div>
    
<div class="menu"> 
<div class="menu2">     
    
    
    
    
<!--<div class="desktop-onlyxx">-->
    
<div class="navbar">
  <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
  <a href="#news">News</a>
  <div class="dropdown">
    <button class="dropbtn">Dropdown 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </div>
    
 <div class="search-container">
    <form action="/action_page.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
    
    
</div>



</header>


<body>
<div class="container">
        
<!--start main body post code-->        
<div class="col-main">

    
    
<?php 
    
$journal_slug = $_GET['journal'];     
$sql="SELECT * FROM opaar_journal WHERE journal_slug='$journal_slug'";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) { $journal_id_get = $journal["id"];?>    
    
<div class="col-card">
<div id="post"> 

<img src="../assets/img/cover.jpg" id="img_cover"> <div id="break"> </div>    
    
<H3> <?php echo''. $journal["journal_title"].'';?></H3>
<p> <?php echo''. $journal["journal_description"].'';?></p> 
 
<?php }} else {echo "<div class='col-card' style='padding:10%;'>No Journals Found..</div>";};?>
    
    
    
<?php 
$sql_article="SELECT * FROM opaar_article where journal_id=$journal_id_get;";
$stmt = $con->prepare($sql_article);   
$stmt->execute();?>                          
    

<?php if ($row = $stmt->fetch()){;?>
<p> Current Issue <br>    
Vol <?php echo''. $row["article_volume"].'';?>                           
No <?php echo''. $row["article_number"].'';?>                           
Year (<?php echo''. $row["article_year"].'';?>)
<br>
Published: <?php echo''. $row["article_date"].'';?> <br></p>
<?php } else{echo"No Current Issue";} ;?>       
    
          
</div></div>           

<div style="clear:both"></div> 
    
    
    
    
<div class="col-card">   
<h3> <div class="sep">Article List</div></h3> 

<?php 
$sqlm1m="SELECT * FROM opaar_article_users;";
$stmt = $con->prepare($sqlm1m);   
$stmt->execute();  


if ($stmt->rowCount() > 0) {
// output data of each row
while ($row = $stmt->fetch()){ ;?>

<?php 
$sql11="SELECT * FROM opaar_users;";
$stmt = $con->prepare($sql11);   
$stmt->execute();  
while ($what = $stmt->fetch()){ ;?>

     
<?php 
global $id_array,$k;                               
$journal_slug = $_GET['journal']; 
$sql="SELECT * FROM opaar_journal INNER JOIN opaar_article on opaar_journal.journal_slug = '$journal_slug' AND opaar_article.journal_id = opaar_journal.id";
$stmt = $con->prepare($sql);   
$stmt->execute();   
 
if ($stmt->rowCount() > 0) {
// output data of each row
while ($journal = $stmt->fetch()) { 
    
    $id = ''. $journal["id"].'';
    $id_array[$id] = $journal;
    $slug = ''. $journal["journal_slug"].'';
    $slug_array[$slug] = $journal;
    
    ?>  

<?php }}}}};?>    
 

 
    

<!-- IMPORTANT-->    
<?php
//for opaar_title loop start    
if(isset($id_array)){     
foreach ($id_array as $k => $meet_dataid) 
{    
$sql="SELECT * FROM opaar_journal INNER JOIN opaar_article ON opaar_article.id = opaar_article.id WHERE opaar_article.id = $k;";
$stmt = $con->prepare($sql);   
$stmt->execute();           
while ($what1 = $stmt->fetch()) {;?>

<!-- needyamin -->    
<br>
<a href="view.php?journal=<?php echo''. $what1["journal_slug"].'';?>&view=<?php echo''. $what1["id"].'';?>"><?php echo''. $what1["article_title"].'';?><?php echo''. $what1["article_title"].'';?></a><br>
<div style="float:right; margin-right:25px;"><?php echo''.$what1["article_year"].'';?></div>    
<!-- needyamin -->    

    
    
    
<?php     
//for opaar_title loop end    

//slug start    
foreach ($slug_array as $slug => $meet_slug) 
{ 
$sqlslug="SELECT * FROM opaar_article_users INNER JOIN opaar_users ON opaar_article_users.article_id = opaar_article_users.article_id WHERE opaar_article_users.article_id = '$k';";
$stmt = $con->prepare($sqlslug);   
$stmt->execute(); 
$meet_array = array();
while ($what = $stmt->fetch()) {

$meet_array[$what['article_author']] = $what;  
}  
    
foreach ($meet_array as $article_author => $meet_data) 
{$user ="SELECT * FROM opaar_users where id = $article_author;";
$stmt = $con->prepare($user);   
$stmt->execute();  
while ($what = $stmt->fetch()) {;?>

<?php echo ''.$what['username'].',';?>  

<?php    
}
}
}    
//slug end   
;?>
    
<!-- needyamin -->      
<br><a class='pdf' href='view.php?journal=&view='>PDF</a><br><br>
<!-- needyamin -->    
   
    
<?php    
    
}    
}} else {echo "<div class='col-card' style='padding:10%;'>No Article Publish Yet..</div>";};?>
    

     

          
   
    
     
</div>
            
    
    
    
</div>
        
        
<!--stop main body post code-->       
        
        
        <div class="col-sidebar">
            
            
            <h3>Sidebar </h3><hr style="border: 5px solid green;">
            
      <table border="1px" align="center" width="50%"> <th> Login Forum</th> 
          <tr><td width="100%" ><input type="email" name="email" placeholder="enter email" ></td></tr>
          <tr><td width="100%"><input type="password" name="password" placeholder="enter password"></td></tr>
          
           <tr><td align="center"><input type="submit" value="Login"></td></tr>
            </table>
    
    </div>

    
        </div>
    
      

    </body>


   
 <div style="clear:both"></div> 
    
    
<div id="istyle" style="margin-top: 3px;"> </div>
<div class="footer"> 
    
    <div id="footer_left"> ISSN xxxx-xxxx (Online), ISSN xxxx-xxxx (Print) </div> 
    <div id="footer_right">     <img src="../assets/img/logo.png" style="width: 100px;"> 
</div> 
    
    </div>  
    
<div id="footer_end">© 2020 Yamin Hossain Shohan |  All rights reserved.</div>

</html>

