<?php 
include("connection.php"); 
error_reporting(0);

$query = "SELECT * FROM FORM";
$data = mysqli_query($conn, $query);

$total = mysqli_num_rows($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

        .container {
            width: 100%;
            max-width: 1400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 26px;
            font-weight: bold;
            color: #333;
        }

        .add-user-btn {
            display: block;
            margin: 0 auto 20px;
            padding: 12px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            text-align: center;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .add-user-btn:hover {
            background-color: #45a049;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            color: #333;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        th {
            background-color: #f1f1f1;
            color: #555;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        td a {
            display: inline-block;
            padding: 6px 12px;
            font-size: 14px;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn-edit {
            background-color: #2196F3;
        }

        .btn-edit:hover {
            background-color: #1976D2;
        }

        .btn-delete {
            background-color: #f44336;
        }

        .btn-delete:hover {
            background-color: #d32f2f;
        }

        p {
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
            color: #666;
        }

        /* New styles for photo display */
        .user-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dashboard</h2>
        <a href="form.php" class="add-user-btn">Add New User</a>
        <?php if ($total != 0) { ?>
        <div class="table-wrapper">
            <table>
                <tr>
                    <th>Photo</th>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Nationality</th>
                    <th>Language Known</th>
                    <th>Address</th>
                    <th>Operations</th>
                </tr>
                <?php while ($result = mysqli_fetch_assoc($data)) { ?>
                    <tr>
                        <td>
                            <?php if (!empty($result['photo'])) { ?>
                                <img src="uploads/<?php echo $result['photo']; ?>" alt="User photo" class="user-photo">
                            <?php } else { ?>
                                <img src="uploads/default.png" alt="Default photo" class="user-photo">
                            <?php } ?>
                        </td>
                        <td><?php echo $result['id']; ?></td>
                        <td><?php echo $result['fname']; ?></td>
                        <td><?php echo $result['lname']; ?></td>
                        <td><?php echo $result['gender']; ?></td>
                        <td><?php echo $result['email']; ?></td>
                        <td><?php echo $result['phone']; ?></td>
                        <td><?php echo $result['nationality']; ?></td>
                        <td><?php echo $result['language']; ?></td>
                        <td><?php echo $result['address']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $result['id']; ?>" class="btn-edit">Edit</a>
                            <a href="delete.php?id=<?php echo $result['id']; ?>" class="btn-delete">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <?php } else { ?>
        <p>No Data Found</p>
        <?php } ?>
    </div>
</body>
</html>