<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>403 Forbidden Access</title>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            font-family: 'Comfortaa', sans-serif;
            background-color: #35374B; /* Manually darkened color */
        }

        .container {
            z-index: 1;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            padding: 10px;
            min-width: 300px;
        }

        h1 {
            font-size: 100px;
            text-align: center;
            color: #eee;
            font-weight: 100;
            margin: 0;
            position: relative;
        }

        h1 .lock {
            display: inline-block;
            margin: 0 10px;
            vertical-align: middle;
        }

        p {
            color: #fff;
            font-size: 24px;
        }

        .lock {
            position: relative;
            width: 60px;
            height: 100px;
            display: inline-block;
            opacity: 1;
        }

        .lock .top {
            height: 60px;
            width: 50px;
            border-radius: 50%;
            border: 10px solid #fff;
            display: block;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .lock .bottom {
            background: #D68910;
            height: 40px;
            width: 60px;
            display: block;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .lock.falling {
            transition: 0.5s ease;
            opacity: 0;
            position: absolute;
            animation: 2s move linear forwards;
        }

        @keyframes move {
            to {
                top: 100%;
            }
        }

        .back-button {
            background-color: #fff;
            color: #c4550f;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #d68910;
            color: #fff;
        }

        @media (max-width: 420px) {
            .container {
                transform: translate(-50%, -50%) scale(0.8);
            }
        }
    </style>

    <script>
        const interval = 500;

        function generateLocks() {
            const lock = document.createElement('div'),
                  position = generatePosition();
            lock.innerHTML = '<div class="top"></div><div class="bottom"></div>';
            lock.style.top = position[0];
            lock.style.left = position[1];
            lock.classList.add('lock', 'falling');
            document.body.appendChild(lock);
            setTimeout(() => {
                lock.style.opacity = '1';
            }, 100);
            setTimeout(() => {
                lock.remove();
            }, 2000);
        }

        function generatePosition() {
            const x = Math.round((Math.random() * 100) - 10) + '%';
            const y = Math.round(Math.random() * 100) + '%';
            return [x, y];
        }

        setInterval(generateLocks, interval);
        generateLocks();

        function goBack() {
            history.back();
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>4<div class="lock"><div class="top"></div><div class="bottom"></div></div>3</h1>
        <p>Access denied! You don't have a permission to access this page.</p>
        
        <!-- Back Button -->
        <button class="back-button" onclick="goBack()">Go Back</button>
    </div>
</body>
</html>
