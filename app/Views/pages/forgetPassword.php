<!DOCTYPE html>
<html lang="en">

<head>
    <script src="<?php echo base_url('public/assets/') ?>vendor/jquery/jquery.min.js"></script>

    <script src="<?php echo base_url('public/assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Importing fonts from Google */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        /* Reseting */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            /* background: #ecf0f3; */
            background: #005fa5;
            ;
        }

        .wrapper {
            max-width: 350px;
            min-height: 460px;
            margin: 80px auto;
            padding: 40px 30px 30px 30px;
            background-color: #ecf0f3;
            border-radius: 15px;
            /* box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff; */
        }

        .logo {
            width: 80px;
            margin: auto;
        }

        .logo img {
            margin-top: -23px;
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0px 0px 3px #5f5f5f,
                0px 0px 0px 5px #ecf0f3,
                8px 8px 15px #a7aaa7,
                -8px -8px 15px #fff;
        }

        .wrapper .name {
            font-weight: 500;
            font-size: 1.2rem;
            letter-spacing: 1.3px;
            padding-left: 10px;
            color: #555;
            margin-bottom: -10px;
        }

        .wrapper .form-field input {
            width: 100%;
            display: block;
            border: none;
            outline: none;
            background: none;
            font-size: 1.2rem;
            color: #666;
            padding: 10px 15px 10px 10px;
            /* border: 1px solid red; */
        }

        .wrapper .form-field {
            padding-left: 10px;
            margin-bottom: 40px;
            margin-top: 40px;
            border-radius: 20px;
            box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
        }

        .wrapper .form-field .fas {
            color: #555;
        }

        .wrapper .btn {
            box-shadow: none;
            width: 100%;
            height: 40px;
            background-color: #03A9F4;
            color: #fff;
            border-radius: 25px;
            box-shadow: 3px 3px 3px #b1b1b1,
                -3px -3px 3px #fff;
            letter-spacing: 1.3px;
        }

        .wrapper .btn:hover {
            background-color: #039BE5;
        }

        .wrapper a {
            text-decoration: none;
            font-size: 0.8rem;
            color: #03A9F4;
        }

        .wrapper a:hover {
            color: #039BE5;
        }

        @media(max-width: 380px) {
            .wrapper {
                margin: 30px 20px;
                padding: 40px 15px 15px 15px;
            }
        }
    </style>
</head>

<body id="page-top">
    <div class="wrapper">
        <div id="div-msg" class="alert  alert-dismissible fade show" style="display:none"></div>

        <div class="text-center mt-4 name">
            Forget Password
        </div>
        <form class="p-3 mt-3" method="post" autocomplete="off" id="login_form">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password" required>
            </div>
            <button class="btn mt-3" style="cursor: pointer;">Update Password</button>
        </form>
        <div class="text-center fs-6">
            <a href="<?php echo base_url("login") ?>">Login</a>
        </div>
        <div class="text-center">

        </div>
    </div>


</body>

<script>
    $(document).ready(function() {
        $("#login_form").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url("changePassword") ?>",
                data: form.serialize(),
                dataType: "json",
                success: function(responce) {
                    if (responce.status == false) {
                        $('#div-msg').addClass("alert-danger").removeClass("alert-success").html(responce.msg).slideDown(500).delay(5000).slideUp(500);
                    } else {
                        $('#div-msg').addClass("alert-success").removeClass("alert-danger").html(responce.msg).slideDown(500).delay(2000).slideUp(function() {
                            //   window.location.reload();
                            window.location.href = "<?php echo base_url('login') ?>";
                        });
                    }
                }
            });
        });
    });
</script>

</html>