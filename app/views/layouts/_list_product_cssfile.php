<style>
    a:hover {
        color: #b57a43;
        cursor: pointer;
    }

    .product-list {
        display: grid;
        gap: 30px;
        grid-template-columns: repeat(4, 1fr);
    }

    .product-image-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .product-card {
        position: relative;
        overflow: hidden;
        background: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card img {
        width: 100%;
        height: 380px;
        object-fit: cover;
        display: block;
    }

    .product-actions {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 380px;
        opacity: 0;
        display: flex;
        background: rgba(0, 0, 0, 0.3);
        flex-direction: column;
        justify-content: start;
        align-items: flex-end;
        gap: 10px;
        padding: 15px;
        transition: opacity 0.3s ease;
    }

    .product-card:hover .product-actions {
        opacity: 1;
    }

    .product-icons li {
        transform: translateX(30px);
        opacity: 0;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .product-card:hover .product-actions li {
        transform: translateX(0);
        opacity: 1;
        transition-delay: 0.1s;
    }

    .product-card:hover .product-icons li:nth-child(1) {
        transform: translateX(0);
        opacity: 1;
        transition-delay: 0.2s;
    }

    .product-card:hover .product-icons li:nth-child(2) {
        transform: translateX(0);
        opacity: 1;
        transition-delay: 0.3s;
    }

    .product-card:hover .product-icons li:nth-child(3) {
        transform: translateX(0);
        opacity: 1;
        transition-delay: 0.4s;
    }

    .product-icons {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }


    .product-icons li a {
        display: block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        background-color: #fff;
        text-align: center;
        transition: all 0.4s ease-in-out;
    }

    .product-icons li:hover a {
        background-color: #b57a43;
        color: white
    }

    .product-icons img:hover {
        background: #b57a43;
    }

    @media (max-width: 1200px) {
        .product-list {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .product-list {
            grid-template-columns: repeat(2, 1fr);
        }

        .product-card img {
            height: 300px;
        }
    }

    @media (max-width: 576px) {
        .product-list {
            grid-template-columns: 1fr;
        }

        .product-card img {
            height: 250px;
        }
    }
</style>