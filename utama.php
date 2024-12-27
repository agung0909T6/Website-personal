<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Utama</title>
    <style>
        /* Reset default margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: white;
            text-align: center;
            padding: 50px;
        }

        /* Styling untuk judul */
        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        /* Navigasi styling */
        nav {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
        }

        nav ul {
            list-style: none;
        }

        nav ul li {
            display: inline-block;
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            font-size: 1.5rem;
            color: #fff;
            padding: 10px 20px;
            border: 2px solid transparent;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        /* Hover effect */
        nav ul li a:hover {
            background-color: #2575fc;
            border-color: #2575fc;
            box-shadow: 0px 0px 10px rgba(37, 117, 252, 0.6);
        }
    </style>
</head>
<body>

    <h1>Halaman Utama</h1>

    <nav>
        <ul>
            <li>
                <a href="index.php">MASUK</a>
            </li>
        </ul>
    </nav>

</body>
</html>
