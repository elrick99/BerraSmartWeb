@extends('backend.layouts.app_template')
@section('title', 'Driver Document')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('backend.layouts.alert_notification')

        <!-- Bordered Table -->
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-header">Liste Driver Documents ({{ $results->total() }})</h5>
                </div>
                {{--                <div class="col-md-4"></div>--}}
                <div class="col-md-6 p-3 p-md-8">
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
{{--                            <a type="button" class="btn btn-primary"--}}
{{--                               href="{{ route('driver-document.create') }}"><i class="bx bx-upload me-1"></i>Enregistrement</a>--}}
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
                            <th>Numero Identifiant</th>
                            <th>Expirate Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="tbodyCategorie">
                        @foreach ($results as $item)
                            @php
                            $driverDocument = \App\Models\DriverDocument::where('driver_id', $driver->user_id)->where('type_document_driver_id', $item->id)->first();
                             @endphp
                            <tr>
                                <td>
                                    {{ $item->libelle }}
                                </td>
                                <td>{{  $driverDocument->identify_number }}</td>
                                <td>{{  $driverDocument->expiry_date }}</td>
                                <td>
                                    @if ($driverDocument->status === 'WAITING_FOR_APPROVAL')
                                        <span class="badge bg-label-warning me-1">WAITING_FOR_APPROVAL</span>
                                    @elseif($driverDocument->status === 'APPROVED')
                                        <span class="badge bg-label-success me-1">APPROVED</span>
                                    @elseif($driverDocument->status === 'REJECTED')
                                        <span class="badge bg-label-danger me-1">REJECTED</span>
                                    @elseif($driverDocument->status === 'EXPIRED_AND_DECLINED')
                                        <span class="badge bg-label-danger me-1">EXPIRED_AND_DECLINED</span>
                                    @elseif($driverDocument->status === 'NOT_UPLOADED')
                                        <span class="badge bg-label-secondary me-1">NOT_UPLOADED</span>
                                    @endif


                                </td>
                                <td>
                                    <form action="{{route('driver-document.approve',['driverDocument' => $driverDocument])}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="status" value="APPROVED" class="btn btn-sm btn-outline-success">Approuve</button>
                                        <button type="submit" name="status" value="REJECTED" class="btn btn-sm btn-outline-danger">Rejecter</button>
                                    </form>
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

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Image Document</h5>
                        </div>
                        <div class="modal-body">
                            <div class="col-md">
                                <h5 class="my-4">Bootstrap carousel</h5>

                                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></li>
                                        <li data-bs-target="#carouselExample" data-bs-slide-to="1"></li>
                                        <li data-bs-target="#carouselExample" data-bs-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="{{asset('templates/backend/assets/img/elements/13.jpg')}}" alt="First slide" />
                                            <div class="carousel-caption d-none d-md-block">
                                                <h3>First slide</h3>
                                                <p>Eos mutat malis maluisset et, agam ancillae quo te, in vim congue pertinacia.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" id="csv_file_data">
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Supprimer</button>
                        </div>
                    </div>
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

                // show slide image on modal js

                $(".btn_delete_modal").on('click', function () {

                });

                // end js




                function relod() {
                    location.reload();
                }
            });
        </script>

@endsection





