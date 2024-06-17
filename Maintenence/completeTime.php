<?php
if(isset($_GET['id'])) {
                // Get the 'id' from the URL
                $id = $_GET['id'];
}

				?>
				<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click Button</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa; /* light gray */
            color: #333; /* dark gray */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #fff; /* white */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            background-color: #007bff; /* blue */
            text-decoration: none;
            margin-top: 20px;
        }
        .btn:hover {
		    
            background-color: #0056b3; /* darker blue */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Are you sure you are ending Maintenence work for this machine?</h2>
		        
<form action='submitTime.php?id=<?php echo $id."'";?> method="POST"> 
   
           <button name="click"  class=\"btn\">End</button>
		
    </div>
	
</body>
</html>
