<?php include("database.php");
//query to creat an account
$name="jane88";
$email="jane88@gmail.com";
$password=password_hash("password",PASSWORD_DEFAULT);
$account_query="insert into accounts(name,email,password,status,created) values('jane66','jane66@gamil.com','',1,NOW())";
//run the query
$result=$connection->query($account_query);
if(!$result){
    echo "account creation failed";
}
?>
<!doctype html>
<html>
<?php 
    $page_title="Home Page";
    include("includes/head.php");
?>
    <body>
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-md-6"><!-- start slipsum code -->
                <h2><i class="fa fa-calendar" aria-hidden="true"></i>Column one</h2>
                <p>
                                Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that's what you see at a toy store. And you must think you're in a toy store, because you're here shopping for an infant named Jeb.
                </p>

                <!-- end slipsum code --> 
            </div>
            <div class="col-md-6 col-md-6"><!-- start slipsum code -->
                <h2>Column two</h2>
                <p>
                                Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that's what you see at a toy store. And you must think you're in a toy store, because you're here shopping for an infant named Jeb.
                </p>

                <!-- end slipsum code --> 
            </div>
          </div> 
        </div>
        
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h3>this is a footer</h3>
                    </div>
                </div>
            </div>
        </footer>
    
    </body>
</html>