@extends('backend.layouts.app_template')
@section('title', 'Create Type Document Driver')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Type Document Driver /</span> Enregistrement</h4>
            <div class="col-md-2"></div>

            <div class="col-md-8">

                <form action="{{ route('type_document_driver.store') }}" method="post" >
                    @csrf
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Commune</h5>
                            {{--                            <small class="text-muted float-end">Enregistrement</small>--}}
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="libelle">Libelle</label>
                                <input type="text" class="form-control @error('libelle') is-invalid @enderror"
                                       id="libelle" name="libelle" placeholder="Libelle" />
                                @error('libelle')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Description</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                       id="description" name="description" placeholder="Description" />
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-check form-switch mb-2">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Has Expirate</label>
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                       name="has_expiry_date" />
                                @error('has_expiry_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" class="form-select @error('status') is-invalid @enderror"
                                        name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>
@endsection
