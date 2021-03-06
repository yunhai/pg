<form action="{{ route('top.search') }}" class="@pc offset-md-2 form-inline @endpc @sp col-sm-12 @endsp top-search">
    @php
        $keyword = array_get($filter_form, 'input_value.keyword');
    @endphp
    <div class="form-group">
        <div id="pg-search-input">
            <div class="input-group col-md-12">
                <input type="text" name='keyword' class="form-control input-lg top-search--keyword j-lessonFilter" placeholder="動画検索" value="@if (!empty($keyword)) {{ $keyword }} @endif"/>
                <span class="input-group-btn">
                    <button class="btn btn-info btn-lg" type="submit">
                        検索
                    </button>
                </span>
            </div>
        </div>
    </div>
</form>
