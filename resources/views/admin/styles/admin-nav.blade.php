<style>
    #menuAvatar {
        height:30px;
        width:30px;
        border-radius:15px;
        @if(\Auth::user()->avatar != null)
        background:url('{{ \Auth::user()->avatar() }}');
        @else
        background:#ddd;
        @endif
        display:inline-block;
        margin:5px 5px 5px 5px;
        background-size:cover;
        background-position:center;
        pointer-events:none !important;
    }

    #menuUserName {
        display:inline-block;
        margin-top:10px;
        margin-right:15px;
        vertical-align:top;
    }

    #accountMenu .dropdown-toggle::after {
        top: 27px !important;
        right: 12px !important;
        position: absolute !important;
        pointer-events:none;
    }

    @media (min-width: 768px) {
        .navbar-brand .d-table {
            margin: auto 30px !important;
        }

        .navbar-brand span {
            display: none !important;
        }

        #sidebar li span {
            display: none;
        }

        #top-nav {
            padding-left: 15px;
        }

        .offset-lg-2 {
            margin-left: 50px;
        }

        .col-lg-10 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 calc(100% - 50px);
            flex: 0 0 calc(100% - 50px);
            max-width: calc(100% - 50px);
        }

    }

    @media (min-width: 991px) {

        .navbar-brand span {
            display: inline-block !important;
        }

        #sidebar li span {
            display: inline-block;
        }

        .offset-lg-2 {
            margin-left: 190px;
        }

        .col-lg-10 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0  calc(100% - 190px);
            flex: 0 0  calc(100% - 190px);
            max-width: calc(100% - 190px);
        }
    }

    .navbar-brand span {
        transition: all 0.3s;
    }



    @media (max-width: 768px) {
        .pageNav {
            text-align:center !important;
        }
    }

    @media (min-width: 768px) {
        .pageNav {
            text-align:right !important;
        }
    }

</style>