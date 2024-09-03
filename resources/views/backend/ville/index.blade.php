@extends('backend.layouts.app_template')
@section('title', 'Ville')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('backend.layouts.alert_notification')

        <!-- Bordered Table -->
        <div class="card">
            <div class="row">
                <div class="col-md-2">
                    <h5 class="card-header">Liste Ville ({{ $results->total() }})</h5>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-6 p-3 p-md-8">
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <a type="button" class="btn btn-primary"
                               href="{{ route('ville.create') }}"><i class="bx bx-upload me-1"></i>Enregistrement</a>
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
                                                       href="{{ route('ville.edit', ['ville' => $item]) }}"><i
                                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    <form method="POST" action="{{route('ville.destroy',[$item->id])}}">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$item->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                    <a class="dropdown-item btn_delete_modal" id="{{ $item->id }}" data-url="{{ route('ville.destroy', ['ville' => $item]) }}"
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
                    @method('delete')
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
                        url: "admin/ville/"+$('#id').val(),
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        async: false,
                        data: new FormData(this),
                        success: function (data) {
                            var response = JSON.parse(data);

                            if (response) {
                                if (response['statutCode'] === 200) {
                                    $('#csv_file_data').html('<div class="alert alert-success alert-dismissible py-2" role="alert">' + response['message'] + '</div>');
                                    $('#csv_file_data').show(1000);
                                    setTimeout(relod, 2000)
                                } else if (response['statutCode'] === 201) {
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

@push('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

            <script>
                $(document).ready(function(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('.dltBtn').click(function(e){
                        var form=$(this).closest('form');
                        var dataID=$(this).data('id');
                        // alert(dataID);
                        e.preventDefault();
                        swal({
                            title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover this data!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                            .then((willDelete) => {
                                if (willDelete) {
                                    form.submit();
                                } else {
                                    swal("Your data is safe!");
                                }
                            });
                    })
                })
            </script>
@endpush




