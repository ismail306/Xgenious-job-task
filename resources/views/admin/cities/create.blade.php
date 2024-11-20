<x-admin.layouts.master>
    <div class="dashboard__body">
        <div class="dashboard__inner">
            <div class="row g-4">
                <div class="col-xxl-12 col-lg-12">
                    <div class="dashboard__card bg__white padding-20 radius-10">
                        <div class="dashboard__card__header">
                            <h4 class="dashboard__card__header__title">Create City</h4>
                        </div>
                        <div class="dashboard__card__inner mt-4">
                            <div class="form__input">
                                <form id="cityForm">
                                    <div class="form__input__flex">

                                        <div class="form__input__single">
                                            <label for="name" class="form__input__single__label">City Name</label>
                                            <input type="text" id="name" name="name" class="form__control radius-5" placeholder="City Name...">
                                            <span id="name_error" class="text-danger"></span>
                                        </div>
                                        <div class="form__input__single">
                                            <label class="form__input__single__label" for="country_id">Country</label>
                                            <select class="form-select form__control" id="country_id" name="country_id">
                                                <option value="" disabled selected>Select Country</option>
                                                @foreach($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <span id="country_id_error" class="text-danger"></span>
                                        </div>
                                        <div class="form__input__single">
                                            <label class="form__input__single__label" for="states">State</label>
                                            <select class="form-select form__control" id="states" name="states">
                                                <option value="" disabled selected>Select State</option>

                                            </select>
                                            <span id="states_error" class="text-danger"></span>
                                        </div>

                                        <div class="form__input__single">
                                            <label class="form__input__single__label" for="status">Status</label>
                                            <select class="form-select form__control" id="status" name="status">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                            <span id="status_error" class="text-danger"></span>
                                        </div>

                                    </div>
                                    <button type="button" id="saveCityBtn" class="btn btn-success">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).on('change', '#country_id', function() {
            var countryId = $(this).val();
            // alert("Selected Country ID: " + countryId);
            if (countryId) {
                $.ajax({
                    url: '/get-states-by-country/' + countryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $('#states').empty();

                        if (response.states && response.states.length > 0) {
                            $('#states').append('<option value="" disabled selected>Select State</option>');
                            $.each(response.states, function(key, state) {
                                $('#states').append('<option value="' + state.id + '">' + state.name + '</option>');
                            });
                        } else {
                            $('#states').append('<option value="" disabled>No States Available</option>');
                        }
                    },
                    error: function() {
                        alert('Error fetching states.');
                    }
                });
            }
        });



        $(document).ready(function() {
            $('#saveCityBtn').click(function(e) {
                e.preventDefault();

                // Clear previous error messages
                $('#name_error').text('');
                $('#states_error').text('');
                $('#country_id_error').text('');
                $('#status_error').text('');

                // Collect form data
                let formData = {
                    name: $('#name').val(),
                    state_id: $('#states').val(),
                    country_id: $('#country_id').val(),
                    status: $('#status').val(),
                    _token: '{{ csrf_token() }}' // Include CSRF token for security
                };
                console.log(formData);

                // Make AJAX request
                $.ajax({
                    url: "{{ route('cities.store') }}", // Adjust the route as per your application
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                confirmButtonText: 'OK',
                                timer: 2000 // Optional: Auto-close after 2 seconds
                            }).then(() => {
                                // Optionally reset the form or redirect
                                $('#cityForm')[0].reset();
                            });
                        }
                    },
                    error: function(xhr) {
                        // Handle validation errors
                        console.log(xhr.responseJSON.errors);
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('#name_error').text(errors.name[0]);
                            }
                            if (errors.country_id) {
                                $('#country_id_error').text(errors.country_id[0]);
                            }
                            if (errors.state_id) {
                                $('#states_error').text(errors.state_id[0]);
                            }
                            if (errors.status) {
                                $('#status_error').text(errors.status[0]);
                            }
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
    @endpush

</x-admin.layouts.master>