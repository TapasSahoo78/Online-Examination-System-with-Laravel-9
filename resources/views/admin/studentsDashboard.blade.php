@extends('layouts.admin-layout')

@section('space-work')
    <div id="page-wrapper">
        <div id="page-inner">

            <hr />
            <div class="row" style="margin-bottom: 10px;margin-left:5px;">
                <div class="col-md-8">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
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
                                                        data-name="{{ $student->name }}" data-email="{{ $student->email }}"
                                                        data-toggle="modal" data-target="#editStudentModal">Edit</button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger deleteButton"
                                                        data-id="{{ $student->id }}" data-toggle="modal"
                                                        data-target="#deleteStudentModal">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3">Students are not Found!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <!-- Add Student Modal -->
                            <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add Student</h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="addStudent">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" name="name"
                                                            placeholder="Enter Student Name" class="w-100" required>
                                                        <br><br>
                                                        <input type="email" name="email"
                                                            placeholder="Enter Student Email" class="w-100" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <span class="error" style="color: red;"></span>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add Student</button>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>


                            <!-- Add Edit Modal -->
                            <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Student</h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="editStudent">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="hidden" name="id" id="std_id">
                                                        <input type="text" name="name" id="name"
                                                            placeholder="Enter Student Name" class="w-100" required>
                                                        <br><br>
                                                        <input type="email" name="email" id="email"
                                                            placeholder="Enter Student Email" class="w-100" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <span class="error" style="color: red;"></span>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary updateButton">Update
                                                    Student</button>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>


                            <!-- Delete Q&A Modal -->
                            <div class="modal fade" id="deleteStudentModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form id="deleteStudent">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Student</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete Student?</p>
                                                <input type="hidden" name="std_id" id="delete_std_id">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--  end  Context Classes  -->
                {{-- </div> --}}
            </div>
        </div>

        <script>
            $(document).ready(function() {
                //Add Student
                $("#addStudent").submit(function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize();

                    $.ajax({
                        url: "{{ route('addStudent') }}",
                        type: "POST",
                        data: formData,
                        success: function(data) {
                            console.log(data);
                            if (data.success == true) {
                                location.reload();
                            } else {
                                alert(data.msg);
                            }
                        }
                    });

                });

                //Edit button click and show value.
                $(".editButton").click(function() {
                    var id = $(this).attr('data-id');
                    var name = $(this).attr('data-name');
                    var email = $(this).attr('data-email');

                    $("#std_id").val(id);
                    $("#name").val(name);
                    $("#email").val(email);
                });

                $("#editStudent").submit(function(e) {
                    e.preventDefault();
                    $(".updateButton").prop('disabled', true);
                    var formData = $(this).serialize();

                    $.ajax({
                        url: "{{ route('editStudent') }}",
                        type: "PUT",
                        data: formData,
                        success: function(data) {
                            console.log(data);
                            if (data.success == true) {
                                location.reload();
                            } else {
                                alert(data.msg);
                            }
                        }
                    });

                });

                //Delete Button
                $(".deleteButton").click(function() {
                    var id = $(this).attr('data-id');
                    $("#delete_std_id").val(id);
                });
                $("#deleteStudent").submit(function(e) {
                    e.preventDefault();

                    var formData = $(this).serialize();

                    $.ajax({
                        url: "{{ route('deleteStudent') }}",
                        method: "DELETE",
                        data: formData,
                        success: function(data) {
                            // console.log(data);
                            if (data.success == true) {
                                location.reload();
                            } else {
                                alert(data.msg);
                            }
                        }
                    });
                });



            });
        </script>

    @endsection
