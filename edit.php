<?php 
include("connection.php"); 
$id = $_GET['id'];

$query = "SELECT * FROM FORM WHERE id = '$id'";
$data = mysqli_query($conn, $query);

$result = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #F4F4F4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            border-radius: 8px;
            padding: 25px 30px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            color: #4B0082;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 14px;
            color: #555;
        }

        input, select, textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
            width: 100%;
        }

        textarea {
            resize: none;
        }

        input[type="radio"], input[type="checkbox"] {
            margin-right: 10px;
        }

        .radio-group, .inline-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
        }

        .radio-group label, .inline-group label {
            font-weight: normal;
        }

        .btn {
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .inline-group {
            flex-direction: row;
            align-items: center;
        }

        .radio-group {
            flex-direction: row;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update User</h2>
        <form action="#" method="POST">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" value="<?php echo $result['fname']; ?>" name="fname" required>

            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" value="<?php echo $result['lname']; ?>" name="lname" required>

            <label for="password">Password</label>
            <input type="password" id="password" value="<?php echo $result['password']; ?>" name="password" required>

            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" value="<?php echo $result['conpassword']; ?>" name="conpassword" required>

            <label for="gender">Gender</label>
            <select id="gender" name="gender">
                <option value="">Select</option>
                <option value="Male" <?php echo (strtolower($result['gender']) == 'male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo (strtolower($result['gender']) == 'female') ? 'selected' : ''; ?>>Female</option>
                <option value="Other" <?php echo (strtolower($result['gender']) == 'other') ? 'selected' : ''; ?>>Other</option>
            </select>

            <label for="email">Email Address</label>
            <input type="email" id="email" value="<?php echo $result['email']; ?>" name="email" required>

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" value="<?php echo $result['phone']; ?>" name="phone" required>

            <label>Nationality</label>
            <div class="radio-group">
                <input type="radio" id="indian" name="nationality" value="Indian" <?php echo ($result['nationality'] == 'Indian') ? 'checked' : ''; ?>>
                <label for="indian">Indian</label>

                <input type="radio" id="nri" name="nationality" value="NRI" <?php echo ($result['nationality'] == 'NRI') ? 'checked' : ''; ?>>
                <label for="nri">NRI</label>
            </div>

            <label>Languages Known</label>
            <div class="inline-group">
                <input type="checkbox" id="bengali" name="language[]" value="Bengali" <?php echo (strpos($result['language'], 'Bengali') !== false) ? 'checked' : ''; ?>>
                <label for="bengali">Bengali</label>

                <input type="checkbox" id="english" name="language[]" value="English" <?php echo (strpos($result['language'], 'English') !== false) ? 'checked' : ''; ?>>
                <label for="english">English</label>

                <input type="checkbox" id="hindi" name="language[]" value="Hindi" <?php echo (strpos($result['language'], 'Hindi') !== false) ? 'checked' : ''; ?>>
                <label for="hindi">Hindi</label>
            </div>

            <label for="address">Address</label>
            <textarea id="address" name="address" rows="3"><?php echo $result['address']; ?></textarea>

            <input type="submit" value="Update" class="btn" name="update">
        </form>
    </div>
</body>
</html>

<?php 
if (isset($_POST['update'])) {
    $fname       = $_POST['fname'];
    $lname       = $_POST['lname'];
    $password    = $_POST['password'];
    $conpassword = $_POST['conpassword'];
    $gender      = $_POST['gender'];
    $email       = $_POST['email'];
    $phone       = $_POST['phone'];
    $nationality = $_POST['nationality'];
    $language    = isset($_POST['language']) ? implode(" ", $_POST['language']) : '';
    $address     = $_POST['address'];

    $query = "UPDATE FORM SET fname='$fname', lname='$lname', password='$password', 
    conpassword='$conpassword', gender='$gender', email='$email', phone='$phone', nationality='$nationality', language='$language', address='$address' WHERE id='$id'";

    $data = mysqli_query($conn, $query);

    if ($data) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
