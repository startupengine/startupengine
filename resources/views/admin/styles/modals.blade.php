<style>
    .modal .control-label {
        color:#888;
        font-weight:bold;
    }

    .modal .help-block {
        padding-top:10px !important;
        display:inline-block;
        opacity:0.5;
    }

    .modal-header {
        padding: .9375rem 2rem .9375rem 1.25rem !important;
    }

    .modal-fluid {
        min-width: 100% !important;
        margin: 0px !important;
        width:100% !important;
        padding:10px !important;
        transition: all 0.3s !important;
        transition-timing-function: ease-in !important;
    }

    .modal-content {
        transition: all 0.3s !important;
        transition-timing-function: ease-in !important;
    }

    .modal-fluid .modal-content {
        height: calc(100vh - 20px) !important;
        min-height: 100% !important;
    }

    .modal-dialog {
        transition: all 0.3s !important;
        transition-timing-function: ease-in !important;
    }

    .modal-header .expand {
        top: 16px;
        right: 70px;
        position: absolute;
        opacity: 0.5;
        padding:10px;
        cursor:pointer;
        -webkit-text-stroke: 1px #888;
    }

    .modal-fluid a.expand {
        opacity:1 !important;
    }

    .modal-fluid a.expand i {
        color:#007bff !important;
        -webkit-text-stroke: 1px #007bff !important;
    }

    .modal {
        z-index:9999 !important;
    }

    .modal-header .close {
        margin-top:-0.6rem !important;
    }

    .modal .input-group-text {
        color: #5e7e98;
        background-color: #e1e5eb;
    }

    .modal-backdrop {
        opacity:0.4 !important;
    }

    .modal-open {
        transition:all 0s;
    }

    .modal-open .main-sidebar {
        opacity:0.4;
    }

    .modal-open .main-sidebar i {
        color:#999 !important;
    }

    .modal-open .navbar-brand {
        background-color:#c9c9c9 !important;
        border-bottom:1px solid #999 !important;
        z-index:0 !important;
    }
</style>