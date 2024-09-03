@extends('backend.layouts.app_template')
@section('title', 'Create Ville')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Ville /</span> Modification</h4>
            <div class="col-md-2"></div>

            <div class="col-md-8">
                @include('backend.layouts.alert_notification')
                <form action="{{ route('ville.update', ['ville' => $ville]) }}" method="post" >
                    @method('PATCH')
                    @csrf
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Ville</h5>
                            {{--                            <small class="text-muted float-end">Enregistrement</small>--}}
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="libelle">Libelle</label>
                                <input type="text" class="form-control @error('libelle') is-invalid @enderror"
                                       id="libelle" name="libelle" value="{{$ville->libelle}}" placeholder="Libelle" />
                                @error('libelle')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Description</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                       id="description" name="description" value="{{$ville->description}}" placeholder="Description" />
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" class="form-select @error('status') is-invalid @enderror"
                                        name="status">
                                    <option value="1" @if($ville->status == '1') selected @endif>Active</option>
                                    <option value="0" @if($ville->status == '0') selected @endif>Inactive</option>
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
