<x-admin.layouts.master>
    <div class="dashboard__body">
        <div class="dashboard__inner">
            <div class="dashboard__inner__item dashboard__card bg__white padding-20 radius-10">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="dashboard__inner__item__header__title">States</h4>
                    <a href="{{ route('states.create') }}" class="btn btn-sm btn-success">Create</a>
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
                                    <th>Country</th> <!-- Added Country Name Column -->
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($states as $index => $state)
                                <tr id="stateRow_{{ $state->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $state->name }}</td>
                                    <td>{{ $state->country->name }}</td> <!-- Displaying Country Name -->
                                    <td class="{{ $state->status == 'active' ? 'text-success' : 'text-danger' }}">
                                        {{ ucfirst($state->status) }}
                                    </td>
                                    <td>
                                        <!-- DropDown -->
                                        <div class="d-flex">
                                            <a class="btn btn-sm btn-primary" href="{{ route('states.edit', $state->id) }}">Edit</a>
                                            <form id="deleteStateForm_{{ $state->id }}" class="d-inline ms-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger deleteStateBtn" data-state-id="{{ $state->id }}">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No states available.</td> <!-- Updated colspan to 5 -->
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
            $('.deleteStateBtn').click(function(e) {
                e.preventDefault();

                var stateId = $(this).data('state-id');

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
                        // Send the AJAX request to delete the state
                        $.ajax({
                            url: "{{ url('states') }}/" + stateId,
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
                                        $('#stateRow_' + stateId).remove();
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue deleting the state.',
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