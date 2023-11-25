<script type="text/javascript">
    jQuery(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '#showCountry', function (e) {
            e.preventDefault();
            let country_id = $(this).data('id');
            if (country_id) {
                $.ajax({
                    url: "{{ url('countries') }}/" + country_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#showCountryCreate').modal('show');
                        $('.modal-title1').html('Details of '+data.name);
                        $('#country-created-at').html(data.created_at);
                        $('#country-name').html(data.name);
                    }
                });
            }
        });

        $(document).on('click', '#editCountry', function (e) {
            e.preventDefault();
            let country_id = $(this).data('id');
            if (country_id) {
                $.ajax({
                    url: "{{ url('countries') }}/" + country_id +"/edit",
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#countryCreate').modal('show');
                        $('#name').val(data.name);
                        $('#country_id').val(data.id);
                        $('#code').val(data.code);
                    }
                });
            }
        });

        $(document).on('click', '.fw-medium', function () {
            $('#name').val('');
            $('#code').val('');
        });

        jQuery(document).on('click', '.saveCountry', function (e) {
            e.preventDefault();
            let country_id = jQuery('#country_id').val();
            let name = jQuery('#name').val();
            let code = jQuery('#code').val();

            if (name === '' || code === '') {
                alert('Country Name or Country Code Should not be Empty');
                return false;
            } else {
                if(country_id===''){
                    //create country ajax
                }else{
                    //update country ajax
                    $.ajax({
                        url: "{{ url('countries') }}/" + country_id,
                        type: "PUT",
                        data: {
                            country_id: country_id,
                            name: name,
                            code: code
                        },
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                        },
                        success: function (data) {
                            if (data.success) {
                                // setTimeout(function() {
                                //     $('#countryCreate').modal('hide');
                                // }, 100);
                                $('#countryCreate').modal('hide');
                                $('#countryCreate').trigger('click');
                                $('#name').val('');
                                $('#code').val('');
                                $('#country_id').val('');
                                alert(data.success);
                            }
                        }
                    });
                }
            }
        });

    });
</script>
