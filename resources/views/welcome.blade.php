<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Personal - Start Bootstrap Theme</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Custom Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: relative;
        }
        .upper-section {
            background-color: #25a7bc;
            color: white;
            padding: 50px 0;
            flex-basis: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .lower-section {
            background-color: white;
            color: black;
            padding: 50px 0;
            flex-basis: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            display: flex;
            justify-content: space-between;
            width: 80%;
        }
        .left, .right {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .left {
            align-items: flex-start;
            text-align: left;
        }
        .btn-primary {
            margin: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            color: white;
            cursor: pointer;
        }
        .btn-secondary {
            margin: 10px;
            padding: 10px 20px;
            background-color: #cde5ff;
            border: none;
            color: #083075;
            cursor: pointer;
        }
        .btn-secondary:hover {
            background-color: white;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .illustration {
            max-width: 100%;
            height: auto;
        }
        .illustration-container {
            position: absolute;
            top: 50%;
            right: 10%;
            transform: translateY(-50%);
            background: none;
        }
        .illustration {
            width: 900px;
            height: auto;
        }

        .crm  {
            width: 600px;
            height: auto;
        }
        .client-numbers {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .client-number {
            margin: 10px 0;
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="upper-section">
        <div class="container">
            <div class="left">
                <h1 class="mb-4">CUSTOMER RELATIONSHIP MANAGEMENT</h1>
                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3">
                    <button class="btn btn-secondary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder" onclick="window.location.href='{{ route('login') }}'">Login</button>
                    <button class="btn btn-primary btn-lg px-5 py-3 fs-6 fw-bolder" onclick="window.location.href='{{ route('register') }}'">Register</button>
                </div>
            </div>
        </div>
    </div>
    <div class="lower-section">
        <div class="container">
            <div class="client-numbers">
                <img src="{{ asset('img/crm.jpg') }}" alt="Illustration" class="crm">
            </div>
        </div>
    </div>
    <div class="illustration-container">
        <img src="{{ asset('img/tablet.png') }}" alt="Illustration" class="illustration">
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>
