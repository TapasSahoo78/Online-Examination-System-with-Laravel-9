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


            <div class="col-md-10">
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
                                        <th>plan</th>
                                        <th>prices</th>
                                        <th>Add Questions</th>
                                        <th>Show Questions</th>
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
                                                    @if ($exam->plan != 0)
                                                        <span style="color: red;">PAID</span>
                                                    @else
                                                        <span style="color: green;">FREE</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($exam->prices != null)
                                                        @php
                                                            $planPrice = json_decode($exam->prices);
                                                        @endphp
                                                        @foreach ($planPrice as $key => $price)
                                                            <span>{{ $key }}{{ $price }},</span>
                                                        @endforeach
                                                    @else
                                                        <span>Not prices</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" class="addQuestion" data-id="{{ $exam->id }}"
                                                        data-toggle="modal" data-target="#addQnaModal">Add Question</a>
                                                </td>
                                                <td>
                                                    <a href="#" class="seeQuestions" data-id="{{ $exam->id }}"
                                                        data-toggle="modal" data-target="#seeQnaModal">See Question</a>
                                                </td>
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
                                    <br><br>
                                    <select name="plan" class="w-100 mb-4 plan" required style="margin-bottom: 4px;">
                                        <option value="">Select Plan</option>
                                        <option value="0">Free</option>
                                        <option value="1">Paid</option>
                                    </select>
                                    <input type="number" placeholder="In INR" name="inr" disabled
                                        style="margin-bottom: 4px;">

                                    <input type="number" placeholder="In USD" name="usd" disabled>

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
                                    <br><br>
                                    <select name="plan" id="plan" class="w-100 mb-4 plan" required
                                        style="margin-bottom: 4px;">
                                        <option value="">Select Plan</option>
                                        <option value="0">Free</option>
                                        <option value="1">Paid</option>
                                    </select>
                                    <input type="number" id="inr" placeholder="In INR" name="inr" disabled
                                        style="margin-bottom: 4px;">

                                    <input type="number" id="usd" placeholder="In USD" name="usd" disabled>
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

                <!-- Add Answer Modal -->
                <div class="modal fade" id="addQnaModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <form id="addQna">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Add Q&A</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="exam_id" id="addExamId">
                                    <input type="search" name="search" id="search" onkeyup="searchTable()"
                                        placeholder="Search Here">
                                    <br><br>
                                    <table class="table" id="questionsTable">
                                        <thead>
                                            <th>Select</th>
                                            <th>Question</th>
                                        </thead>
                                        <tbody class="addBody">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Q&A</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- See Answer Modal -->
                <div class="modal fade" id="seeQnaModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Questions</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <thead>
                                        <th>S.No</th>
                                        <th>Question</th>
                                    </thead>
                                    <tbody class="seeQuestionTable">

                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Q&A</button>
                            </div>
                        </div>
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

                    $('#inr').val('');
                    $('#usd').val('');

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

                                $('#plan').val(exam[0].plan);

                                if (exam[0].plan == 1) {
                                    let prices = JSON.parse(exam[0].prices);
                                    $('#inr').val(prices.INR);
                                    $('#usd').val(prices.USD);

                                    $('#inr').prop('disabled', false);
                                    $('#usd').prop('disabled', false);

                                    $('#inr').attr('required', 'required');
                                    $('#usd').attr('required', 'required');
                                } else {
                                    $('#inr').prop('disabled', true);
                                    $('#usd').prop('disabled', true);

                                    $('#inr').removeAttr('required');
                                    $('#usd').removeAttr('required');

                                }
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

                //Add Question part
                $(".addQuestion").click(function() {
                    var id = $(this).attr('data-id');

                    $('#addExamId').val(id);

                    $.ajax({
                        url: "{{ route('getQuestions') }}",
                        method: "GET",
                        data: {
                            exam_id: id
                        },
                        success: function(data) {
                            //console.log(data);
                            if (data.success == true) {
                                //location.reload();
                                //console.log(data.data);
                                var questions = data.data;
                                var html = '';
                                if (questions.length > 0) {
                                    for (let i = 0; i < questions.length; i++) {
                                        //console.log(questions[i]);
                                        html += `
                                    <tr>
                                       <td><input type="checkbox" value="` + questions[i]['id'] + `" name="questions_ids[]"></td>
                                       <td>` + questions[i]['question'] + `</td>
                                    </tr>
                                    `;
                                    }

                                } else {
                                    html += `
                                    <tr>
                                       <td colspan="2" class="bg bg-info">Questions not Available!</td>
                                    </tr>
                                    `;
                                }
                                $('.addBody').html(html);
                            } else {
                                alert(data.msg);
                            }
                        }
                    });
                });

                //Add Questions Post Section
                $("#addQna").submit(function(e) {
                    e.preventDefault();

                    var formData = $(this).serialize();
                    //console.log(formData);

                    $.ajax({
                        url: "{{ route('addQuestions') }}",
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

                //See Questions
                $(".seeQuestions").click(function() {
                    var id = $(this).attr('data-id');
                    // console.log(id);

                    $.ajax({
                        url: "{{ route('getExamQuestions') }}",
                        type: "GET",
                        data: {
                            exam_id: id
                        },
                        success: function(data) {
                            // console.log(data);
                            var html = '';
                            var questions = data.data;
                            if (questions.length > 0) {
                                for (let i = 0; i < questions.length; i++) {
                                    html += `
                                        <tr>
                                        <td>` + (i + 1) + `</td>
                                        <td>` + questions[i]['questions'][0]['question'] + `</td>
                                        <td>
                                            <button class="btn btn-danger deleteQuestion" data-id="` + questions[i][
                                        'id'
                                    ] + `">Delete</button>
                                        </td>
                                        </tr>
                                      `;

                                }
                            } else {
                                html += `
                                        <tr>
                                        <td colspan="3" class="bg bg-info">Questions not Available!</td>
                                        </tr>
                                      `;
                            }
                            $(".seeQuestionTable").html(html);
                        }
                    });
                });

                //Delete Questions
                $(document).on('click', '.deleteQuestion', function() {

                    var id = $(this).attr('data-id');
                    var obj = $(this);
                    //console.log(obj);
                    $.ajax({
                        url: "{{ route('deleteExamQuestions') }}",
                        type: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            //console.log(data);
                            if (data.success == true) {
                                obj.parent().parent().remove();
                            } else {
                                alert(data.msg);
                            }
                        }
                    });
                });



                //Plan Js
                $('.plan').change(function() {
                    var plan = $(this).val();
                    if (plan == 1) {
                        $(this).next().attr('required', 'required');
                        $(this).next().next().attr('required', 'required');

                        $(this).next().prop('disabled', false);
                        $(this).next().next().prop('disabled', false);
                    } else {
                        $(this).next().removeAttr('required', 'required');
                        $(this).next().next().removeAttr('required', 'required');

                        $(this).next().prop('disabled', true);
                        $(this).next().next().prop('disabled', true);
                    }
                });



            });
        </script>

        <script>
            function searchTable() {
                var input, filters, table, tr, td, i, txtValue;
                input = document.getElementById('search');
                filters = input.value.toUpperCase();
                table = document.getElementById('questionsTable');
                tr = table.getElementsByTagName("tr");
                //console.log(tr);
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {
                        txtValue = td.textContent || td.innerText;

                        if (txtValue.toUpperCase().indexOf(filters) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }

            }
        </script>

    @endsection
