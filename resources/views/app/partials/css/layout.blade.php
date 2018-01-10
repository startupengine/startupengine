<style>
    body {
        min-height: 100vh;
        background:#fff !important;
    }

    body > .container-fluid > .card {
        max-height: 100vh;
        overflow-y: scroll !important;
        scroll-behavior: smooth !important;
    }

    .card-body .row {
        height: auto;
        min-height: inherit !important;
    }

    main {
        min-height: 100vh !important;
        background: #fff;
    }

    #app > .container-fluid:first-of-type {
        margin: 0px !important;
        padding: 0px !important;
    }

    #app > .container-fluid:first-of-type > .card > .card-header {
        z-index: 99 !important;
    }

    #app .container-fluid > .card {
        border-radius: 0px !important;
        margin-bottom: 0px !important;
        height: 100vh !important;
        padding: 0px !important;
        float: left;
    }

    #app .container-fluid > .card > .row {
        overflow: scroll !important;
        height: 100vh !important;
    }

    main .main {
        border-left:1px solid #007eff20;
        margin-top:-15px !important;
        padding-top:20px;
        margin-bottom:75px;
        min-height:100vh;
    }

    @media (max-width: 991px) {
        .sidebar {
            display: none;
        }
    }
</style>