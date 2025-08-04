<style>
    #preloader {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #0f172a;
        z-index: 9999;
    }

    .crypto-loader {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .dot {
        width: 12px;
        height: 12px;
        background: linear-gradient(45deg, #3F7DF2, #A320D8);
        border-radius: 50%;
        animation: pulse 1.5s infinite ease-in-out;
    }

    .dot:nth-child(2) {
        animation-delay: 0.2s;
    }

    .dot:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 0.6;
        }

        50% {
            transform: scale(1.5);
            opacity: 1;
        }
    }
</style>

<div id="preloader" class="top-0 bottom-0 fixed left-0 w-full h-screen z-50 p-10">

    <div class="crypto-loader">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>

</div>


<script>
    window.addEventListener('load', function() {
        setTimeout(function() {
            const preloader = document.getElementById('preloader');
            preloader.style.opacity = '0';
            setTimeout(() => preloader.style.display = 'none', 500);
        }, 3000);
    });
</script>

</div>
