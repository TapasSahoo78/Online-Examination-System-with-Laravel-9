@extends('layouts.admin-layout')

@section('space-work')
    <div id="page-wrapper">
        <div id="page-inner">

            <hr />
            <div class="row" style="margin-bottom: 10px;margin-left:5px;">
                <div class="col-md-8">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQnaModal">
                        Add Students
                    </button>
                    {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importQnaModal">
                        Import Students
                    </button> --}}
                </div>
            </div>
            <!-- /. ROW  -->

            <div class="col-md-12">
                <!--    Context Classes  -->
                <div class="panel panel-default">

                    <div class="panel-heading">
                        Students
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($students) > 0)
                                        @foreach ($students as $key => $student)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>
                                                    <button class="btn btn-info editButton" data-id="{{ $student->id }}"
                                                        data-toggle="modal" data-target="#editStdModal">Edit</button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger deleteButton"
                                                        data-id="{{ $student->id }}" data-toggle="modal"
                                                        data-target="#deleteStdModal">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3">students are not Found!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--  end  Context Classes  -->
                {{-- </div> --}}
            </div>
        </div>
    @endsection
