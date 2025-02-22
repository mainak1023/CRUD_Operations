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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Modern Dashboard Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #1a1a1a;
        }

        .dashboard {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 0 10px;
        }

        h1 {
            font-size: 28px;
            color: #1a1a1a;
            font-weight: 600;
        }

        .add-user-btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(76, 175, 80, 0.2);
        }

        .add-user-btn:hover {
            background-color: #45a049;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(76, 175, 80, 0.2);
        }

        .table-wrapper {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        th {
            background-color: #f8f9fa;
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: #5c5c5c;
            border-bottom: 1px solid #edf2f7;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #edf2f7;
            color: #4a5568;
            font-size: 14px;
        }

        tr:hover {
            background-color: #f8fafc;
        }

        .user-photo {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-edit,
        .btn-delete {
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 0 4px;
        }

        .btn-edit {
            background-color: #3b82f6;
            color: white;
        }

        .btn-edit:hover {
            background-color: #2563eb;
        }

        .btn-delete {
            background-color: #ef4444;
            color: white;
        }

        .btn-delete:hover {
            background-color: #dc2626;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #6b7280;
            font-size: 16px;
            background: white;
            border-radius: 12px;
            margin-top: 20px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .dashboard {
                margin: 15px auto;
                padding: 0 15px;
            }

            .table-wrapper {
                overflow-x: auto;
            }

            .dashboard-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            th,
            td {
                padding: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <div class="dashboard-header">
            <h1>Dashboard</h1>
            <a href="form.php" class="add-user-btn">
                <i class="fas fa-plus"></i> Add New User
            </a>
        </div>

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
            <div class="no-data">
                <i class="fas fa-info-circle"></i> No Data Found
            </div>
        <?php } ?>
    </div>
</body>

</html>