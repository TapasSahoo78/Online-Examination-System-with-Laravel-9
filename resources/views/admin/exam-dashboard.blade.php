@extends('layouts.admin-layout')

@section('space-work')
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Admin Dashboard</h2>
                    <h5>Welcome Jhon Deo , Love to see you back. </h5>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-red set-icon">
                            <i class="fa fa-envelope-o"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">120 New</p>
                            <p class="text-muted">Messages</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="panel panel-back noti-box">
                        <span class="icon-box bg-color-brown set-icon">
                            <i class="fa fa-rocket"></i>
                        </span>
                        <div class="text-box">
                            <p class="main-text">3 Orders</p>
                            <p class="text-muted">Pending</p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /. ROW  -->
            <hr />


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addExamModal">
                Add Exam
            </button>


            <div class="col-md-8">
                <!--    Context Classes  -->
                <div class="panel panel-default">

                    <div class="panel-heading">
                        Exam
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>exam_name</th>
                                        <th>subject_id</th>
                                        <th>date</th>
                                        <th>time</th>
                                        <th>attempt</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($exams) > 0)
                                        @foreach ($exams as $exam)
                                            <tr class="success">
                                                <td>{{ $exam->id }}</td>
                                                <td>{{ $exam->exam_name }}</td>
                                                <td>{{ $exam->subjects[0]['subject'] }}</td>
                                                <td>{{ $exam->date }}</td>
                                                <td>{{ $exam->time }} Hrs</td>
                                                <td>{{ $exam->attempt }} Time</td>
                                                <td>
                                                    <button class="btn btn-info editButton" data-id="{{ $exam->id }}"
                                                        data-subject="" data-toggle="modal"
                                                        data-target="#editExamModal">Edit</button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger deleteButton"
                                                        data-id="{{ $exam->id }}" data-toggle="modal"
                                                        data-target="#deleteExamModal">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="info">
                                            <td colspan="5">Exams Not Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--  end  Context Classes  -->
                {{-- </div> --}}

                <!-- Add Exam Modal -->
                <div class="modal fade" id="addExamModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <form id="addExam">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Add Exam</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="exam_name" placeholder="Enter Exam name" class="w-100"
                                        required>
                                    <br><br>
                                    <select name="subject_id" id="">
                                        <option value="">Select subject</option>
                                        @if (count($subjects) > 0)
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <br><br>
                                    <input type="date" name="date" class="w-100" required
                                        min="@php echo date('Y-m-d'); @endphp">
                                    <br><br>
                                    <input type="time" name="time" class="w-100" required>
                                    <br><br>
                                    <input type="number" name="attempt" placeholder="Enter exam attempt time"
                                        min="1" class="w-100" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Edit Exam Modal -->
                <div class="modal fade" id="editExamModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <form id="editExam">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Exam</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="exam_id" id="exam_id">
                                    <input type="text" name="exam_name" id="exam_name" placeholder="Enter Exam name"
                                        class="w-100" required>
                                    <br><br>
                                    <select name="subject_id" id="subject_id">
                                        <option value="">Select subject</option>
                                        @if (count($subjects) > 0)
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <br><br>
                                    <input type="date" name="date" id="date" class="w-100" required
                                        min="@php echo date('Y-m-d'); @endphp">
                                    <br><br>
                                    <input type="time" name="time" id="time" class="w-100" required>
                                    <br><br>
                                    <input type="number" name="attempt" id="attempt"
                                        placeholder="Enter exam attempt time" min="1" class="w-100" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Exam Modal -->
                <div class="modal fade" id="deleteExamModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <form id="deleteExam">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Exam</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete exam?</p>
                                    <input type="hidden" name="exam_id" id="delete_exam_id">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
        <script>
            $(document).ready(function() {

                //Add Exam
                $("#addExam").submit(function(e) {
                    e.preventDefault();

                    var formData = $(this).serialize();

                    $.ajax({
                        url: "{{ route('addExam') }}",
                        method: "POST",
                        data: formData,
                        success: function(data) {
                            //console.log(data);
                            if (data.success == true) {
                                location.reload();
                            } else {
                                alert(data.msg);
                            }
                        }
                    });
                });

                //Get Exam Details
                $(".editButton").click(function() {
                    var id = $(this).attr('data-id');
                    $("#exam_id").val(id);

                    var url = '{{ route('getExamDetails', 'id') }}';
                    url = url.replace('id', id);

                    $.ajax({
                        url: url,
                        method: "GET",
                        success: function(data) {
                            //console.log(data);
                            if (data.success == true) {
                                var exam = data.data;
                                $("#exam_name").val(exam[0].exam_name);
                                $("#subject_id").val(exam[0].subject_id);
                                $("#date").val(exam[0].date);
                                $("#time").val(exam[0].time);
                                $("#attempt").val(exam[0].attempt);
                            } else {
                                alert(data.msg);
                            }
                        }
                    })
                });

                //Update Exam
                $("#editExam").submit(function(e) {
                    e.preventDefault();

                    var formData = $(this).serialize();

                    $.ajax({
                        url: "{{ route('updateExam') }}",
                        method: "PUT",
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

                //Delete Exam
                $(".deleteButton").click(function() {
                    var id = $(this).attr('data-id');
                    $("#delete_exam_id").val(id);
                });
                $("#deleteExam").submit(function(e) {
                    e.preventDefault();

                    var formData = $(this).serialize();

                    $.ajax({
                        url: "{{ route('deleteExam') }}",
                        method: "DELETE",
                        data: formData,
                        success: function(data) {
                            //console.log(data);
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
