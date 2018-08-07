@extends('layout.master')
@section('title', 'マイページ')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('mypage'))
<div id="content">
    <div class="box ttlCommon mb-0 px-5">マイページ</div>
    <div class="box-mypage px-5">
        <div class="row">
            <div class="mar_t20 col-lg-4 col-md-4 col-sm-12">
                <div class="card card-mypage">
                    <div class="card-header">ステータス</div>
                    <div class="card card-body justify-content-center text-center border-0">
                        <h4>
                            <p class="card-text">
                                @normal_user
                                    無料会員
                                @else
                                    月額会員
                                @endnormal_user
                            </p>
                        </h4>
                        @normal_user
                            <p class="card-text">
                                <a href="{{ route('user.upgrade') }}">
                                    <span class="mr-2"><img class="img-fluid" src="img/charge_diamond.png" width="15px;"></span>月額会員になる
                                </a>
                            </p>
                            <p class="card-text">月額会員になると、全ての動画見放題となります！月額\{{ constant('MEMBERSHIP_FEE') }}円（税別）</p>
                        @endnormal_user
                    </div>
                </div>
            </div>
            <div class="mar_t20 col-lg-4 col-md-4 col-sm-12">
                <div class="card card-mypage">
                    <div class="card-header">次回課金日/値段</div>
                    <div class="card card-body justify-content-center text-center border-0">
                        @normal_user
                            <p class="card-text">
                                <a href="{{ route('user.upgrade') }}">
                                    <span class="mr-2"><img class="img-fluid" src="img/charge_diamond.png" width="15px;"></span>月額会員になる
                                </a>
                            </p>
                            <p class="card-text">月額会員になると、全ての動画見放題となります！月額\{{ constant('MEMBERSHIP_FEE') }}円（税別）</p>
                        @else
                        <h4><p class="card-text">{{ $next_pay_date }}</p></h4>
                        <h4><p class="card-text">\{{ constant('MEMBERSHIP_FEE') }}円</p></h4>
                        <p class="card-text">
                            <a href="javascript:;"  data-toggle="modal" data-target=".user-downgrade-modal-sm">【月額会員を止める】</a>
                        </p>
                        @endnormal_user
                    </div>
                </div>
            </div>
            <div class="mar_t20 col-lg-4 col-md-4 col-sm-12">
                <div class="card card-mypage">
                    <div class="card-header">お知らせ</div>
                    <div class="card-body text-center">
                        @foreach($notifications as $notification)
                        <p class="card-text text-left mypage--notification">
                            <a href="javascript:;" title='{{ $notification['title'] }}' data-toggle="modal" data-target="#model--notification_{{ $notification['id'] }}">
                                [{{ $notification['post_date_short'] }}]　{{ $notification['title'] }}
                            </a>
                        </p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="mar_t20 mar_b20 col-lg-4 col-md-4 col-sm-12">
                <div class="card card-mypage">
                    <div class="card-header">総合完了数</div>
                    <div class="card card-body justify-content-center text-center border-0">
                        <h4><p class="card-text text-center">{{ $stat['closed_lesson_detail_count'] }}</p></h4>
                    </div>
                </div>
            </div>
            <div class="mar_t20 mar_b20 col-lg-4 col-md-4 col-sm-12">
                <div class="card card-mypage">
                    <div class="card-header">学習日数</div>
                    <div class="card card-body justify-content-center text-center border-0">
                        <h4><p class="card-text text-center">{{ $stat['date_count'] }}</p></h4>
                    </div>
                </div>
            </div>
            <div class="mar_t20 mar_b20 col-lg-4 col-md-4 col-sm-12">
                <div class="card card-mypage">
                    <div class="card-header">視聴時間</div>
                    <div class="card card-body justify-content-center text-center border-0">
                        <h4><p class="card-text">{{ $stat['duration'] }}</p></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade user-downgrade-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content rounded-0" style="height: auto;">
			<div class="modal-body">
				<p class="mb-0">月額会員をストップしますか？</p>
			</div>
			<div class="modal-footer" style="padding: 0;">
				<a href="javascript:;" class="btn font_12" data-dismiss="modal" aria-label="Close">閉じる</a>
				<a href="{{ route('user.downgrade') }}" class="btn font_12">OK</a>
			</div>
		</div>
	</div>
</div>
@foreach($notifications as $notification)
    @include('component.modal.info', ['modal_id' => 'model--notification_' . $notification['id'], 'target' => $notification])
@endforeach
@stop
