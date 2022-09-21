@extends('layouts.student-layout')

@section('space-work')
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: green !important;">Student Dashboard</h2>
                    <h5>Welcome <b class="text-primary">{{ Auth::user()->name }}</b> , Love to see you back. </h5>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />

            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSubjectModal">
                Add Subject
            </button> --}}


            <div class="col-md-10">

                <div class="panel panel-default">

                    <div class="panel-heading">
                        Context Classes
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Exam Name</th>
                                        <th>Subject Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Total Attempt</th>
                                        <th>Available Attempt</th>
                                        <th>Copy Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($exams) > 0)
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($exams as $exam)
                                            <tr class="success">
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $exam->exam_name }}</td>
                                                <td>{{ $exam->subjects[0]['subject'] }}</td>
                                                <td>{{ $exam->date }}</td>
                                                <td>{{ $exam->time }} Hrs</td>
                                                <td>{{ $exam->attempt }} Time</td>
                                                <td>{{ 'null' }}</td>
                                                <td>
                                                    <a href="#" data-code="{{ $exam->entrance_id }}" class="copy"><i
                                                            class="fa fa-copy"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="info">
                                            <td colspan="8">Exams Not Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--  end  Context Classes  -->
                {{-- </div> --}}


                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
        <script>
            $(document).ready(function() {
                $('.copy').click(function() {
                    $(this).parent().prepend('<span class="copied_text">copied</span>');

                    var code = $(this).attr('data-code');
                    var url = "{{ URL::to('/') }}/exam/" + code;

                    var temp = $("<input>");
                    $("body").append(temp);
                    temp.val(url).select();
                    document.execCommand("copy");
                    temp.remove();

                    setTimeout(() => {
                        $('.copied_text').remove();
                    }, 1000);
                });
            });
        </script>
    @endsection
