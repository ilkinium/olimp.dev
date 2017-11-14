@extends('layouts.backend')

@section('headerScripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    @endsection

@section('pageTitle', 'List of pages')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-primary mb-3">
                <div class="card-header">
                    <a href="{{ route('admin.pages.create') }}">
                        <i class="fa fa-plus"></i> Create new page
                    </a>
                </div>
                <div class="card-body">
                    @if(isset($pages) && count($pages))
                        <table id="example" class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                            <thead class="thead-dark">
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                            </tfoot>
                            <tbody>

                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-primary" role="alert">
                            There are no data in db!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerScripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
    @endsection