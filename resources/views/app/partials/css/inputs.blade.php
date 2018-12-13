<style>
    input.form-control {
        z-index:0 !important;
    }

    textarea {
        border: 1px solid #eee !important;
        border-radius: 5px !important;
        min-height:30px;
        font-size:13px !important;
        resize: vertical !important;
        padding:10px !important;
        background: #f9f9f9 !important;
    }

    textarea::placeholder, input::placeholder  {
        color:rgba(0,0,0,0.4) !important;
        transition:color 0.3s
    }
    textarea:focus::placeholder, input:focus::placeholder  {
        color:rgba(0,0,0,0) !important;
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

    input {
        border-radius:5px !important;
        font-size:13px !important;
        padding:10px !important;
    }
</style>