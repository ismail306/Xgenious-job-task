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
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $country->name }}</td>
                                    <td class="{{ $country->status == 'active' ? 'text-success' : 'text-danger' }}">
                                        {{ ucfirst($country->status) }}
                                    </td>
                                    <td>
                                        <!-- DropDown -->
                                        <div class="d-flex">
                                            <a class="btn btn-sm btn-primary" href="{{ route('countries.edit', $country->id) }}">Edit</a>
                                            <form action="{{ route('countries.destroy', $country->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this country?');" class="ms-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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

</x-admin.layouts.master>