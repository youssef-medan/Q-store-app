<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>Register</title>
</head>
<body>
    <h1 class="d-flex justify-content-center">Q-shop Dashboard</h1>

    <h3 class="d-flex justify-content-center">Register</h3>
    <form method="POST" action="register" class="d-flex justify-content-center ">
        @csrf

        <div class="container row border border-warning rounded my-5 d-flex justify-content-center">

            <div class="mt-5"></div>

            <div class="col-6 row mb-4">
                <label class="col-2">Name :</label>
                <input name="name" class="border border-warning rounded col-8" type="text" placeholder="">
            </div>

            <div class="col-6 row mb-4">
                <label class="col-2">Email :</label>
                <input  name="email" class="border border-warning rounded col-8" type="email" placeholder="">
            </div>
            <div class="col-6 row mb-4">
                <label class="col-2">password :</label>
                <input name="password" class="border border-warning rounded col-8" type="password" placeholder="">
            </div>
            <div class="col-6 row mb-4">
                <label class="col-2">mobile :</label>
                <input name="mobile" class="border border-warning rounded col-8" type="number" placeholder="">
            </div>

            <input name="role" class="border border-warning rounded"  value="admin" hidden>

            <div class="col-2 row ">
                <button class="btn btn-warning col-12 mb-5">Submit</button>

            </div>



        </div>


    </form>
    <div class="container">
        <p>have account already ? <a href="{{route('login.index')}}">Login now</a></p>
    </div>

</body>
<footer></footer>
</html>
