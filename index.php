<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>CoreTrack Lite</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body class="d-flex align-items-center justify-content-center">

    <div class="container d-flex flex-column justify-content-center w-50 w-sm-100 w-md-50 w-lg-35">
        <form id="user-form"
            class="d-flex flex-column justify-content-center align-items-center w-100 p-4 border rounded shadow">

            <div id="dealer-code" class="input-group mb-3 d-none">
                <span class="input-group-text" id="basic-addon1">#</span>
                <input type="text" class="form-control" placeholder="Dealer Code e.g., DLR-001" name="dealercode"
                    aria-label="Dealercode" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon2">@</span>
                <input required type="text" class="form-control" placeholder="Username" name="username"
                    aria-label="Username" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">*</span>
                <input required type="password" class="form-control" placeholder="Password" name="password"
                    aria-label="Password" aria-describedby="basic-addon1">
            </div>

            <input id="form-submit" class="btn btn-primary" type="submit" value="Login">

            <div id="form-alert" class="alert alert-danger mt-2 d-none" role="alert"></div>
        </form>

        <div class="d-flex align-items-center justify-content-center p-4 gap-2 w-100">
            <span id="form-context-label">New user?</span>
            <button id="form-context" onclick="toggleForm()" type="button" class="btn btn-success" role="button">Sign
                Up</button>
        </div>

    </div>

    <script src="./js/index.js"></script>

</body>

</html>