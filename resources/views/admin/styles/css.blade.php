<style>

    body {
        background: #fff !important;
    }

    main.main-content {
        min-height: 100vh;
    }



    .navbar-brand {
        background: none !important;
    }

    #main-container {
        background-image: linear-gradient(180deg, #ffffff 60px, #d2e4fd 60px, #f4f8ff 85px, #fff 90%) !important;
        background-attachment: fixed;
    }

    @media (min-width: 768px) {
        .main-content .header-navbar, .main-content > .main-navbar {
            box-shadow: none !important;
        }

        .main-sidebar {
            box-shadow: none !important;
            background: none !important;
        }

        .main-sidebar .nav .nav-item, .main-sidebar .nav .nav-link {
            background: none !important;
            border: none !important;
        }

        .main-sidebar .nav {
            margin-top: 0px;

        }

        .main-sidebar .nav li span{
            opacity:0.75;
            transition: all 0.3s;
        }
        .main-sidebar:hover .nav li span {
            opacity:1;
        }

        .main-sidebar .nav .nav-item i {
            margin-right: 20px !important;
            margin-left: 0px;
        }

        .main-sidebar .nav .nav-item.active {
            border-left: 5px #000;
        }
    }


    aside, .main-sidebar {
        z-index: 10 !important;
        transition: all 0s;
    }

    @media (max-width: 768px) {
        .main-sidebar {
            z-index: 10 !important;
            transition: all 0.15s;
        }
    }

</style>

@include('admin.styles.buttons')
@include('admin.styles.badges')
@include('admin.styles.tables')
@include('admin.styles.cards')
@include('admin.styles.forms')
@include('admin.styles.modals')
@include('admin.styles.pagination')
@include('admin.styles.typography')
@include('admin.styles.admin-nav')
@include('admin.styles.code')
@include('admin.styles.utilities')
@include('admin.styles.libraries')