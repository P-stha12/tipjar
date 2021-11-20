<div class="single-campaign-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="single-campaign-title">{{$campaign->title}}</h1>
            </div>
        </div>
    </div>

    <div class="single-campaign-menu">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @php
                    $backers_count = $campaign->total_payments;
                    $updates_count = $campaign->updates->count();
                    $faqs_count = $campaign->faqs->count();
                    @endphp
         
                </div>
            </div>
        </div>
    </div>
</div>