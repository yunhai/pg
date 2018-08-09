<div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modal_id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="height: 100%;">
        <div class="modal-content" style="height: auto;">
            <div class="modal-header">
                <button type="button" class="close mr-auto" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">閉じる</span>
                </button>
                <span class="modal-title mr-auto text-white">ソース確認</span>
            </div>
            @if (!empty($resources))
            <div class="modal-body">
                素材ダウンロード
                <a href="{{ route('lesson_detail.resource.download', compact('lesson_id', 'lesson_detail_id')) }}" class="btn btn-sm btn-download ml-5 btn--resource" role="button" aria-pressed="true">素材ダウンロードする</a>
                <hr style="border-color: #837f80;" class="mb-0">
            </div>
            @endif
            @if ($content)
            <ul class="nav nav-tabs border-bottom-0" id="myTabSource" role="tablist">
            @foreach($content as $item)
                <li class="nav-item mb-0">
                    <a class="nav-link @if ($loop->first) active @endif" id="source-{{ $item['id'] }}-tab" data-toggle="tab" href="#{{ $item['id'] }}" role="tab" aria-controls="home" aria-selected="true">{{ $item['filename'] }}</a>
                </li>
            @endforeach
            </ul>
            <div class="tab-content" id="myTabSourceContent">
                @foreach($content as $item)
                    <div class="tab-pane fade show @if ($loop->first) active @endif" id="{{ $item['id'] }}" role="tabpanel" aria-labelledby="source-{{ $item['id'] }}-tab">
                        <div class="modal-body" style="height: 480px;">
                            <div class='ace__item'>
                                <div class='ace__item--body' data-id='ace_edit_{{ $item['id'] }}' data-language='{{ $item['language'] }}'>
                                    <div id='ace_edit_{{ $item['id'] }}' class='ace__item--editor'>
                                        {!! $item['content'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
			@else
				<p class="text-center">ソースコードはありません</p>
            @endif
        </div>
    </div>
</div>