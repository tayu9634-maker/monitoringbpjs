<?php include("../config/database.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <style>
        /* Copy seluruh CSS dari file registrasi.css ke sini */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
        }

        form {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 0.6s ease-out;
        }

        h2 {
            margin-bottom: 30px;
            font-size: 28px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #f093fb;
            transform: translateX(5px);
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: translateY(-30px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        @media (max-width: 480px) {
            form {
                padding: 25px;
            }
            h2 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <h2>Form Registrasi</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
        <button type="submit" name="register">Register</button>
    </form>

<?php
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $confirm  = $_POST['confirm_password'];

    if (password_verify($confirm, $password)) {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "<div style='background: #d4edda; color: #155724; padding: 12px; border-radius: 10px; margin-top: 20px; text-align: center;'>Registrasi berhasil. <a href='index.php' style='color: #155724;'>Login</a></div>";
        } else {
            echo "<div style='background: #f8d7da; color: #721c24; padding: 12px; border-radius: 10px; margin-top: 20px; text-align: center;'>Error: " . $conn->error . "</div>";
        }
    } else {
        echo "<div style='background: #f8d7da; color: #721c24; padding: 12px; border-radius: 10px; margin-top: 20px; text-align: center;'>Password tidak sama!</div>";
    }
}
?>
</body>
</html>