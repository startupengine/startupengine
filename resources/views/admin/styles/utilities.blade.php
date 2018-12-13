<style>
    @media(min-width:768px) {
        .hiddenOnDesktop {
            display:none !important;
        }
    }

    @media(max-width:768px) {
        .hiddenOnMobile {
            display:none !important;
        }
    }

    .raised {
        box-shadow: 0 0.46875rem 2.1875rem rgba(90,97,105,.1), 0 0.9375rem 1.40625rem rgba(90,97,105,.1), 0 0.25rem 0.53125rem rgba(90,97,105,.12), 0 0.125rem 0.1875rem rgba(90,97,105,.1);
    }

    .border-radius-5, .br-5 {
        border-radius:5px !important;
    }

    .border-radius-10, .br-10 {
        border-radius:10px !important;
    }

    .dimmed {
        opacity:0.5;
        transition:all 0.25s;
    }

    .dimmed:hover {
        opacity:1;
    }

    .invisible {
        opacity:0;
        transition: all 0.5s;
    }

    .visible {
        opacity:1 !important;
        display:flex !important;
        transition: all 0.5s;
    }

    .toggleVisibility {
        display:none;
        transition: all 0.5s !important;
    }

    #contentApp > .row .badge-loading {
        margin-top:25px !important;
    }
</style>