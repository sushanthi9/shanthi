<?php
session_start();
//print_r($_SESSION);
include("includes/database.php");

if(isset($_SESSION["email"])==false){
    
      //user has not logged in redirect to login page
    
    //header rewrites the html header

  header("location:login.php");
   //so stop the execution 
    //using exit ensures php stops

}
//update the userdetail
//Get data for countries select
//its a static query does no t need any variables from the user
$countries_query = "SELECT id,country_code,country_name FROM countries";
$countries_result = $connection->query($countries_query);
if($countries_result->num_rows > 0){
    $countries =array();
    while($row = $countries_result ->fetch_assoc()){
        array_push($countries,$row);
    }
    
}
//Get user details
$account_id = $_SESSION["id"];

//AS in he select statement is used to specify alias
$user_query = "SELECT 
                    accounts.email AS email,
                    accounts.name AS username,
                    user_details.first_name As firstname,
                    user_details.last_name AS lastname,
                    user_details.unit_number AS unit,
                    user_details.street_name AS street,
                    user_details.suburb AS suburb,
                    user_details.post_code AS postcode,
                    user_details.state AS state,
                    user_details.country AS country
                    FROM accounts 
                    LEFT JOIN user_details 
                    ON accounts.id = user_details.account_id WHERE accounts.id =?";
$statement = $connection->prepare($user_query);
$statement ->bind_param("i", $_SESSION["id"]); 
$statement ->execute();
$result = $statement ->get_result();
$userdata = $result->fetch_assoc();
?>
<!doctype html>
<html>
  <?php include("includes/head.php"); ?>
  <body>
    <?php include("includes/navigation.php"); ?>
    <div class="container">
        <form id="account-update" action="account.php" method="post">
      <div class="row">
        <div class="col-md-6">
          <h2>Account Details</h2>
          
            <div class="form-group">
              <label for="username">Username</label>
              <?php
                 $username = $userdata["username"]
              ?>
              <input type="text" class="form-control" id="username" name="username" value="<?php echo $username;?>">
            </div>
            <div class="form-group">
              <label for="email">Email Address</label>
              <?php
                 $email = $userdata["email"]
              ?>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password1" name="password1">
            </div>
            <div class="form-group">
              <label for="password">Retype password</label>
              <input type="password" class="form-control" id="password2" name="password2">
            </div>
            <div class="text-center">
              <button type="submit" name="submit" class="btn btn-info">Update</button>
            </div>
         
        </div>
        <div class="col-md-6">
          <h2>Personal Details</h2>
          <!--First Name-->
          <div class="form-group">
            <label for="first-name">First Name</label>
            <input type="text" class="form-control" id="first-name" name="first-name" placeholder="First Name">
          </div>
          <!--Last Name-->
          <div class="form-group">
            <label for="last-name">Last Name</label>
            <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Last Name">
          </div>
          <!--Street Number Unit Number Street Name-->
          <div class="row">
            <!--Unit Number-->
            <div class="col-md-2">
              <div class="form-group">
                <label for="unit-number">Unit</label>
                <input  type="text" class="form-control" id="unit-number" name="unit-number" placeholder="6">
              </div>
            </div>
            <!--Street Number-->
            <div class="col-md-2">
              <div class="form-group">
                <label for="street-number">Number</label>
                <input  type="text" class="form-control" id="street-number" name="street-number" placeholder="42">
              </div>
            </div>
            <!--Street Name-->
            <div class="col-md-8">
              <div class="form-group">
                <label for="street-name">Street</label>
                <input type="text" class="form-control" id="street-name" name="street-name" placeholder="Easy Street">
              </div>
            </div>
          </div>
          <!--Suburb Postcode and State-->
          <div class="row">
            <!--Suburb-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="suburb">Suburb</label>
                <input  type="text" class="form-control" id="suburb" name="suburb" placeholder="East Sydney">
              </div>
            </div>
            <!--Postcode-->
            <div class="col-md-3">
              <div class="form-group">
                <label for="postcode">Postcode</label>
                <input  type="text" class="form-control" id="postcode" name="postcode" placeholder="2000">
              </div>
            </div>
            <!--State-->
            <div class="col-md-5">
              <div class="form-group">
                <label for="suburb">State</label>
                <input  type="text" class="form-control" id="state" name="state" placeholder="New South Wales">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="country">Country</label>
            <select id="country" class="form-control">
                <?php
                $default_country_code = "AU";
                    foreach ($countries as $country) {
                        $name = $country["country_name"];
                        $code = $country["country_code"];
                        $id = $country["id"];
                        if($code == $default_country_code){
                            $selected = "selected";
                        }
                        else{
                            $selected = "";
                        }
                        echo "<option data-id=\"$id\"  $selected value=\"$country\">$name($code)</option>";
                    }
                ?>
            </select>
            <input  type="text" class="form-control" id="country" name="country" placeholder="New Zealand">
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary">
              Update Details
            </button>
          </div>
        </div>
      
       </form>
    </div>
  </body>
</html>