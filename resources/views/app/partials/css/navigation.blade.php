<style>
    #adminNav {
        background: linear-gradient(45deg, #5719dc, #4286ff) !important;
        font-weight: 600 !important;
        border-bottom: 0px solid #eaeaea;
        color: #fff;
        position: fixed;
        top: 0px;
        left: 0px;
        border-radius: 0px;
        width: 100% !important;
        z-index: 3 !important;
        box-shadow: 0px 5px 5px rgba(0,0,0,0.15);
    }

    .navbar a {
        color: #fff !important;
    }

    #adminNav a, #adminNav i, #adminNav button {
        color: #fff;
    }

    #adminNav .dropdown-menu button, #adminNav .dropdown-menu button i {
        color: #000;
    }

    .navbar-toggler-bar {
        background:#fff !important;
    }

    .sidebar-collapse .navbar-collapse:before {
        background: none; /* fallback for old browsers */
    }

    #mobile-nav-brand {
        display: none;
    }

    .nav-tabs .nav-item {
        display: inline-block;
    }
    .nav-tabs>.nav-item>.nav-link {
        padding:5px 10px;
    }

    .nav-tabs>.nav-item>.nav-link{
        border: 1px solid transparent !important;
        box-shadow:none !important;
        background: #fff;
        border-radius: 30px !important;
    }

    .nav-tabs>.nav-item>.nav-link.active {
        border: 1px solid #bbb !important;
        box-shadow:none !important;
        background: #fff;
        border-radius: 30px;
    }

    @media screen and (max-width: 991px) {
        #navigation {
            overflow-y:scroll !important;
            scroll-behavior: smooth !important;
        }
        #navigation .nav-link:not(.btn) {
            color: royalblue;
            background: #fff;
            margin-bottom: 5px;
            border: none;
            border-radius: 3px !important;
            box-shadow: 0px 7px 18px rgba(0, 0, 0, 0.1);
            text-align: center !important;
        }

        #mobile-nav-brand {
            display: block;
        }

        #navigation .nav-link:not(.btn):hover {
            background: #fff !important;
            color: #222 !important;
        }

        .navbar-transparent #nav-cta {
            color: #fff !important;
        }

        #navigation {
            background: #0e142b !important;
            box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 120px !important;
        }

        .sidebar-collapse .navbar-collapse:before {
            background: linear-gradient(0deg, rgba(0,0,0,0.9) 50%, #444) !important;
        }
        .sidebar-collapse .navbar-collapse .btn, #navigation .nav-link:not(.btn) {
            border-radius:25px !important;
            margin-bottom:10px;
            color:#222 !important;
        }
        .sidebar-collapse .navbar-collapse .nav-link i {
            color:#222 !important;
        }
        .sidebar-collapse .navbar-collapse .btn:hover, #navigation .nav-link:not(.btn):hover {
            color:#fff !important;
            background-color:royalblue !important;
        }
        .sidebar-collapse .navbar-collapse .btn:hover i, #navigation .nav-link:not(.btn):hover i {
            color:#fff !important;
        }

        .sidebar-collapse .navbar-collapse .navbar-nav:not(.navbar-logo) .nav-link:not(.btn) {
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-collapse .navbar .navbar-nav {
            margin-top: 15px !important;
        }
    }

    nav .btn-secondary-outline {
        color: #111 !important;
    }

    .navbar a.nav-link {
        border-radius: 25px !important;
        padding: 5px 15px !important;
        margin:7px 20px !important;
    }

    #navigation {
        z-index:9999 !important;
    }

    @media (min-width: 991px) {
        .mobile-nav {
            display: none;
        }
    }

</style>