<div id="loader-wrapper" style="display: none">
    <div class="loader"></div>
</div>

<style>
    #loader-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        /* Semi-transparent overlay */
        z-index: 9999;
        /* Pastikan loader berada di atas */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        pointer-events: all;
        /* Cegah interaksi dengan elemen di bawah */
    }

    .loader {
        width: fit-content;
        font-family: sans-serif;
        color: #A1A9BD;
        font-size: 14px;
        padding: 0 5px 8px 0;
        background: repeating-linear-gradient(90deg, #20C997 0 8%, #0000 0 10%) 200% 100%/200% 3px no-repeat;
        animation: l3 2s steps(6) infinite;
    }

    .loader:before {
        content: "Mengirim Data..."
    }

    @keyframes l3 {
        to {
            background-position: 80% 100%
        }
    }
</style>
