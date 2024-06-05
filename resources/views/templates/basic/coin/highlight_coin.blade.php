@php

    $highLigtedCoins = App\Models\Currency::active()
        ->crypto()
        ->where('highlighted_coin', Status::YES)
        ->with('marketData')
        ->rankOrdering()
        ->take(4)
        ->get();
@endphp
<div class="market-overview-card">
    <div class="market-overview-card__header">
        <h6 class="mb-2">@lang('Highlight Coin')</h6>
    </div>
    <div class="market-overview-card__list">
        @forelse ($highLigtedCoins as $highLigtedCoin)
            <div class="market-overview-card__item">
                <span class="coin-name">
                    <img src="{{ @$highLigtedCoin->image_url }}">
                    {{ @$highLigtedCoin->symbol }}
                </span>
                <span class="coin-text">
                    <span class="market-price-symbol-{{@$highLigtedCoin->merketData->id}} {{ @$highLigtedCoin->merketData->html_classes->price_change }}">
                        {{ $general->cur_sym }}
                    </span><span class="market-price-{{@$highLigtedCoin->merketData->id}} {{ @$highLigtedCoin->merketData->html_classes->price_change }}">
                        {{ showAmount(@$highLigtedCoin->marketData->price) }}
                    </span>
                </span>
                <span class="coin-percentage">
                    <span
                        class="market-percent-change-1h-{{ @$highLigtedCoin->marketData->id }} {{ @$highLigtedCoin->html_classes->percent_change_1h }}">
                        {{ getAmount(@$highLigtedCoin->marketData->percent_change_1h) }}%
                    </span>
                </span>
            </div>
        @empty
            <div class="empty-thumb text-center">
                <img src="{{ asset('assets/images/extra_images/empty.png') }}" />
                <p class="fs-14">@lang('No coin found')</p>
            </div>
        @endforelse
    </div>
</div>
