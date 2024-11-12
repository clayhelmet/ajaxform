<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form</title>
    <style>
        form {
            max-width: 400px;
            margin: auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Simple Form</h2>
    <form id="myForm">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="dropdown">Select:</label>
        <select id="dropdown" name="dropdown" required>
            <option value="">--Select an option--</option>
            <option value="Option1">Option 1</option>
            <option value="Option2">Option 2</option>
            <option value="Option3">Option 3</option>
        </select>

        <label for="number">Number:</label>
        <input type="number" id="number" name="number" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>

        <button type="button" onclick="submitForm()">Submit</button>
    </form>
    
    <p id="response"></p>

    <script>
       function submitForm() {
    const formData = new FormData(document.getElementById("myForm"));
    
    fetch("process_form.php", {
        method: "POST",
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.text();
    })
    .then(data => {
        document.getElementById("response").innerHTML = data;
        if (data.includes("successfully")) {
            document.getElementById("myForm").reset();
        }
    })
    .catch(error => {
        console.error("Error: ", error);
        document.getElementById("response").innerHTML = "Error: " + error.message;
    });
}

    </script>
</body>
</html>
