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
                                <button data-target="#add-companies-modal" data-toggle="modal" class="btn btn-success btn-block text-light">Add new</button>
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
                                            <th> Email </th>
                                            <th> Logo </th>
                                            <th> Website </th>
                                            <th> Edit </th>
                                            <th> Delete </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($companies as $cp)
                                            <tr>
                                                <td>{{ $cp->company_id }}</td>
                                                <td>{{ $cp->name }}</td>
                                                <td>{{ $cp->email }}</td>
                                                <td>{{ $cp->logo }}</td>
                                                <td>{{ $cp->website }}</td>
                                                <td>
                                                    <a href="/companies/{{ $cp->company_id }}" class="btn btn-sm btn-warning">Edit</a>
                                                </td>
                                                <td>
                                                    <button data-companyid="{{ $cp->company_id }}" class="company-delete btn btn-sm btn-danger">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $companies->onEachSide(3)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="add-companies-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Add new company</h1>
                </div>
                <div class="modal-body">
                    <form method="post" action="/companies" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="control-label">Company name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="logo" class="control-label">Logo</label>
                            <input type="file" class="form-control" name="logo" id="logo">
                        </div>
                        <div class="form-group">
                            <label for="website" class="control-label">Website</label>
                            <input type="text" class="form-control" name="website" id="website">
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

        $(".company-delete").on("click", function() {

            if(confirm("This potato will be lost! Are you sure?")) {
                $.ajax({
                    url: "/companies/"+$(this).data("companyid"),
                    type: "DELETE",
                    success: function () {
                        alert("Success!");
                        setTimeout(function () {
                            window.location.replace("/companies");
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
