@php
    $array_alert = [
        'danger',
        'info',
        'warning',
        'success'
    ];

@endphp
@foreach($array_alert as $item)
    @if (session($item))
        <section class="content show-notification" style="min-height: 80px; padding-bottom: 0px !important;">
            <div class="box">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="callout callout-{{ $item }}">
                            <p><i class="fa fa-fw fa-exclamation-circle"></i> {{ session($item) }}</p>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </section>
    @endif
@endforeach