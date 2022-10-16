@extends('layouts.student-layout')

@section('space-work')
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="color: green !important;">Paid Exams</h2>
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
                        Paid Exam Lists
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
                                                <td style="display: none;">{{ $exam->id }}</td>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $exam->exam_name }}</td>
                                                <td>{{ $exam->subjects[0]['subject'] }}</td>
                                                <td>{{ $exam->date }}</td>
                                                <td>{{ $exam->time }} Hrs</td>
                                                <td>{{ $exam->attempt }} Time</td>
                                                <td>{{ $exam->attempt_counter }} Time</td>
                                                <td>
                                                    <b><a href="#" style="color: red;" class="buyNow"
                                                            data-id="{{ $exam->id }}" data-prices="{{ $exam->prices }}"
                                                            data-toggle="modal" data-target="#buyModal">BUY NOW</a></b>
                                                    {{-- <a href="#" data-code="{{ $exam->entrance_id }}" class="copy"><i
                                                            class="fa fa-copy"></i></a> --}}
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


                            <!-- Delete Q&A Modal -->
                            <div class="modal fade" id="buyModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form id="buyForm">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Buy Exam</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <select name="price" id="price" class="w-100" required>
                                                </select>
                                                <input type="hidden" name="exam_id" id="exam_id">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-warning buyNowButton">Buy Now</button>
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


                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
        <script>
            var isInr = false;
            $(document).ready(function() {

                $('.buyNow').click(function() {
                    var price = JSON.parse($(this).attr('data-prices'));

                    var html = '';
                    html += `
                    <option value="">Select Currency(Price)</option>
                        <option value="` + price.INR + `">INR ` + price.INR + `</option>
                        <option value="` + price.USD + `">USD ` + price.USD + `</option>
                    `;

                    $('#price').html(html);

                    $("#exam_id").val($(this).attr('data-id'));
                });


                //Payment Method Check
                $('#price').change(function() {
                    var text = $('#price option:selected').text();

                    if (text.includes('INR')) {
                        isInr = true;
                    } else {
                        isInr = false;
                    }
                });


                //Order Creation
                $("#buyForm").submit(function(e) {
                    e.preventDefault();

                    $('.buyNowButton').text('Please wait...');

                    var formData = $(this).serialize();
                    var price = $('#price').val();
                    var exam_id = $('#exam_id').val();

                    if (isInr == true) {
                        //INR Currency
                        $.ajax({
                            url: "{{ route('paymentInr') }}",
                            type: "POST",
                            data: formData,
                            success: function(response) {
                                // console.log(response);
                                if (response.success == true) {

                                    var options = {
                                        "key": "{{ env('PAYMENT_KEY') }}",
                                        "currency": "INR",
                                        "name": "{{ auth()->user()->name }}",
                                        "description": "OES Transaction",
                                        "image": "https://dummyimage.com/600x400/00e817/000000",
                                        "order_id": response.order_id,
                                        "handler": function(response) {
                                            var paymentData = {
                                                exam_id: exam_id,
                                                razorpay_payment_id: response
                                                    .razorpay_payment_id,
                                                razorpay_order_id: response
                                                    .razorpay_order_id,
                                                razorpay_signature: response
                                                    .razorpay_signature
                                            };
                                            //Verify Order
                                            $.ajax({
                                                url: "{{ route('verifyPayment') }}",
                                                type: "GET",
                                                data: paymentData,
                                                success: function(response) {
                                                    alert(response.msg);
                                                    location.reload();
                                                }
                                            });

                                        },
                                        "prefill": {
                                            "name": "{{ auth()->user()->name }}",
                                            "email": "{{ auth()->user()->email }}",
                                            "contact": "9547614783"
                                        },
                                        "notes": {
                                            "address": "{{ auth()->user()->email }}"
                                        },
                                        "theme": {
                                            "color": "#3399cc"
                                        }
                                    };
                                    var rzp1 = new Razorpay(options);
                                    rzp1.on('payment.failed', function(response) {
                                        alert(response.error.code);
                                        alert(response.error.description);
                                        alert(response.error.source);
                                        alert(response.error.step);
                                        alert(response.error.reason);
                                        alert(response.error.metadata.order_id);
                                        alert(response.error.metadata.payment_id);
                                    });
                                    rzp1.open();
                                } else {
                                    alert(response.msg);
                                }
                            }
                        });

                    } else {
                        //USD Currency

                    }

                });


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
