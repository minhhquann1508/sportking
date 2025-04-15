<style>
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

<div id="loading" style="display: none;"></div>

<script>
    function showLoading() {
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

        const dotInterval = setInterval(() => {
            dot = (dot + 1) % 4;
            loadingText.textContent = 'Loading' + '.'.repeat(dot);
        }, 500);

        const progressInterval = setInterval(() => {
            progress += Math.random() * 10;
            fill.style.width = Math.min(progress, 100) + '%';

            if (progress >= 100) {
                clearInterval(progressInterval);
                clearInterval(dotInterval);
                loading.style.display = 'none';
            }
        }, 300);
    }

    document.addEventListener('DOMContentLoaded', showLoading);
</script>