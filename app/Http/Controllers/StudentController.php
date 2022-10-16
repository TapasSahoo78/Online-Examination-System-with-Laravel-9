<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\QnaExam;
use App\Models\ExamAttempt;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamPayment;

use Razorpay\Api\Api;

class StudentController extends Controller
{
    public function paidExamDashboard()
    {
        $exams = Exam::where('plan', 1)->with('subjects')->orderBy('date', 'DESC')->get();
        //die($exams);
        return view('student.paid_exams', compact('exams'));
    }

    public function paymentInr(Request $request)
    {
        try {
            $api = new Api(env('PAYMENT_KEY'), env('PAYMENT_SECRET'));

            $orderData = [
                'receipt'         => 'rcptid_11',
                'amount'          => $request->price . '00',
                'currency'        => 'INR'
            ];

            $razorpayOrder = $api->order->create($orderData);

            return response()->json(['success' => true, 'order_id' => $razorpayOrder['id']]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function verifyPayment(Request $request)
    {
        try {
            $api = new Api(env('PAYMENT_KEY'), env('PAYMENT_SECRET'));

            $attributes = array(
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            );

            $api->utility->verifyPaymentSignature($attributes);

            ExamPayment::insert([
                'exam_id' => $request->exam_id,
                'user_id' => auth()->user()->id,
                'payment_details' => json_encode($attributes),
            ]);

            return response()->json(['success' => true, 'msg' => 'Your payment was successful,Your Payment ID' . $request->razorpay_payment_id]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Your payment failed']);
        }
    }
}
