@extends('backend.layouts.app_template')
@section('title', 'Update Driver')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Driver /</span> Enregistrement</h4>
            <div class="col-md-2"></div>

            <div class="col-md-8">

                <form action="{{ route('driver.update', ['driver' => $driver]) }}" method="post" >
                    @csrf
                    @method('PATCH')
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Driver</h5>
                            {{--                            <small class="text-muted float-end">Enregistrement</small>--}}
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="name">Nom & Prenoms</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{$driver->name}}" placeholder="Nom & Prenoms" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{$driver->user->email}}" placeholder="Email" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="mobile">Telephone</label>
                                <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                       id="mobile" name="mobile" value="{{$driver->user->mobile}}" placeholder="Telephone" />
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Genre</label>
                                <select id="gender" class="form-select @error('gender') is-invalid @enderror"
                                        name="gender">
                                    <option value="Homme" {{$driver->gender == 'Homme' ? 'selected' : ''}}>Homme</option>
                                    <option value="Femme" {{$driver->gender == 'Femme' ? 'selected' : ''}}>Femme</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" class="form-select @error('status') is-invalid @enderror"
                                        name="status">
                                    <option value="1" {{$driver->status == 1 ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{$driver->status == 0 ? 'selected' : ''}}>Inactive</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
