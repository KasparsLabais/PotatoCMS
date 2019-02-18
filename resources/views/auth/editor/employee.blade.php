@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <h3>Edit employee info</h3>
                                <a href="/employee" class="btn-link">BACK</a>
                                <hr>
                                <form method="POST" action="/employee/{{ $response["id"] }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="form-group">
                                        <label for="first_name" class="control-label">Name</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $response["payload"]["first_name"] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="control-label">Surname</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $response["payload"]["last_name"] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company_id" class="control-label">Company</label>
                                        <select name="company_id" id="company_id" class="form-control">
                                            @foreach($response["companies"] as $cp)
                                                @if($cp->company_id == $response["payload"]["company_id"])
                                                    <option value="{{ $cp->company_id }}" selected="selected">{{ $cp->name }}</option>
                                                @else
                                                    <option value="{{ $cp->company_id }}">{{ $cp->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="control-label">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="phone" value="{{ $response["payload"]["phone"] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" value="{{ $response["payload"]["email"] }}">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-dark">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
