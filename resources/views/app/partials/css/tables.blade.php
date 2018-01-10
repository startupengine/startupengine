<style>
    td .btn-group {
        opacity: 0;
        transition: opacity 0.2s;
    }

    tr:hover td .btn-group {
        opacity: 1;
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

    .updated_at_column, .status_column {
        width: 150px !important;
        border-right: 1px solid #eee;
        text-align: center;
    }

    tr:first-of-type td {
        border-top: none !important;
    }

    th {
        background: #fff !important;
    }
</style>