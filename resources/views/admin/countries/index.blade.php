<x-admin.layouts.master>
    <div class="dashboard__body">
        <div class="dashboard__inner">
            <div class="dashboard__inner__item dashboard__card bg__white padding-20 radius-10">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="dashboard__inner__item__header__title">Countries</h4>
                    <a href="{{ route('countries.create') }}" class="btn btn-sm btn-success">Create</a>
                </div>


                <!-- Table Design One -->
                <div class="tableStyle_one mt-4">
                    <div class="table_wrapper">
                        <!-- Table -->
                        <table>
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($countries as $index => $country)
                                <tr id="countryRow_{{ $country->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $country->name }}</td>
                                    <td class="{{ $country->status == 'active' ? 'text-success' : 'text-danger' }}">
                                        {{ ucfirst($country->status) }}
                                    </td>
                                    <td>
                                        <!-- DropDown -->
                                        <div class="d-flex">
                                            <a class="btn btn-sm btn-primary" href="{{ route('countries.edit', $country->id) }}">Edit</a>
                                            <form id="deleteCountryForm_{{ $country->id }}" class="d-inline ms-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger deleteCountryBtn" data-country-id="{{ $country->id }}">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No countries available.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- End-of Table one -->
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('.deleteCountryBtn').click(function(e) {
                e.preventDefault();

                var countryId = $(this).data('country-id');

                // Confirm before sending the request
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send the AJAX request to delete the country
                        $.ajax({
                            url: "{{ url('countries') }}/" + countryId,
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Show success message
                                    Swal.fire(
                                        'Deleted!',
                                        response.message,
                                        'success'
                                    ).then(() => {
                                        // remove the deleted row from the table
                                        $('#countryRow_' + countryId).remove();
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue deleting the country.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
    @endpush

</x-admin.layouts.master>