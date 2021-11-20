<footer>
    <div class="container footer-top">

        <div class="row">

            <div class="col-md-3">
                <div class="footer-about">
                    <h4 class="footer-widget-title">@lang('app.about_us') </h4>
                    <div class="clearfix"></div>
                    {!! nl2br(get_option('footer_about_us')) !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="footer-widget">
                    <h4 class="footer-widget-title">@lang('app.contact_info') </h4>
                    <ul class="contact-info">
                        {!! get_option('footer_address') !!}
                    </ul>
                </div>
            </div>

            <div class="col-md-3">
                <div class="footer-widget">
                    <h4 class="footer-widget-title">@lang('app.campaigns') </h4>
                    <ul class="contact-info">
                        <li><a href="{{route('start_campaign')}}">@lang('app.start_a_campaign')</a> </li>
                        <li><a href="{{route('browse_categories')}}">@lang('app.discover_campaign')</a> </li>
                        <li><a href="{{route('checkout')}}">@lang('app.checkout')</a> </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3">
                <div class="footer-widget">
                    <h4 class="footer-widget-title">@lang('app.about_us') </h4>
                    <ul class="contact-info">
                        <li><a href="{{route('home')}}">@lang('app.home')</a> </li>
                        <?php
                        $show_in_footer_menu = \App\Post::whereStatus('1')->where('show_in_footer_menu', 1)->get();
                        ?>
                        @if($show_in_footer_menu->count() > 0)
                            @foreach($show_in_footer_menu as $page)
                                <li><a href="{{ route('single_page', $page->slug) }}">{{ $page->title }} </a></li>
                            @endforeach
                        @endif
                        <li><a href="{{route('contact_us')}}"> @lang('app.contact_us')</a></li>

                    </ul>
                </div>
            </div>

        </div><!-- #row -->
    </div>


    <div class="container footer-bottom">
        <div class="row">
            <div class="col-md-12">
                <p class="footer-copyright"> {!! get_text_tpl(get_option('copyright_text')) !!} </p>
            </div>
        </div>
    </div>

</footer>

<!-- Scripts -->
<script src="{{ asset('assets/js/jquery-1.11.2.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
{{--<script src="{{ asset('assets/js/masonry.pkgd.min.js') }}"></script>--}}
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

<!-- Conditional page load script -->
@if(request()->segment(1) === 'dashboard')
    <script src="{{ asset('assets/plugins/metisMenu/dist/metisMenu.min.js') }}"></script>
    <script>
        $(function() {
            $('#side-menu').metisMenu();
        });
    </script>
@endif

{{--<script src="{{ asset('assets/js/main.js') }}"></script>--}}

<script>
    var toastr_options = {closeButton : true};


    //Cookie Notice

    $('.cookie-ok-btn').click(function(e){
        e.preventDefault();
        var element = $(this);
        $.ajax({
            type : 'post',
            url : '{{route('cookie_accept')}}',
            data: {cookie_accept: true, _token : '{{csrf_token()}}'},
            success: function(data){
                if (data.accept_cookie){
                    element.closest('.cookie-notice').slideUp();
                }
            }
        });
    });

</script>
<script>
   /* $('.box-campaign-lists').masonry({
        itemSelector : '.box-campaign-item'
    });*/
</script>
<script>
  window.watsonAssistantChatOptions = {
    integrationID: "24c99d2b-403d-4bfd-b9fc-c7923a91e9c8", // The ID of this integration.
    region: "us-south", // The region your integration is hosted in.
    serviceInstanceID: "6954f33d-db37-4d2d-9bb9-ba0f16d0af14", // The ID of your service instance.
    onLoad: function(instance) { instance.render(); }
  };
  setTimeout(function(){
    const t=document.createElement('script');
    t.src="https://web-chat.global.assistant.watson.appdomain.cloud/versions/" + (window.watsonAssistantChatOptions.clientVersion || 'latest') + "/WatsonAssistantChatEntry.js";
    document.head.appendChild(t);
  });
</script>
@yield('page-js')

@if(get_option('additional_js') && get_option('additional_js') !== 'additional_js')
{!! get_option('additional_js') !!}
@endif

</body>
</html>
