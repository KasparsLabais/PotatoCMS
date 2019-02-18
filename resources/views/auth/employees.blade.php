@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-4">
                                <button data-target="#add-employee-modal" data-toggle="modal" class="btn btn-success btn-block text-light">Add new</button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th> ID </th>
                                            <th> Name </th>
                                            <th> Surname </th>
                                            <th> Company </th>
                                            <th> Email </th>
                                            <th> Phone</th>
                                            <th> Edit </th>
                                            <th> Delete </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $emp)
                                            <tr>
                                                <td>{{ $emp->employee_id }}</td>
                                                <td>{{ $emp->first_name }}</td>
                                                <td>{{ $emp->last_name }}</td>
                                                <td>{{ $emp->company_id }}</td> <!-- TODO: could get just name -->
                                                <td>{{ $emp->email }}</td>
                                                <td>{{ $emp->phone }}</td>
                                                <td>
                                                    <a href="/employee/{{ $emp->employee_id }}" class="btn btn-sm btn-warning">Edit</a>
                                                </td>
                                                <td>
                                                    <button data-employeeid="{{ $emp->employee_id }}" class="employee-delete btn btn-sm btn-danger">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $employees->onEachSide(3)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="add-employee-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Add new employee</h1>
                </div>
                <div class="modal-body">
                    <form method="post" action="/employee">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="first_name" class="control-label">Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name">
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="control-label">Surname</label>
                            <input type="text" class="form-control" name="last_name" id="last_name">
                        </div>
                        <div class="form-group">
                            <label for="company_id" class="control-label">Company</label>
                            <select name="company_id" id="company_id" class="form-control">
                                @foreach($companies as $cp)
                                    <option value="{{ $cp->company_id }}">{{ $cp->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="control-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone">
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-dark">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


@section("scripts")
    <script type="text/javascript" defer>

        $(".employee-delete").on("click", function() {

            if(confirm("This potato slave will be lost! Are you sure?")) {
                $.ajax({
                    url: "/employee/"+$(this).data("employeeid"),
                    type: "DELETE",
                    success: function () {
                        alert("Success!");
                        setTimeout(function () {
                            window.location.replace("/employee");
                        }, 2500)
                    },
                    error: function () {
                        alert("There was error. Please try again later or much much later!");
                    },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("X-CSRF-Token", "{{ csrf_token() }}");
                    }
                });
            }
        });


    </script>
@endsection
