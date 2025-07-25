<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    /**
     * Handle newsletter subscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.max' => 'Địa chỉ email không được quá 255 ký tự.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $email = $request->input('email');

        // Check if email already exists
        $existingSubscription = Newsletter::where('email', $email)->first();

        if ($existingSubscription) {
            if ($existingSubscription->status == 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email này đã được đăng ký nhận bản tin rồi!',
                ], 409);
            } else {
                // Reactivate if previously unsubscribed
                $existingSubscription->update(['status' => 1]);
                return response()->json([
                    'success' => true,
                    'message' => 'Đăng ký thành công! Bạn sẽ nhận được thông tin tuyển sinh mới nhất từ LT365.',
                ]);
            }
        }

        // Create new subscription
        Newsletter::create([
            'email' => $email,
            'status' => 1, // 1 for active
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký thành công! Bạn sẽ nhận được thông tin tuyển sinh mới nhất từ LT365.',
        ]);
    }

    /**
     * Handle newsletter unsubscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unsubscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Địa chỉ email không hợp lệ.',
            ], 422);
        }

        $email = $request->input('email');
        $subscription = Newsletter::where('email', $email)->first();

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Email này chưa đăng ký nhận bản tin.',
            ], 404);
        }

        $subscription->update(['status' => 0]);

        return response()->json([
            'success' => true,
            'message' => 'Đã hủy đăng ký thành công.',
        ]);
    }
}
