@extends('backend.layouts.app_template')
@section('title', 'Update Commune')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Commune /</span> Modification</h4>
            <div class="col-md-2"></div>

            <div class="col-md-8">

                <form action="{{ route('commune.update', ['commune' => $commune]) }}" method="post" >
                    @csrf
                    @method('PATCH')
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Commune</h5>
                            {{--                            <small class="text-muted float-end">Enregistrement</small>--}}
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="libelle">Libelle</label>
                                <input type="text" class="form-control @error('libelle') is-invalid @enderror"
                                       id="libelle" name="libelle" value="{{$commune->libelle}}" placeholder="Libelle" />
                                @error('libelle')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Description</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                       id="description" name="description" value="{{$commune->description}}" placeholder="Description" />
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="ville_id" class="form-label">Ville</label>
                                <select id="ville_id" class="form-select @error('ville_id') is-invalid @enderror" name="ville_id">
                                    @foreach($villes as $ville)
                                        <option value="{{$ville->id}}" {{$ville->id == $commune->ville_id ? 'selected' : ''}}>{{$ville->libelle}}</option>
                                    @endforeach
                                </select>
                                @error('ville_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" class="form-select @error('status') is-invalid @enderror"
                                        name="status">
                                    <option value="1" {{$commune->status == 1 ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{$commune->status == 0 ? 'selected' : ''}}>Inactive</option>
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
