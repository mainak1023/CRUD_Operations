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
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #2d3748;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            line-height: 1.6;
        }

        .form-container {
            background: #ffffff;
            border-radius: 16px;
            padding: 40px;
            max-width: 700px;
            width: 100%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            font-size: 28px;
            color: #2d3748;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .form-container label {
            display: block;
            font-size: 14px;
            color: #4a5568;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-container input[type="text"],
        .form-container input[type="password"],
        .form-container input[type="email"],
        .form-container input[type="tel"],
        .form-container select,
        .form-container textarea {
            width: 100%;
            padding: 12px 16px;
            margin-bottom: 20px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            background: #fff;
            transition: all 0.3s ease;
        }

        .form-container input:focus,
        .form-container select:focus,
        .form-container textarea:focus {
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
            outline: none;
        }

        .form-container textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .inline-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 20px;
            padding: 10px 0;
        }

        .inline-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            margin: 0;
        }

        .inline-group input[type="radio"],
        .inline-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #4299e1;
        }

        .terms {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 25px 0;
            padding: 15px;
            background: #f7fafc;
            border-radius: 8px;
        }

        .terms input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #4299e1;
        }

        input[type="submit"] {
            width: 100%;
            padding: 14px;
            background: #4299e1;
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #3182ce;
            transform: translateY(-1px);
        }

        .photo-upload {
            margin-bottom: 25px;
        }

        .photo-input-container {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .photo-preview {
            width: 120px;
            height: 120px;
            border: 2px dashed #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f7fafc;
        }

        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        input[type="file"] {
            padding: 10px;
            background: #f7fafc;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            width: calc(100% - 140px);
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 25px;
            }

            .form-group {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .photo-input-container {
                flex-direction: column;
            }

            .photo-preview {
                width: 100%;
                height: 200px;
            }

            input[type="file"] {
                width: 100%;
            }

            .inline-group {
                gap: 15px;
            }
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
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['photo']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        if (in_array(strtolower($filetype), $allowed)) {
            // Generate unique name
            $newname = uniqid() . '.' . $filetype;
            $upload_path = 'uploads/' . $newname;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path)) {
                // Delete old photo if exists and not default
                if ($result['photo'] && $result['photo'] != 'default.png') {
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