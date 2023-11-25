
<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ URL::asset('build/js/plugins.js') }}"></script>
{{--<script src="{{ URL::asset('build/js/highcharts.js') }}"></script>--}}
<script src="{{ URL::asset('build/js/modules/exporting.js') }}"></script>
<script src="{{ URL::asset('build/js/modules/export-data.js') }}"></script>
<script src="{{ URL::asset('build/js/modules/accessibility.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!--select2 cdn-->
{{--<script href="{{ URL::asset("vendor/select2/select2.js") }}"></script>--}}

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>--}}
{{--<script src="{{URL::asset('build/js/pages/select2.init.js')}}"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js" type="text/javascript"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script type="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script type="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script type="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
<script type="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>

{{--<script src="https://code.highcharts.com/highcharts.js"></script>--}}
{{--<script src="https://code.highcharts.com/modules/exporting.js"></script>--}}
{{--<script src="https://code.highcharts.com/modules/export-data.js"></script>--}}
{{--<script src="https://code.highcharts.com/modules/accessibility.js"></script>--}}

@yield('script')
@yield('script-bottom')
@stack('custom-scripts')

<script>
    $(document).on('click', '.data-modal', function() {
        $('#varyingContentModal').modal('show');
        let url = $(this).attr('data-url');
        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                console.log(response);
                $('.modal-contents').html(response);
            },
            error: function(response) {
                alert('Error: ' + response.responseText);
            }
        });
    });
    (function () {

        counter();

        $('.js-example-basic-single').select2({
            // theme: 'bootstrap-5'
        });



        $(".institution-select2").select2({
            placeholder: "Search Institution...",
            //dropdownParent: $('#varyingContentModal'),
            allowClear: true
        });


        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                container: 'body',
            })
        })

        $(document).on('click', '.group-header', function () {
            const parent = $(this);
            const checkboxGroupPermissions = "input[type='checkbox']."+parent.attr('data-permission-group');
            if(parent.prop('checked')) {
                $(checkboxGroupPermissions).each(function() {
                    this.checked = true;
                })
            } else {
                $(checkboxGroupPermissions).each(function() {
                    this.checked = false;
                })
            }
        });

        $(document).on('click', '.checkbox-group', function () {
            const groupHeader = "#"+$(this).attr('data-group-header');
            const checkboxGroup = "input[type='checkbox']."+$(this).attr('data-group-permission');
            if($(checkboxGroup+':checked').length === $(checkboxGroup).length) {
                $(groupHeader).prop('checked', true);
            } else {
                $(groupHeader).prop('checked', false);
            }
        })

        const toggler = document.getElementsByClassName("caret");
        let i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
                this.parentElement.querySelector(".nested").classList.toggle("nested-active");
                this.classList.toggle("caret-down");
            });
        }

        // Sidebar Menu variable
        const sidebarMenu = localStorage.getItem("data-sidebar-size");

        // Initial Sidebar Check menu for mobile screen
        const sidebarMenuCheck = () => {
            if (window.innerWidth < 768) {
                document.body.classList.add('twocolumn-panel');
                document.body.setAttribute("data-sidebar-size", "lg");
                document.getElementById("scrollbar").classList.add("scrollbar-move-up");
                document.querySelector('.app-logo-container').classList.add("app-logo-container-collapsed");
            } else {
                if (sidebarMenu === "sm") {
                    document.body.setAttribute("data-sidebar-size", "sm");
                    document.getElementById("scrollbar").classList.add("scrollbar-move-up");
                    document.querySelector('.app-logo-container').classList.add("app-logo-container-collapsed");
                    return;
                }

                document.body.setAttribute("data-sidebar-size", "lg");
                document.getElementById("scrollbar").classList.remove("scrollbar-move-up");
                document.querySelector('.app-logo-container').classList.remove("app-logo-container-collapsed");
            }
        }

        $(document).on('click', '#topnav-hamburger-icon', function() {
            if (window.innerWidth < 768) {
                document.body.classList.add('vertical-sidebar-enable');
            } else {
                if (document.body.getAttribute("data-sidebar-size") === "sm") {
                    document.body.setAttribute("data-sidebar-size", "lg");
                    document.getElementById("scrollbar").classList.remove("scrollbar-move-up");
                    document.querySelector('.app-logo-container').classList.remove("app-logo-container-collapsed");
                    localStorage.setItem("data-sidebar-size", "lg");
                    return;
                }

                document.body.setAttribute("data-sidebar-size", "sm");
                document.getElementById("scrollbar").classList.add("scrollbar-move-up");
                document.querySelector('.app-logo-container').classList.add("app-logo-container-collapsed");
                localStorage.setItem("data-sidebar-size", "sm");
            }
        });

        $(document).on('click', '.vertical-overlay', function () {
            document.body.classList.remove('vertical-sidebar-enable');
        });

        // Invoke on document load
        sidebarMenuCheck();

        // Enable Sidebar menu for mobile screen
        window.onresize = () => {
            if (window.innerWidth < 768) {
                document.body.classList.add('twocolumn-panel');
                document.body.setAttribute("data-sidebar-size", "lg");
                document.getElementById("scrollbar").classList.add("scrollbar-move-up");
                document.querySelector('.app-logo-container').classList.add("app-logo-container-collapsed");
            } else {
                if (sidebarMenu === "lg") {
                    document.body.setAttribute("data-sidebar-size", "lg");
                    document.getElementById("scrollbar").classList.remove("scrollbar-move-up");
                    document.querySelector('.app-logo-container').classList.remove("app-logo-container-collapsed");
                    return;
                }

                document.body.setAttribute("data-sidebar-size", "sm");
                document.getElementById("scrollbar").classList.add("scrollbar-move-up");
                document.querySelector('.app-logo-container').classList.add("app-logo-container-collapsed");
            }
        };

        // Counter Number
        function counter() {
            const counter = document.querySelectorAll(".counter-value");
            const speed = 250; // The lower the slower
            counter && Array.from(counter).forEach(function (counter_value) {
                function updateCount() {
                    const target = +counter_value.getAttribute("data-target");
                    const count = +counter_value.innerText;
                    let inc = target / speed;
                    if (inc < 1) {
                        inc = 1;
                    }
                    // Check if target is reached
                    if (count < target) {
                        // Add inc to count and output in counter_value
                        counter_value.innerText = (count + inc).toFixed(0);
                        // Call function every ms
                        setTimeout(updateCount, 1);
                    } else {
                        counter_value.innerText = numberWithCommas(target);
                    }
                    numberWithCommas(counter_value.innerText);
                }
                updateCount();
            });

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        }
    })()
</script>
