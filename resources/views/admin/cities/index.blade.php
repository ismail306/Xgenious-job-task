<x-admin.layouts.master>
    <div class="dashboard__body">
        <div class="dashboard__inner">
            <div class="dashboard__inner__item dashboard__card bg__white padding-20 radius-10">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="dashboard__inner__item__header__title">Cities</h4>
                    <a href="{{ route('cities.create') }}" class="btn btn-sm btn-success">Create</a>
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
                                    <th>State</th> <!-- Added State Column -->
                                    <th>Country</th> <!-- Added Country Column -->
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cities as $index => $city)
                                <tr id="cityRow_{{ $city->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->state->name }}</td> 
                                    <td>{{ $city->state->country->name }}</td>
                                    <td class="{{ $city->status == 'active' ? 'text-success' : 'text-danger' }}">
                                        {{ ucfirst($city->status) }}
                                    </td>
                                    <td>
                                        <!-- DropDown -->
                                        <div class="d-flex">
                                            <a class="btn btn-sm btn-primary" href="{{ route('cities.edit', $city->id) }}">Edit</a>
                                            <form id="deleteCityForm_{{ $city->id }}" class="d-inline ms-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger deleteCityBtn" data-city-id="{{ $city->id }}">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No cities available.</td> 
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
            $('.deleteCityBtn').click(function(e) {
                e.preventDefault();

                var cityId = $(this).data('city-id');

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
                        // Send the AJAX request to delete the city
                        $.ajax({
                            url: "{{ url('cities') }}/" + cityId,
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
                                        $('#cityRow_' + cityId).remove();
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue deleting the city.',
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