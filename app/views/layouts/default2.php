<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BS5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- SWIPER -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" /> -->
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Style.css -->

    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

        .cursor-dot {
            position: fixed;
            width: 5px;
            height: 5px;
            background: #b57a43;
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%) scale(1);
            transition: transform 0.4s ease, background 0.4s ease;
        }

        a {
            transition: 0.2s ease-in-out;

        }

        a:hover {
            color: #bd844c;
        }

        .cursor-ring {
            position: fixed;
            width: 30px;
            height: 30px;
            border: 1px solid #b57a43;
            border-radius: 50%;
            pointer-events: none;
            z-index: 9998;
            transform: translate(-50%, -50%);
        }

        body.hovered .cursor-dot {
            transform: translate(-50%, -50%) scale(13);
            background: rgba(185, 123, 66, 0.2);
        }

        body.hovered .cursor-ring {
            opacity: 0;
        }
    </style>
</head>


<body>

    <div id="toast" class="toast bg-white" style="position: fixed; top: 32px; right: 20px; z-index: 50;" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">SportKing</strong>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button> -->
        </div>
        <div class="toast-body" id="toast-mesage">
        </div>
    </div>


    <div>
        <?php include_once $header ?>
    </div>

    <div>
        <?php include_once $content ?>
    </div>

    <div>
        <?php include_once $footer ?>
    </div>
    <!-- BS5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src=" ./js/main.js"></script>
    <script>
        function myCursor() {
            const dot = document.querySelector('.cursor-dot');
            const ring = document.querySelector('.cursor-ring');

            let mouseX = 0,
                mouseY = 0;
            let ringX = 0,
                ringY = 0;

            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                dot.style.left = `${mouseX}px`;
                dot.style.top = `${mouseY}px`;
            });

            function animate() {
                ringX += (mouseX - ringX) * 0.3;
                ringY += (mouseY - ringY) * 0.3;
                ring.style.left = `${ringX}px`;
                ring.style.top = `${ringY}px`;
                requestAnimationFrame(animate);
            }

            const hoverElements = document.querySelectorAll('a, button, img');
            hoverElements.forEach(el => {
                el.addEventListener('mouseenter', () => {
                    document.body.classList.add('hovered');
                });
                el.addEventListener('mouseleave', () => {
                    document.body.classList.remove('hovered');
                });
            });

            animate();
        }

        document.addEventListener('DOMContentLoaded', myCursor);
    </script>

</body>

</html>