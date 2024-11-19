<x-admin.layouts.master>
    <div class="dashboard__body">
        <div class="dashboard__inner">
            <div class="row g-4">
                <div class="col-xxl-12 col-lg-12">
                    <div class="dashboard__card bg__white padding-20 radius-10">
                        <div class="dashboard__card__header">
                            <h4 class="dashboard__card__header__title">Edit State</h4>
                        </div>
                        <div class="dashboard__card__inner mt-4">
                            <div class="form__input">
                                <form id="stateForm">
                                    <div class="form__input__flex">

                                        <div class="form__input__single">
                                            <label for="name" class="form__input__single__label">State Name</label>
                                            <input type="text" id="name" name="name"
                                                class="form__control radius-5"
                                                placeholder="State Name..."
                                                value="{{ $state->name }}">
                                            <span id="name_error" class="text-danger"></span>
                                        </div>

                                        <div class="form__input__single">
                                            <label class="form__input__single__label" for="country_id">Country</label>
                                            <select class="form-select form__control" id="country_id" name="country_id">
                                                <option value="" disabled>Select Country</option>
                                                @foreach($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ $state->country_id == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <span id="country_id_error" class="text-danger"></span>
                                        </div>

                                        <div class="form__input__single">
                                            <label class="form__input__single__label" for="status">Status</label>
                                            <select class="form-select form__control" id="status" name="status">
                                                <option value="active" {{ $state->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $state->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            <span id="status_error" class="text-danger"></span>
                                        </div>

                                    </div>
                                    <button type="button" id="updateStateBtn" class="btn btn-success">Update</button>
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
        $(document).ready(function() {
            $('#updateStateBtn').click(function(e) {
                e.preventDefault();

                // Clear previous error messages
                $('#name_error').text('');
                $('#country_id_error').text('');
                $('#status_error').text('');

                // Collect form data
                let formData = {
                    name: $('#name').val(),
                    country_id: $('#country_id').val(),
                    status: $('#status').val(),
                    _token: '{{ csrf_token() }}' // Include CSRF token for security
                };
                console.log(formData);

                // Make AJAX request
                $.ajax({
                    url: "{{ route('states.update', $state->id) }}", // Route to update the state
                    method: "PUT", // PUT method for updates
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
                                // Redirect or reload the page after successful update
                                window.location.href = "{{ route('states.index') }}";
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