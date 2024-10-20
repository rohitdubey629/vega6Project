<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        #slider_heading {
            color: #fff;
            font-size: 20px;
            font-weight: 400;
            font-family: "Inter", sans-serif;
            width: fit-content;
            display: inline-block;
            background-color: #198754;
            padding: 6px;
            border-radius: 20px 20px 0px 0px;
            line-height: 25px;
            text-align: center;
        }

        #slider_content {
            color: #fff;
            font-size: 15px;
            font-weight: 400;
            line-height: 30px;
            background: #0000006e;
            width: fit-content;
            border-radius: 25px;
            padding: 5px;
        }

        .home_event {

            overflow-y: scroll;
            scrollbar-width: thin;
            scrollbar-color: #007 #fea116;
            height: 420px;
            overflow: auto;
        }

        .action-box {
            height: auto !important;
        }
    </style>

</head>

<body id="bg">
    <div class="page-wraper">



        <?php echo view('pages/layout/header.php'); ?>


        <div class="page-content bg-white">

            <div class="content-block">

                <div class="container text-center mt-5">
                    <h1 class="mb-3">Welcome, <span id="username"><?php echo $userData[0]['name'] ?></span></h1>
                    <img src="<?php echo base_url() ?>/uploads/userProfile/<?php echo $userData[0]['user_pic'] ?>" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                </div>

            </div>
        </div>



    </div>

    <!-- LOADING JS -->
    <script>
        $(function() {
            $('.marquee').marquee({
                speed: 100,
                gap: 0,
                delayBeforeStart: 0,
                direction: 'left',
                duplicated: true,
                pauseOnHover: true
            });
            $('.marquee1').marquee({
                speed: 50,
                gap: 0,
                delayBeforeStart: 0,
                direction: 'up',
                duplicated: true,
                pauseOnHover: true
            });
        });




        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                items: 1, // Number of items you want to display
                loop: true, // Infinite loop
                margin: 10, // Margin between items
                nav: true, // Show next and prev buttons
                dots: false, // Hide pagination dots
                autoplay: true, // Enable auto-play
                autoplayTimeout: 3000, // Time in ms between transitions
                autoplayHoverPause: true // Pause on hover
            });
        });




        $("#homefrm").submit(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var actionUrl = form.attr('action');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>add_home_enquiry",
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    Swal.fire({
                        title: "Success!",
                        text: "Data saved successfully.",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(function() {
                        // Reload the page
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors (optional)
                    console.error(xhr.responseText);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred.',
                        icon: 'error'
                    });
                }
            });

        });
    </script>
</body>

</html>