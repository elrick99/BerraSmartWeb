@extends('backend.layouts.app_template')
@section('title', 'Type Document Driver')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('backend.layouts.alert_notification')

        <!-- Bordered Table -->
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-header">Liste Type Document Driver ({{ $results->total() }})</h5>
                </div>
{{--                <div class="col-md-4"></div>--}}
                <div class="col-md-6 p-3 p-md-8">
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <a type="button" class="btn btn-primary"
                               href="{{ route('type_document_driver.create') }}"><i class="bx bx-upload me-1"></i>Enregistrement</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4 pt-2 py-2 pb-2 pe-6">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                        <input
                            type="text"
                            class="form-control me-2"
                            placeholder="Recherche..."
                            aria-label="Search..."
                            id="inputSearch"
                            aria-describedby="basic-addon-search31"
                        />
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Libelle</th>
                            <th>Description</th>
                            <th>Is Expirate</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyCategorie">
                        @foreach ($results as $item)
                            <tr>
                                <td>
                                    {{ $item->libelle }}
                                </td>
                                <td>{{ mb_strimwidth($item->description, 0, 25).'...' }}</td>
                                <td>
                                    @if ($item->has_expiry_date == 1)
                                        <span class="badge bg-label-primary me-1">Oui</span>
                                    @else
                                        <span class="badge bg-label-warning me-1">Non</span>
                                    @endif

                                </td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge bg-label-primary me-1">Oui</span>
                                    @else
                                        <span class="badge bg-label-warning me-1">Non</span>
                                    @endif

                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                       href="{{ route('type_document_driver.edit', ['type_document_driver' => $item]) }}"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <a class="dropdown-item btn_delete_modal" id="{{ $item->id }}" data-url="{{ route('type_document_driver.destroy', ['type_document_driver' => $item]) }}"
                                                       data-bs-toggle="modal" data-bs-target="#basicModal"
                                                       href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                                        Delete</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{ $results->links() }} ({{ $results->count() }} Elements sur cette Page)


                </div>
            </div>
        </div>
        <!--/ Bordered Table -->


        <!-- Modal Delete-->
        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="modal_form_id" >
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Suppresion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Etes vous sure de vouloir supprimer cet Element ?</p>
                            <input type="hidden" id="id" name="id">
                        </div>
                        <div class="modal-footer" id="csv_file_data">
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Supprimer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script type="application/javascript">
            $(document).ready(function () {

                $('#inputSearch').on('keyup', function () {
                    var value = $(this).val().toLowerCase();
                    $("#tbodyCategorie tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

                $('.btn_delete_modal').on('click', function () {
                    document.getElementById('id').value = this.id;
                })

                $("#modal_form_id").on('submit', (function (e) {
                    $('#csv_file_data').html('<div class="alert alert-warning alert-dismissible py-2" role="alert">En Cours</div>');
                    e.preventDefault();
                    $.ajax({
                        url: "type_document_driver/"+$('#id').val(),
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        async: false,
                        data: new FormData(this),
                        success: function (data) {
                            var response = JSON.parse(data);

                            if (response) {
                                console.log(response);
                                if (response['statusCode'] === 200) {
                                    $('#csv_file_data').html('<div class="alert alert-success alert-dismissible py-2" role="alert">' + response['message'] + '</div>');
                                    $('#csv_file_data').show(1000);
                                    setTimeout(relod, 2000)
                                } else if (response['statusCode'] === 201) {
                                    $('#csv_file_data').html('<div class="alert alert-danger alert-dismissible py-2" role="alert"">' + response['message'] + '</div>');
                                    $('#csv_file_data').show(1000);
                                    setTimeout(relod, 2000)
                                }
                            }
                        }
                    });
                }));



                function relod() {
                    location.reload();
                }
            });
        </script>

@endsection





