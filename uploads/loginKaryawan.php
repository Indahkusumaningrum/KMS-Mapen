<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Karyawan</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .login-section {
            background-color: #a7bcbc;
            padding: 40px;
            border-radius: 10px 0 0 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 50%;
        }

        .login-section h2 {
            margin: 0;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .login-section h1 {
            margin: 0;
            margin-bottom: 40px;
            font-size: 32px;
            color: #000;
        }

        .error-message {
            color: red;
            margin-bottom: 20px;
            font-size: 12px;
            text-align: center;
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
        }

        .login-section .input-group {
            margin-bottom: 20px;
            width: 100%;
            position: relative;
        }

        .login-section .input-group input {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 30px;
            font-size: 16px;
        }

        .login-section .input-group i {
            position: absolute;
            margin-left: 15px;
            margin-top: 15px;
            color: #ccc;
        }

        .login-section .input-group input::placeholder {
            color: #ccc;
        }

        .login-section .input-group-password {
            position: relative;
        }

        .login-section .input-group-password i {
            cursor: pointer;
        }

        .login-section .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 30px;
            background-color: #33c3bd;
            color: white;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 20px auto 0; /* Center the button */
            text-align: center;
        }

        .logo-section {
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            border-radius: 0 10px 10px 0;
            width: 50%;
        }

        .logo-section img {
            max-width: 100%;
            height: auto;
        }

        .logo-section h2 {
            margin: 0;
            font-size: 32px;
            color: #333;
        }

        .as-admin {
            margin-top: 10px;
            padding: 5px 10px;
            border: bold;
            border-color: rgb(0,0,0,0.3);
            border-radius: 30px;
            background-color: #33c3bd;
            color: white;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 20px auto 0; /* Center the button */
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-section">
            <h2>Welcome to</h2>
            <h1>TrackXpert</h1>
            <?php
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo '<div class="error-message">Username atau password salah</div>';
            }
            ?>
            <form action="SESSION-Login/login.php" method="POST">
                <div class="input-group">
                    <input id="username" type="text" name="username" placeholder="Username">
                </div>
                <div class="input-group input-group-password">
                    <input id="inputPassword" type="password" name="password" placeholder="Password">
                    <i class="fas fa-eye"></i>
                </div>
                <button class="btn">Sign in</button>
            </form>

            <form action="loginAdmin.php">
                <button class="as-admin">Login as Admin</button>
            </form>
        </div>
        <div class="logo-section">
            <div>
                <img src="gambar/logo.png" alt="TrackXpert Logo" width="200px"> 
            </div>
        </div>
    </div>

    <!-- Font Awesome Script -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
