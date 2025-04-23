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

        #loading {
            height: 100vh;
            width: 100%;
            background-color: white;
            z-index: 10000;
            position: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            top: 0;
            left: 0;
        }

        #loading img {
            width: 200px;
            height: auto;
            margin-bottom: 20px;
        }

        #loading-text {
            font-size: 48px;
            font-weight: bold;
            font-family: 'Playfair Display', serif;
        }

        #progress-bar {
            width: 300px;
            height: 4px;
            background-color: #eee;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 20px;
        }

        #progress-bar-fill {
            height: 100%;
            width: 0%;
            background-color: #b57a43;
            transition: width 0.3s ease;
        }
    </style>
</head>


<body>
    <!-- <div id="loading" style="display: none;"></div> -->

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
        function showLoading(duration) {
            const loading = document.getElementById('loading');
            loading.style.display = 'flex';

            loading.innerHTML = `
            <div>
                <img src="./img/loading.gif" alt="Loading">
                <div id="loading-text">Loading</div>
            </div>
            <div id="progress-bar">
                <div id="progress-bar-fill"></div>
            </div>
        `;

            const loadingText = loading.querySelector('#loading-text');
            const fill = loading.querySelector('#progress-bar-fill');

            let dot = 0;
            let progress = 0;
            const totalSteps = Math.floor(duration / 100);

            const dotInterval = setInterval(() => {
                dot = (dot + 1) % 4;
                loadingText.textContent = 'Loading' + '.'.repeat(dot);
            }, 500);

            const progressInterval = setInterval(() => {
                progress++;
                fill.style.width = (progress / totalSteps * 100) + '%';
            }, 100);

            setTimeout(() => {
                clearInterval(dotInterval);
                clearInterval(progressInterval);

                loading.classList.add('fade-out');

                setTimeout(() => {
                    loading.style.display = 'none';
                    loading.classList.remove('fade-out');
                }, 500);
            }, duration);
        }

        document.addEventListener('DOMContentLoaded', () => showLoading(500));
    </script>
</body>

</html>