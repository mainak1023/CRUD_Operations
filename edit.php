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
            font-family: 'Arial', sans-serif;
            background-color: #E8DE9D;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .form-container {
            background: #ffffff;
            border-radius: 8px;
            padding: 25px 30px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        .form-container h2 {
            text-align: center;
            font-size: 24px;
            color: #4B0082;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 6px;
        }

        .form-container input[type="text"],
        .form-container input[type="password"],
        .form-container input[type="email"],
        .form-container input[type="tel"],
        .form-container select,
        .form-container textarea {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background: #fafafa;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        .form-container input:focus,
        .form-container select:focus,
        .form-container textarea:focus {
            border-color: #4B0082;
            background: #fff;
            outline: none;
        }

        .form-container .form-group {
            display: flex;
            gap: 10px;
        }

        .form-container .form-group div {
            flex: 1;
        }

        .form-container .inline-group {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .form-container .inline-group label {
            font-size: 14px;
            color: #555;
        }

        .form-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #4B0082;
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .form-container input[type="submit"]:hover {
            background: #6A0DAD;
        }

        .photo-upload {
            margin-bottom: 15px;
        }

        .photo-upload label {
            display: block;
            margin-bottom: 6px;
        }

        .photo-preview {
            width: 150px;
            height: 150px;
            border: 2px dashed #ccc;
            border-radius: 5px;
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .photo-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        #photo-input {
            margin-top: 8px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Update User</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="photo-upload">
                <label for="photo-input">Profile Photo</label>
                <input type="file" id="photo-input" name="photo" accept="image/*" onchange="previewImage(this)">
                <div class="photo-preview" id="photo-preview">
                    <img src="uploads/<?php echo $result['photo'] ? $result['photo'] : 'default.png'; ?>" 
                         alt="Profile Preview" id="preview-img">
                </div>
            </div>

            <div class="form-group">
                <div>
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" value="<?php echo $result['fname']; ?>" name="fname" required>
                </div>
                <div>
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" value="<?php echo $result['lname']; ?>" name="lname" required>
                </div>
            </div>

            <label for="password">Password</label>
            <input type="password" id="password" value="<?php echo $result['password']; ?>" name="password" required>

            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" value="<?php echo $result['conpassword']; ?>" name="conpassword" required>

            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
                <option value="">Select</option>
                <option value="Male" <?php echo (strtolower($result['gender']) == 'male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo (strtolower($result['gender']) == 'female') ? 'selected' : ''; ?>>Female</option>
                <option value="Other" <?php echo (strtolower($result['gender']) == 'other') ? 'selected' : ''; ?>>Other</option>
            </select>

            <label for="email">Email Address</label>
            <input type="email" id="email" value="<?php echo $result['email']; ?>" name="email" required>

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" value="<?php echo $result['phone']; ?>" name="phone" required>

            <label>Nationality:</label>
            <div class="inline-group">
                <input type="radio" id="indian" name="nationality" value="Indian" 
                       <?php echo ($result['nationality'] == 'Indian') ? 'checked' : ''; ?> required>
                <label for="indian">Indian</label>
                <input type="radio" id="nri" name="nationality" value="NRI" 
                       <?php echo ($result['nationality'] == 'NRI') ? 'checked' : ''; ?> required>
                <label for="nri">NRI</label>
            </div>

            <label>Languages Known:</label>
            <div class="inline-group">
                <input type="checkbox" id="bengali" name="language[]" value="Bengali" 
                       <?php echo (strpos($result['language'], 'Bengali') !== false) ? 'checked' : ''; ?>>
                <label for="bengali">Bengali</label>
                <input type="checkbox" id="english" name="language[]" value="English" 
                       <?php echo (strpos($result['language'], 'English') !== false) ? 'checked' : ''; ?>>
                <label for="english">English</label>
                <input type="checkbox" id="hindi" name="language[]" value="Hindi" 
                       <?php echo (strpos($result['language'], 'Hindi') !== false) ? 'checked' : ''; ?>>
                <label for="hindi">Hindi</label>
            </div>

            <label for="address">Address</label>
            <textarea id="address" name="address" rows="3"><?php echo $result['address']; ?></textarea>

            <input type="submit" value="Update" name="update">
        </form>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview-img');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
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

    // Handle photo upload
    $photo_update = '';
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['photo']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        
        if(in_array(strtolower($filetype), $allowed)) {
            // Generate unique name
            $newname = uniqid() . '.' . $filetype;
            $upload_path = 'uploads/' . $newname;
            
            if(move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path)) {
                // Delete old photo if exists and not default
                if($result['photo'] && $result['photo'] != 'default.png') {
                    @unlink('uploads/' . $result['photo']);
                }
                $photo_update = ", photo='$newname'";
            }
        }
    }

    $query = "UPDATE FORM SET 
            fname='$fname', 
            lname='$lname', 
            password='$password', 
            conpassword='$conpassword', 
            gender='$gender', 
            email='$email', 
            phone='$phone', 
            nationality='$nationality', 
            language='$language', 
            address='$address'
            $photo_update 
            WHERE id='$id'";

    $data = mysqli_query($conn, $query);

    if ($data) {
        echo "<script>
                alert('Data successfully updated!');
                window.location.href = 'index.php';
            </script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>