<?php
  $verb = $_SERVER["REQUEST_METHOD"];
  
  if ($verb == "GET"){
      
      $dbhandle = new PDO("sqlite:my_database.litedb") or die("Failed to open DB");
      if (!$dbhandle) die ($error);
      
      $query = "SELECT * FROM Messages";
      
      $statement = $dbhandle->prepare($query);
      $statement->execute();
      
      $results = $statement->fetchAll(PDO::FETCH_ASSOC);
      
       
      //this part is perhaps overkill but I wanted to set the HTTP headers and status code
      //making to this line means everything was great with this request
      header('HTTP/1.1 200 OK'); 
      //this lets the browser know to expect json
      header('Content-Type: application/json');
      //this creates json and gives it back to the browser
      echo json_encode($results);
  } else if ($verb == "POST"){
      $author = "anonymous";
      $content = "secret message";
      if (isset($_POST["author"])){
          $author = $_POST["author"];
      }
      if (isset($_POST["content"])){
          $content = $_POST["content"];
      }
      echo "$author: $content";
  } else {
      echo "USAGE GET or POST";
  }
?>