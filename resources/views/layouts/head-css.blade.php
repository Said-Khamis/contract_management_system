@yield('css')
<!-- select2 CDN -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{--<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />--}}
<!-- Layout config Js -->
<link rel="stylesheet" href="{{ URL::asset("vendor/select2/select2.css") }}" type="text/css"/>

<script src="{{ URL::asset('build/js/layout.js') }}"></script>
<!-- Bootstrap Css -->
<link href="{{ URL::asset('build/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('build/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<!-- Custom Generated Css-->
<link href="{{ URL::asset('build/css/custom.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<!-- Custom Styles-->
<link href="{{ URL::asset('build/css/custom-styles.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<!-- DataTables -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css" rel="stylesheet" />

<style type="text/css">
    table.dataTable td.dataTables_empty{
        padding: 2px;
        margin: 0;
    }
    .error{
        color: red;
    }

    .form-select {
        display: block;
        width: 100%;
        padding: 0.4375rem 1.875rem 0.4375rem 0.875rem;
        -moz-padding-start: calc(0.875rem - 3px);
        font-size: 0.9375rem;
        font-weight: 400;
        line-height: 1.53;
        color: #697a8d;
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%2867, 89, 113, 0.6%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.875rem center;
        background-size: 17px 12px;
        border: 1px solid #d9dee3;
        border-radius: 0.375rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }
    @media (prefers-reduced-motion: reduce) {
        .form-select {
            transition: none;
        }
    }
    .form-select:focus {
        border-color: rgba(249, 249, 255, 0.54);
        outline: 0;
        box-shadow: 0 0 0.25rem 0.05rem rgba(105, 108, 255, 0.1);
    }
    .form-select[multiple], .form-select[size]:not([size="1"]) {
        padding-right: 0.875rem;
        background-image: none;
    }
    .form-select:disabled {
        color: #697a8d;
        background-color: #eceef1;
    }
    .form-select:-moz-focusring {
        color: transparent;
        text-shadow: 0 0 0 #697a8d;
    }

    .form-select-sm {
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
        padding-left: 0.625rem;
        font-size: 0.75rem;
        border-radius: 0.25rem;
    }

    .form-select-lg {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 1.25rem;
        font-size: 1rem;
        border-radius: 0.5rem;
    }

    tb { border: 1px solid #ccc; border-collapse: collapse; }
    .tb th{ border: 1px solid #ccc; padding: 8px; }
    .tb td{ border: 1px solid #ccc; padding: 5px; font-size: 20px; }

    .tb{ border-collapse: collapse;border-spacing: 0; }
    .tb img{ height: 16px; }
    .tb tr:nth-child(even){background: #f7f7f7;}
    .tb tr:nth-child(odd){background: #ffffff;}
    .tb tr:hover{ background: #28282822; color: #000; cursor: pointer; font-weight: normal;}
    .tb th{ background: #f7f7f7; text-align: left; font-size: 14px; height: 1.5rem;  white-space: nowrap; overflow: hidden;top: 0; text-overflow: ellipsis; padding: 4px 16px;position: sticky;box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);}
    .tb td{ word-wrap: break-word; font-size: 14px; height: 1.5rem; text-overflow: ellipsis; padding: 8px; }


</style>
