@extends('layouts.layout-commons')

@section('space-work')
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h5>Welcome <b class="text-primary">{{ Auth::user()->name }}</b></h5>
                    <h2 style="color: green !important;" class="text-center">{{ $exam[0]['exam_name'] }}</h2>
                    @if ($success == true)
                        @if (count($qna) > 0)
                            @php
                                $qcount = 1;
                            @endphp
                            @foreach ($qna as $data)
                                <h5>Q{{ $qcount++ }}. {{ $data['questions'][0]['question'] }}</h5>

                                @php
                                    $acount = 1;
                                @endphp
                                @foreach ($data['questions'][0]['answers'] as $answer)
                                    <p><b>{{ $acount++ }}).</b>{{ $answer['answers'] }}</p>
                                @endforeach
                                <br>
                            @endforeach
                        @else
                            <h3 style="color: red" class="text-center">Questions and Answers not Available!</h3>
                        @endif
                    @else
                        <h3 style="color: red;" class="text-center">{{ $msg }}</h3>
                    @endif
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
        <script></script>
    @endsection
