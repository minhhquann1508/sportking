<style>
    .home_btn {
        position: relative;
        overflow: hidden;
        background: black;
        color: rgb(226, 226, 226);
        border: 2px solid black;
        transition: color 0.4s ease-in-out;
        z-index: 1;
    }

    .home_btn::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background-color: #b57a43;
        transition: left 0.4s ease-in-out;
        z-index: -1;
    }

    .home_btn:hover::before {
        left: 0;
    }

    .home_btn:hover {
        color: white;
    }
</style>