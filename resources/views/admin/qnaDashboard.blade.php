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

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--  end  Context Classes  -->
                {{-- </div> --}}

                <!-- Add Exam Modal -->
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
                                <div class="modal-body">
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
                        $(".modal-body").append(html);
                    }

                });

                $(document).on("click", ".removeButton", function() {
                    $(this).parent().remove();
                });
            });
        </script>
    @endsection
