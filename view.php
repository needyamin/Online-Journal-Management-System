<?php require"function/database.php"; ?> 

<html>
<header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    
<base href="http://localhost/needyamin/style.css" />
<base href="http://localhost/needyamin/" />

<!-- Keywords Made by Ashes Yamin -->
  <meta name="description" content="Open Source Journal">
  <meta name="keywords" content="bio-science, journal, Bangladesh">
  <meta name="author" content="Md Hassan Shamim">
<!-- SEO Meta Tag end -->

    
    
    <title>Welcome to Opaar </title>
    <link href="style.css" rel="stylesheet" type="text/css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
 <script>
      $(document).ready(function() {
        $('.container').addClass('container-loaded');
      });
    </script>
    

<ul>
  <li><a class="active" href="#home">Home</a></li>
  <li><a href="#news">Sitemap</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
    
<div class="desktop-only">
<div id="license">ISSN xxxx-xxxx (Online), ISSN xxxx-xxxx (Print)</div>
</div>
    
</ul>
    

<div class="header">
    <table id="header_table_logo" width="80%"> 
        <tr><td> <img src="../../assets/img/logo.png" id="header_logo" > </td> 
        <td></td>
        </tr></table>
    
    
    </div>
    
<div class="menu"> 
    
    
    
    
    
<div class="desktop-only">
<div class="navbar">
  <a href="#home"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
  <a href="#news">News</a>
  <div class="dropdown">
    <button class="dropbtn">Archive 
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

</div>

 </div>
    
<div id="istyle" style="margin-bottom: 3px;"> </div>

</header>
<div style="clear:both"></div>
    

<body>
        
<div class="container">
        

     
<!--start main body post code-->        
<div class="col-main">
<div class="col-card">
<div id="post"> 
<?php 

$journal_slug = $_GET['journal']; 
$view = $_GET['view']; //article here for query execute

$sql ="SELECT * from opaar_article INNER JOIN opaar_journal on opaar_article.id = '$view' And opaar_journal.journal_slug = '$journal_slug'";

$stmt = $con->prepare($sql);   
$stmt->execute();   
    
    
if ($stmt->rowCount() > 0) {
while ($journal = $stmt->fetch()) {;?> 
    
    
<h1> <?php echo''. $journal["article_title"].'';?></h1> 
     <?php echo''. $journal["article_description"].'';?>    
 
<?php }} else {echo'view not found';};?>
    
    
    
    

<?php
$sqlm1m="SELECT * FROM opaar_article_users INNER JOIN opaar_users ON opaar_article_users.article_id = opaar_article_users.article_id WHERE opaar_article_users.article_id = '$view';";
$stmt = $con->prepare($sqlm1m);   
$stmt->execute();                                
$meet_array = array();
while ($what = $stmt->fetch()) {

$meet_array[$what['article_author']] = $what;  
}  
    
foreach ($meet_array as $article_author => $meet_data) 
{
    
$user ="SELECT * FROM opaar_users where id = $article_author;";
$stmt = $con->prepare($user);   
$stmt->execute();  
while ($what = $stmt->fetch()) {
echo ''.$what['username'].',';  
    
}};?>
    



    
    
    
    
    
    
    </div></div>
    
  <div style="clear:both"></div> 
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
 <div class="col-card">   
    

     
     
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
    <div id="footer_right">     <img src="../../assets/img/logo.png" style="width: 100px;"> 
</div> 
    
    </div>  
    
<div id="footer_end">© 2020 Yamin Hossain Shohan |  All rights reserved.</div>

</html>