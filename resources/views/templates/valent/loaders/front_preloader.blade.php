<style>
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
        height: 100vh;
        width: 100vw;
    }

    .content {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #001019;
        font-family: Arial, sans-serif;

        height: 100%;
        width: 100%;
    }

    .loading-container {
        position: relative;
        width: 200px;
        height: 200px;
    }

    .loading-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 18px;
        z-index: 10;
        width: max-content;
        border-right: 2px solid white;
        white-space: nowrap;
        overflow: hidden;
        animation: typing 3s steps(8) infinite,
            cursor .4s step-end infinite alternate;
    }

    .curve {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: none;
        box-sizing: border-box;
    }

    .curve-1 {
        border-top: 4px solid #60A4F6;
        animation: rotate1 1.5s linear infinite;
    }

    .curve-2 {
        border-left: 4px solid #A320D8;
        animation: rotate2 1.5s linear infinite;
    }

    .curve-3 {
        border-right: 4px solid #3F7DF2;
        animation: rotate3 1.5s linear infinite;
    }

    @keyframes rotate1 {
        0% {
            transform: rotateX(35deg) rotateY(-45deg) rotateZ(0deg);
        }

        100% {
            transform: rotateX(35deg) rotateY(-45deg) rotateZ(360deg);
        }
    }

    @keyframes rotate2 {
        0% {
            transform: rotateX(50deg) rotateY(10deg) rotateZ(0deg);
        }

        100% {
            transform: rotateX(50deg) rotateY(10deg) rotateZ(360deg);
        }
    }

    @keyframes rotate3 {
        0% {
            transform: rotateX(-35deg) rotateY(55deg) rotateZ(0deg);
        }

        100% {
            transform: rotateX(-35deg) rotateY(55deg) rotateZ(360deg);
        }
    }

    @keyframes typing {
        0% {
            width: 0
        }

        50% {
            width: 4.5em
        }

        100% {
            width: 0
        }
    }

    @keyframes cursor {
        50% {
            border-color: transparent
        }
    }
</style>


<div id="preloader">
    <div class="content">
        <div class="loading-container">
            <div class="loading-text">Loading...</div>
            <div class="curve curve-1"></div>
            <div class="curve curve-2"></div>
            <div class="curve curve-3"></div>
        </div>
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
