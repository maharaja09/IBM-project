<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <style>
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            background-color: #333;
            overflow: hidden;
        }

        nav li {
            float: left;
        }

        nav li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        /* Style the active link on :active (when clicked) */
        nav li a:active {
            background-color: yellow;
            color: white;
            /* You can customize the text color for the active link */
        }
    </style>
</head>

<body>

    <nav>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>

    
    <div id="home">
        <h1>Welcome</h1>
        <p>hello how r u</p>
    </div>

    <div id="about">
        <h3>Check the status</h3>
    </div>

</body>

</html>