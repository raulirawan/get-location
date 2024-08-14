@extends('layouts.admin')

@section('title', 'Page Locations')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Locations</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Data Locations
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">

                <div class="card-header">Table Locations</div>
                <div class="card-body">
                    {{-- <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                        data-bs-target="#modal-create">
                        Add User
                    </button> --}}

                    <!--Basic Modal -->

                    <div class="table-responsive w-100">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Created At</th>
                                    <th>Latt</th>
                                    <th>Long</th>
                                    <th>Device</th>
                                    <th>IP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('d F Y H:i:s') }}</td>
                                        <td>{{ $item->latt }}</td>
                                        <td>{{ $item->long }}</td>
                                        <td>{{ $item->device }}</td>
                                        <td>{{ $item->ip }}</td>
                                        <td>
                                            <a href="https://www.google.com/maps/?q={{ $item->latt }},{{ $item->long }}"
                                                target="_blank" class="btn btn-success btn-sm">Open In Maps</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>


    @push('down-style')
        <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/fontawesome.css" />
        <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/datatables.css" />
    @endpush
    @push('down-script')
        <script src="{{ asset('assets') }}/js/extensions/datatables.js"></script>
    @endpush
@endsection
