<footer class="footer">
    <div class="container-fluid  px-5 @pc pad_t40 @endpc @sp pad_t20 @endsp pad_b40">
        <div class="row">
            <div class="col-lg-6 col-md-6 text-center footer-container-left">
                <h6 class="mar_b10" style="white-space: nowrap;">5分動画で実践的にプログラミングを習得！</h6>
                <h4 class="title-widget">
                    <a class="" href="/"><img class="img-logo" src="/img/logo_footer.png" alt="cogwheel"></a>
                </h4>
            </div>
            <div class="col-lg-3 col-md-3">
                <h6 class="title-widget">ご利用にあたって</h6>
                <hr>
                <ul class="pad_l20">
                    <li class="pb-1"><a href="{{ route('terms') }}">利用規約</a></li>
                    <li class="pb-1"><a href="{{ route('privacy') }}">プライバシーポリシー</a></li>
                    <li class="pb-1"><a href="{{ route('company') }}">運営企業情報</a></li>
                    <li><a href="{{ route('contact.contact') }}">お問い合わせ</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3">
                <h6 class="title-widget">ソーシャルメディア</h6>
                <hr>
                <ul class="pad_l20">
                    <li class="pb-1"><a href="https://twitter.com/E3POTVXDRuT5yEe" target="_blank">Twitter</a></li>
                    <li><a href="https://www.facebook.com/%E3%83%97%E3%83%AD%E3%82%B0%E3%83%A9%E3%83%9F%E3%83%B3%E3%82%B0go-562934900892573/?modal=admin_todo_tour" target="_blank">Facebook</a></li>
                </ul>
                <h6 class="title-widget">サービス</h6>
                <hr>
                <ul class="pad_l20 mar_b0">
                    <li class="pb-1"><a href="{{ route('lesson') }}">レッスン一覧（{{ $global_total_lessons }}）</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
