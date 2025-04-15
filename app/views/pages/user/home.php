<style>
    .container {
        max-width: 1250px;
    }

    .zoom-img {
        transition: transform 0.5s ease;
        height: 600px;
        object-fit: cover;
        width: 100%;
    }

    .zoom-img:hover {
        transform: scale(1.05);
    }

    /* cursor css */

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

    .mylogo path {
        fill: #bd844c;
    }

    .custom-tabs {
        display: flex;
        gap: 15px;
        border-bottom: 2px solid #ddd;
        padding-bottom: 2px;
    }

    .custom-tabs .nav-link {
        font-size: 16px;
        font-weight: 600;
        color: gray;
        position: relative;
        transition: color 0.3s ease-in-out;
    }

    .custom-tabs .nav-link.active {
        color: black;
        font-weight: bold;
    }

    .custom-tabs .nav-link.active::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -3px;
        width: 100%;
        height: 3px;
        background-color: black;
        transition: width 0.3s ease-in-out;
    }

    .custom-tabs .nav-link:hover {
        color: black;
    }


    swiper-slide {
        height: 300px;
        background: white;
        border: 1px solid #ccc;
        text-align: center;
    }

    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    #loading {
        height: 100vh;
        width: 100%;
        background-color: white;
        z-index: 1000;
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