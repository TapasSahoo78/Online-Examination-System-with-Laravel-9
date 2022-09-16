@extends('layouts.admin-layout')

@section('space-work')
    <div id="page-wrapper">
        <div id="page-inner">

            <hr />
            <div class="row" style="margin-bottom: 10px;margin-left:5px;">
                <div class="col-md-8">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQnaModal">
                        Add Q&A
                    </button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importQnaModal">
                        Import Q&A
                    </button>
                </div>
            </div>
            <!-- /. ROW  -->

            <div class="col-md-12">
                <!--    Context Classes  -->
                <div class="panel panel-default">

                    <div class="panel-heading">
                        Q&A
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question</th>
                                        <th>Answers</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($questions) > 0)
                                        @foreach ($questions as $key => $question)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $question->question }}</td>
                                                <td>
                                                    <a href="#" class="ansButton" data-id="{{ $question->id }}"
                                                        data-toggle="modal" data-target="#showAnsModal">See Answers</a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info editButton" data-id="{{ $question->id }}"
                                                        data-toggle="modal" data-target="#editQnaModal">Edit</button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger deleteButton"
                                                        data-id="{{ $question->id }}" data-toggle="modal"
                                                        data-target="#deleteQnaModal">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3">Questions and Answers not Found!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--  end  Context Classes  -->
                {{-- </div> --}}

                <!-- Add Answer Modal -->
                <div class="modal fade" id="addQnaModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Add Q&A</h5>

                                <button id="addAnswer" class="ml-5 btn btn-info">Add Answer</button>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="addQna">
                                @csrf
                                <div class="modal-body addModalAnswers">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="question" placeholder="Enter Question"
                                                class="w-100" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="error" style="color: red;"></span>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Q&A</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>

                <!-- Show Answer Modal -->
                <div class="modal fade" id="showAnsModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Show Answers</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Answers</th>
                                        <th> Is Correct</th>
                                    </thead>
                                    <tbody class="showAnswers">
                                        <tr>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <span class="error" style="color: red;"></span>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Answer Modal -->
                <div class="modal fade" id="editQnaModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Q&A</h5>

                                <button id="addEditAnswer" class="ml-5 btn btn-info">Update Answer</button>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="editQna">
                                @csrf
                                <div class="modal-body editModalAnswers">
                                    <div class="row">
                                        <div class="col">
                                            <input type="hidden" name="question_id" id="question_id">
                                            <input type="text" name="question" id="question"
                                                placeholder="Enter Question" class="w-100" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span class="editerror" style="color: red;"></span>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Q&A</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Q&A Modal -->
                <div class="modal fade" id="deleteQnaModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <form id="deleteQna">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Q&A</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete Q&A?</p>
                                    <input type="hidden" name="qna_id" id="delete_qna_id">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Import Q&A Modal -->
                <div class="modal fade" id="importQnaModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <form id="importQna" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Import Q&A</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="file" name="file" id="fileUpload" required
                                        accept=".csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms.excel">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-info">Import</button>
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
                //Form Submission
                $(".addQna").submit(function(e) {
                    e.preventDefault();
                    if ($(".answers").length < 2) {
                        $(".error").text("Please add minimum two answers.");
                        setTimeout(() => {
                            $(".error").text("");
                        }, 2000);
                    } else {
                        var checkIsCorrect = false;
                        for (let i = 0; i < $(".is_correct").length; i++) {
                            if ($(".is_correct:eq(" + i + ")").prop('checked') == true) {
                                checkIsCorrect = true;
                                $(".is_correct:eq(" + i + ")").val($(".is_correct:eq(" + i + ")").next().find(
                                    'input').val());
                            }
                        }

                        if (checkIsCorrect) {
                            var formData = $(this).serialize();
                            $.ajax({
                                url: "{{ route('addQna') }}",
                                method: "POST",
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

                        } else {
                            $(".error").text("Please select anyone correct answer.");
                            setTimeout(() => {
                                $(".error").text("");
                            }, 2000);
                        }

                    }
                });

                //Add Answer
                $("#addAnswer").click(function() {
                    if ($(".answers").length >= 6) {
                        $(".error").text("You can add maximum 6 answers.");
                        setTimeout(() => {
                            $(".error").text("");
                        }, 2000);
                    } else {
                        var html = `
                        <div class="row mt-2 answers">
                            <input type="radio" name="is_correct" class="is_correct">
                            <div class="col">
                                <input type="text" name="answers[]" placeholder="Enter Answers"
                                    class="w-100" required>
                            </div>
                            <button class="btn btn-danger removeButton">Remove</button>
                        </div>
                    `;
                        $(".addModalAnswers").append(html);
                    }

                });

                $(document).on("click", ".removeButton", function() {
                    $(this).parent().remove();
                });

                //Show Answers
                $(".ansButton").click(function() {
                    var questions = @json($questions);
                    var qid = $(this).attr('data-id');

                    //console.log(questions);
                    //console.log(questions.length);

                    var html = '';

                    for (let i = 0; i < questions.length; i++) {

                        if (questions[i]['id'] == qid) {
                            //console.log(questions[i]);
                            var answersLength = questions[i]['answers'].length;
                            //console.log(answersLength);
                            for (let j = 0; j < answersLength; j++) {
                                let is_correct = 'No';
                                //console.log(questions[i]['answers'][j]);
                                if (questions[i]['answers'][j]['is_correct'] == 1) {
                                    is_correct = 'Yes';
                                }
                                html += `
                                    <tr>
                                        <td>` + (j + 1) + `</td>
                                        <td>` + questions[i]['answers'][j]['answers'] + `</td>
                                        <td>` + is_correct + `</td>
                                    </tr>
                                `;

                                //console.log(html);
                            }
                            break;
                        }
                    }

                    $(".showAnswers").html(html);

                });

                //Edit and Update Q&A
                $("#addEditAnswer").click(function() {
                    if ($(".editanswers").length >= 6) {
                        $(".editerror").text("You can add maximum 6 answers.");
                        setTimeout(() => {
                            $(".editerror").text("");
                        }, 2000);
                    } else {
                        var html = `
                        <div class="row mt-2 editanswers">
                            <input type="radio" name="is_correct" class="edit_is_correct">
                            <div class="col">
                                <input type="text" name="new_answers[]" placeholder="Enter Answers"
                                    class="w-100" required>
                            </div>
                            <button class="btn btn-danger removeButton">Remove</button>
                        </div>
                    `;
                        $(".editModalAnswers").append(html);
                    }

                });

                $(".editButton").click(function() {
                    var qid = $(this).attr('data-id');

                    $.ajax({
                        url: "{{ route('getQnaDetails') }}",
                        type: "GET",
                        data: {
                            qid: qid
                        },
                        success: function(data) {
                            //console.log(data);
                            var qna = data.data[0];
                            //console.log(qna);
                            $("#question_id").val(qid);
                            $("#question").val(qna['question']);
                            $(".editanswers").remove();
                            var html = ``;
                            for (let i = 0; i < qna['answers'].length; i++) {
                                var checked = '';
                                if (qna['answers'][i]['is_correct'] == 1) {
                                    checked = 'checked';
                                }
                                html += `
                                    <div class="row mt-2 editanswers">
                                    <input type="radio" name="is_correct" class="edit_is_correct" ` + checked + `>
                                    <div class="col">
                                        <input type="text" name="answers[` + qna['answers'][i]['id'] + `]" placeholder="Enter Answers"
                                            class="w-100"
                                value="` + qna['answers'][i]['answers'] + `" required>
                                    </div>
                                    <button class="btn btn-danger removeButton removeAnswer" data-id="` + qna[
                                    'answers'][i]['id'] + `">Remove</button>
                                    </div>
                                `;
                            }
                            $(".editModalAnswers").append(html);
                        }
                    });
                });

                $(".editQna").submit(function(e) {
                    e.preventDefault();
                    if ($(".editanswers").length < 2) {
                        $(".editerror").text("Please add minimum two answers.");
                        setTimeout(() => {
                            $(".editerror").text("");
                        }, 2000);
                    } else {
                        var checkIsCorrect = false;
                        for (let i = 0; i < $(".edit_is_correct").length; i++) {
                            if ($(".edit_is_correct:eq(" + i + ")").prop('checked') == true) {
                                checkIsCorrect = true;
                                $(".edit_is_correct:eq(" + i + ")").val($(".edit_is_correct:eq(" + i + ")")
                                    .next().find(
                                        'input').val());
                            }
                        }

                        if (checkIsCorrect) {
                            var formData = $(this).serialize();
                            //console.log(formData);
                            $.ajax({
                                url: "{{ route('updateQna') }}",
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
                        } else {
                            $(".editerror").text("Please select anyone correct answer.");
                            setTimeout(() => {
                                $(".editerror").text("");
                            }, 2000);
                        }

                    }
                });

                //Remove Answers
                $(document).on("click", ".removeAnswer", function() {
                    var ansId = $(this).attr('data-id');

                    $.ajax({
                        url: "{{ route('deleteAns') }}",
                        type: "GET",
                        data: {
                            id: ansId
                        },
                        success: function(data) {
                            if (data.success == true) {
                                console.log(data.msg);
                            } else {
                                alert(data.msg);
                            }
                        }
                    });
                });

                //Delete Q&A
                $(".deleteButton").click(function() {
                    var id = $(this).attr('data-id');
                    $("#delete_qna_id").val(id);
                });
                $("#deleteQna").submit(function(e) {
                    e.preventDefault();

                    var formData = $(this).serialize();
                    //console.log(formData);

                    $.ajax({
                        url: "{{ route('deleteQna') }}",
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

                //Import Q&A
                $("#importQna").submit(function(e) {
                    e.preventDefault();

                    let formData = new FormData();
                    formData.append("file", fileUpload.files[
                        0]); //from controller("file")|fileUpload.files[0] from input:file Id...

                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    });

                    $.ajax({
                        url: "{{ route('importQna') }}",
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
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

            });
        </script>
    @endsection
