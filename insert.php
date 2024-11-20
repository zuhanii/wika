<!DOCTYPE html>
<html>
<head>
    <title>Machine Breakdown Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* light blue */
            color: #000; /* black */
        }
        h2 {
            color: #4682b4; /* steel blue */
        }
        form {
            background-color: #fff; /* white */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #4682b4; /* steel blue */
        }
        input[type="text"],
        textarea,
        select {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="file"] {
            width: calc(100% - 12px);
            margin-top: 5px;
        }
        input[type="submit"] {
            background-color: #4682b4; /* steel blue */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #36648b; /* darker steel blue */
        }
        .error {
            color: red;
        }
        input[readonly] {
            background-color: #e9ecef; /* light gray for read-only inputs */
        }
		 .navbar {
            background-color: #007bff; /* blue */
		    
            padding: 10px 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .navbar img {
            height: 40px;
            width: auto;
        }
    </style>
</head>
<body>
<div class="navbar">
    <div>
        <a href="tracking.php">Track Status</a>
        <a href="insert.php">Submit Request</a>
    </div>
    <div>
   <img src="logo.png" alt="Logo">
   
    </div>
</div>


<h2 align = "center">Machine Breakdown Form</h2>
<form action="process.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    <label for="machine_id">Machine ID:</label>
    <select id="machine_id" name="machine_id" onchange="fetchMachineDetails()">
	 <option value="">Select Machine ID</option>
        <option value="WIKA/GZB/TOOL/TRC/01">WIKA/GZB/TOOL/TRC/01</option>
        <option value="WIKA/GZB/TOOL/TRM/01">WIKA/GZB/TOOL/TRM/01</option>
		
        <!-- Add more options as needed -->
    </select><br>

    <label for="machine_name">Machine Name:</label>
    <input type="text" id="machine_name" name="machine_name" readonly><br>

    <label for="cost_center">Cost Center:</label>
    <input type="text" id="cost_center" name="cost_center" readonly><br>

    <label for="breakdown_type">Type of Breakdown:</label>
    <select id="breakdown_type" name="breakdown_type">
        <option value="Mechanical">Mechanical</option>
        <option value="Electrical">Electrical</option>
        <option value="Software">Software</option>
        <option value="Other">Other</option>
    </select><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" cols="50"></textarea><br>
    
    <label for="image">Upload Image:</label>
    <input type="file" accept="image/jpeg" id="image" name="image"><br>
    
    <br>
    <label for="submission_time">Date and Time of Submission:</label>
    <br>
    <input type="datetime-local" id="submission_time" name="submission_time" readonly><br>
    <br>
    <input type="submit" name="Submit" value="Submit">
</form>

<script>
    function setCurrentDateTime() {
        var now = new Date();
        var year = now.getFullYear();
        var month = ('0' + (now.getMonth() + 1)).slice(-2);
        var day = ('0' + now.getDate()).slice(-2);
        var hours = ('0' + now.getHours()).slice(-2);
        var minutes = ('0' + now.getMinutes()).slice(-2);

        var formattedDateTime = year + '-' + month + '-' + day + 'T' + hours + ':' + minutes;
        document.getElementById('submission_time').value = formattedDateTime;
    }

    function fetchMachineDetails() {
        var machineId = document.getElementById("machine_id").value;
        if (machineId !== "") {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_machine_details.php?machine_id=" + machineId, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById("machine_name").value = response.machineName;
                    document.getElementById("cost_center").value = response.costCenter;
                }
            };
            xhr.send();
        }
    }

    function validateForm() {
        var machineId = document.getElementById("machine_id").value;
        var machineName = document.getElementById("machine_name").value;
        var costCenter = document.getElementById("cost_center").value;
        var description = document.getElementById("description").value;

        if (machineId == "") {
            alert("Machine ID must be filled out");
            return false;
        }

        if (machineName == "") {
            alert("Machine Name must be filled out");
            return false;
        }

        if (costCenter == "") {
            alert("Cost Center must be filled out");
            return false;
        }

        if (description == "") {
            alert("Description must be filled out");
            return false;
        }
         
        return true;
    }
     
    // Set the current date and time when the page loads
    window.onload = setCurrentDateTime;
</script>
</body>
</html>
