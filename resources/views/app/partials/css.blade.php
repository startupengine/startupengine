<!-- Core CSS Files -->
<link href="/css/bootstrap.min.css" rel="stylesheet"/>
<link href="/css/now-ui-kit.css?v=1.1.0" rel="stylesheet"/>

<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>

<!-- jQuery -->
<script src="/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>

<!-- Simple MDE -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

<!-- App-wide custom styles -->
<style>
    .btn-outline {
        border: 1px solid royalblue !important;
        background: #fff !important;
        color: royalblue;
    }

    .btn-outline:hover {
        color: #222;
    }

    .btn-secondary {
        background: royalblue !important;
    }

    .btn-raised {
        box-shadow: 0px 5px 7px rgba(0, 0, 0, 0.15) !important;
    }

    .btn-secondary-outline {
        border: 1px solid royalblue !important;
        color: royalblue !important;
        background: transparent !important;
    }

    .bg-gradient-blue {
        background: royalblue;
        background: -webkit-linear-gradient(to right, royalblue, #00adff) !important;
        background: linear-gradient(to right, royalblue, #00adff) !important;
        color: #fff !important;
    }

    .bg-gradient-orange {
        background: #ff9966;
        background: -webkit-linear-gradient(to top right, #ff5e62, #ff9966);
        background: linear-gradient(to top right, #ff5e62, #ff9966);
    }

    .bg-gradient-multi {
        background: #ff9966;
        background: -webkit-linear-gradient(to top right, #ff5e62, #2dbeff);
        background: linear-gradient(to top right, #ff5e62, #2dbeff);
    }

    .bg-gradient-purple {
        background: #8b69ff;
        background: -webkit-linear-gradient(to top right, #ff35a4, #350090);
        background: linear-gradient(to top right, #ff35a4, #350090);
    }

    .bg-gradient-blue .btn, .bg-gradient-blue .btn {
        color: #fff !important;
        border-color: #fff !important;
    }

    .navbar-transparent #nav-cta {
        background: #fff;
        color: royalblue !important;
    }

    .h1-seo {
        font-weight: 400 !important;
    }

    .card {
        border-radius: 5px !important;
    }

    .card h4 {
        margin-top: 10px !important;
        text-align: center;
    }

    @media screen and (max-width: 991px) {
        .sidebar-collapse .navbar-collapse .navbar-nav:not(.navbar-logo) .nav-link:not(.btn) {
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-collapse .navbar .navbar-nav {
            margin-top: 15px !important;
        }
    }

    h1.title {
        font-weight: 400 !important;
    }

    h2.title, h3, h4 {
        font-weight: 300 !important;
    }

    h1, h2, h3, h4 {
        text-shadow: 0px 2px 13px rgba(0, 0, 0, 0.17) !important;
    }

    .sidebar-collapse .navbar-collapse:before {
        background: none; /* fallback for old browsers */
    }

    .page-header[filter-color="orange"] {
        background: rgba(44, 44, 44, 0.0);
        background: -webkit-linear-gradient(90deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));
        background: -o-linear-gradient(90deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));
        background: -moz-linear-gradient(90deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));
        background: linear-gradient(0deg, rgba(44, 44, 44, 0), rgba(224, 23, 3, 0.6));
    }

    #disqus_thread {
        padding: 15px;
    }

    footer {
        position: absolute;
        bottom: 0px;
        width: 100%;
        left: 0px;
        color: #222;
        background: #fff !important;
    }

    footer a {
        color: #333;
    }

    footer a:hover {
        color: #111;
    }

    #mobile-nav-brand {
        display: none;
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

        #nav-cta {
            color: #fff !important;
        }
    }

    @media screen and (min-width: 991px) {
        .hiddenOnMobile {
            display: auto !important;
        }

        .hiddenOnDesktop {
            display: none !important;
        }
    }

    @media screen and (max-width: 991px) {
        .hiddenOnMobile {
            display: none !important;
        }

        .hiddenOnDesktop {
            display: auto !important;
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
    }

    #nav-cta {
        background: royalblue !important;
        color: #fff !important;
    }

    #articles-index .page-header:before {
        background: none !important;
    }

    .page-header h1, .main h1 {
        font-weight: 600 !important;
    }

    .page-header h2, .main h2, .page-header h3, .main h3, .page-header h4, .main h4, .page-header h5, .main h5 {
        font-weight: 400 !important;
    }

    .bg-gradient {
        background-image: linear-gradient(-45deg, #499ee6 0%, #9064d6 100%);
    }

    body {
        min-height: 100vh;
        background:#fff !important;
    }

    body > .container-fluid > .card {
        max-height: 90vh;
        overflow-y: scroll !important;
        scroll-behavior: smooth !important;
    }

    td .btn-group {
        opacity: 0;
        transition: opacity 0.2s;
    }

    tr:hover td .btn-group {
        opacity: 1;
    }

    .card:first-of-type {
        background: none;
        margin-top: 0px !important;
    }

    .card:first-of-type .row {
        background: #fff;
        min-height: 100%;
    }

    input.form-control {
        z-index:0 !important;
    }

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

    @media screen and (max-width: 991px) {
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
    }

    #adminNav a, #adminNav i, #adminNav button {
        color: #fff;
    }

    #adminNav .dropdown-menu button, #adminNav .dropdown-menu button i {
        color: #000;
    }

    #adminNav .navbar-toggler-bar {
        background: #fff !important;
    }

    #app .card-header:first-of-type {
        background: #fff !important;
        position: relative !important;
        box-shadow: none;
        border-bottom: 1px solid #ddd;
        border-bottom: 2px solid rgb(255, 209, 133) !important;
        width: 100% !important;
        color: #333 !important;
        top: 0px !important;
        text-align: center;
        left: 0px !important;
        z-index: auto !important;
        box-shadow: none !important;
        font-weight: 600;
    }

    .btn.dropdown-toggle:first-of-type {
        background: #fff !important;
        color: #222 !important;
        border: none !important;
    }

    .dropdown-menu-right {
        opacity: 0;
    }

    .card-body .row {
        height: auto;
        min-height: inherit !important;
    }

    main {
        min-height: 100vh !important;
        background: #fff;
    }



    .dropdown-menu {
        z-index: 999999 !important;
        width: auto !important;
        right: 10px !important;
        border-radius:3px !important;
        top: 0px !important;
        position: absolute !important;
        transition: left 0s, top 0s;
    }

    .navbar .dropdown-menu.show {
        top:45px !important;
    }

    .dropdown-menu-right {
        max-width: 175px;
    }

    .dropdown-menu.show {
        opacity: 1;
        top:10px !important;
        margin-top:0px !important;
        z-index:999999 !important;
        display:inline-table !important;
    }

    nav .btn-secondary-outline {
        color: #111 !important;
    }

    tr {
        -webkit-transition: background 0.5s;
        transition: background 0.5s;
    }

    .card tr:hover {
        color: #111 !important;
        background: #f7f9fd !important;
    }

    table th {
        border-top: none !important;
    }

    thead tr:hover {
        box-shadow: none !important;
    }

    .main th:first-of-type, .main td:first-of-type {
        width: 150px !important;
    }

    .main .card {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
    }

    .main .card > .card-header {
        border-radius: 5px 5px 0px 0px !important;
    }

    .dropdown-item:hover {
        background: none !important;
        color: royalblue;
        cursor: pointer;
    }

    @media (max-width: 991px) {
        .hiddenOnMobile {
            display: none !important;
        }
    }

    @media (min-width: 991px) {
        .hiddenOnDesktop {
            display: none !important;
        }
    }

    .dropdown-menu {
        z-index: 999999999999999999999999999999 !important;
        background:#fff !important;
        transition: transform 0s !important;
    }

    .badge-status {
        background: #555 !important;
        border: 1px solid #555;
        color: #fff;
        min-width: 100px;
        padding: 3px 8px;
        font-weight: 400;
        border-radius: 4px;
    }

    .badge-status-disabled {
        background: #999 !important;
        border: 1px solid #999;
        color: #fff;
        min-width: 100px;
        padding: 3px 8px;
        font-weight: 400;
        border-radius: 4px;
    }

    .badge-date, .badge-category {
        background: #fff !important;
        border: 1px solid #999 !important;
        color: #999 !important;
        min-width: 100px;
        padding: 3px 8px;
        font-weight: 400;
        border-radius: 4px;
    }

    .updated_at_column, .status_column {
        width: 150px !important;
        border-right: 1px solid #eee;
        text-align: center;
    }

    .badge-date, .badge-status, .badge-status-disabled, .badge-category {
        margin-top: 10px !important;
        margin-bottom: 10px !important;
    }

    tr:first-of-type td {
        border-top: none !important;
    }

    th {
        background: #fff !important;
    }

    .CodeMirror, .CodeMirror-scroll {
        min-height: 25px !important;
        height: auto !important;
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

    .btn-group .btn-round {
        border-radius: 0px !important;
        border-left-width: 0px !important;
    }

    .btn-group .btn-round:first-of-type {
        border-radius: 25px 0px 0px 25px !important;
        border-left-width: 1px !important;
    }

    .btn-group .btn-round:last-of-type {
        border-radius: 0px 25px 25px 0px !important;
    }

    .text400 {
        font-weight: 400 !important;
    }

    main .main {
        border-left:1px solid #007eff20;
        margin-top:-15px !important;
        padding-top:20px;
        margin-bottom:75px;
        min-height:100vh;
    }

</style>

<style>
    @media (max-width: 991px) {
        .sidebar {
            display: none;
        }
    }

    @media (min-width: 991px) {
        .mobile-nav {
            display: none;
        }
    }

    #admin-sidebar {
        /*display:none;*/
    }

    .btn-label {
        min-width:60px;
        display:inline-block;
        text-align: center;
    }

    .btn-group .btn-secondary-outline:hover {
        background:#f7f9fd !important;
        color:#2023c5 !important;
    }


    .modal.show {
        display:block !important;
    }
    .navbar a.nav-link {
        border-radius: 25px !important;
        padding: 5px 15px !important;
        margin:7px 20px !important;
    }
    .CodeMirror-line {
        font-size:13px !important;
    }
    .CodeMirror {
        border-radius:5px 5px;
        font-size:13px !important;
        min-height:40px !important;
        padding:10px !important;
        z-index:0 !important;
    }
    textarea {
        border: 1px solid #eee !important;
        border-radius: 5px !important;
        min-height:30px;
        font-size:13px !important;
        resize: vertical !important;
        padding:10px !important;

    }

    select, input, textarea, .ace_editor, .CodeMirror, .checkbox label::before, .checkbox label::after {
        transition:border 0.25s;
    }

    .checkbox label::before, .checkbox label::after  {
        border:1px solid #eee !important;
    }

    select:hover, select:focus, textarea:focus, input:focus, textarea:hover, input:hover, .ace_editor:hover, .checkbox:hover label::before, .checkbox:hover label::after, .nav-tabs>.nav-item>.nav-link:hover{
        border:1px solid rgba(0, 0, 0, 0.3) !important;
        transition:border 0.25s;
    }

    .editor-toolbar {
        border-radius:5px 5px 0px 0px !important;
        border:1px solid #ddd;
        margin-bottom:-3px !important;
        z-index:1 !important;
        opacity:1 !important;
        background: #f4f8fd !important;
        box-shadow:none !important;
    }

    .ace_editor {
        border-radius:5px !important;
        z-index:0;
        border:1px solid #eee;
        width:100%;
    }

    #navigation {
        z-index:9999 !important;
    }

    input {
        border-radius:5px !important;
        font-size:13px !important;
        padding:10px !important;
    }

    .nav-tabs .nav-item {
        display: inline-block;
    }
    .nav-tabs>.nav-item>.nav-link {
        padding:5px 10px;
    }


    .btn-success i {
        color:#33d695;
    }
    .btn-success {
        background: #fff;
        color: #48a89a;
        border: #33d695 solid 1px;
    }
    .btn-success:hover {
        background: #33d695;
        color:#fff !important;
        border: #33d695 solid 1px;
    }
    .btn-success:hover i {
        color:#fff;
    }


</style>