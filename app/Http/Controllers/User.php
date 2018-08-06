<?php

namespace App\Http\Controllers;

use App\Http\Service\Payment\StripeService;
use App\Http\Service\UtmTracking\UtmTrackingService;
use App\Http\Requests\User\PostChangePassword as PostChangePasswordRequest;
use App\Models\User\User as UserModel;

use Auth;
use Illuminate\Http\Request;

class User extends Base
{
    public function __construct(
        UserModel $user_model
    ) {
        $this->model = $user_model;
    }

    public function getUpgrade()
    {
        if (Auth::user()->grade == USER_GRADE_DIAMOND) {
            return redirect()->route('mypage');
        }

        return $this->render('user.upgrade');
    }

    public function postUpgrade(Request $request)
    {
        $user = Auth::user()->toArray();

        if ($user['grade'] == USER_GRADE_DIAMOND) {
            return redirect()->route('mypage');
        }

        $user_id = $user['id'];

        $utm = $request->get('utm');
        if ($utm) {
            $this->saveUtm($utm, $user_id);
        }
        $input = $request->all();
        $token = $input['stripeToken'];

        $error = [];
        $payment_service = new StripeService();
        $flag = $payment_service->charge($user_id, $token, $error);

        if ($flag) {
            return redirect()->back()->with('success', true);
        }

        return redirect()->back()->with('error', $error);
    }

    private function saveUtm(array $utm, int $user_id)
    {
        $service = new UtmTrackingService();
        $service->save($utm, $user_id);

        return true;
    }

    public function getDowngrade()
    {
        if (Auth::user()->grade == USER_GRADE_NORMAL) {
            return redirect()->route('mypage');
        }

        $user_id = Auth::user()->id;
        $payment_service = new StripeService();
        $flag = $payment_service->cancel($user_id);

        if ($flag) {
            $this->model->updateGrade($user_id, USER_GRADE_NORMAL);
            return redirect()->back()->with('success', true);
        }

        return redirect()->back()->with('error', $error);
    }

    public function getChangePassword()
    {
        if (Auth::user()->provider) {
            return redirect()->route('mypage');
        }
        return view('user.change_password');
    }

    public function postChangePassword(PostChangePasswordRequest $request)
    {
        $input = $request->all();

        $user = Auth::user();
        $user->password = bcrypt($input['new_password']);
        $user->save();

        return redirect()->back()->with('success', '更新しました');
    }
}
