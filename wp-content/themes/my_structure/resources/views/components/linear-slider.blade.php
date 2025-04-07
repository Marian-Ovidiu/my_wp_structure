<div class="swiper-container logo-marquee w-full my-4">
    <div class="swiper-wrapper sw-wrapper-linear">
        @if(isset($linearSlider) && !empty($linearSlider))
            @php
                $logos = [
                    [
                        'logo' => $linearSlider->logo_1,
                        'title' => $linearSlider->titolo_logo_1 ?? null,
                    ],
                    [
                        'logo' => $linearSlider->logo_2,
                        'title' => $linearSlider->titolo_logo_2 ?? null,
                    ],
                    [
                        'logo' => $linearSlider->logo_3,
                        'title' => $linearSlider->titolo_logo_3 ?? null,
                    ],
                ];
            @endphp

            @foreach($logos as $item)
                @if(isset($item['logo']['url']) && isset($item['logo']['title']))
                    <div class="swiper-slide flex flex-col items-center justify-center p-4">
                        <div class="text-center mb-2 custom-dark-green">
                            <p class="font-bold text-lg custom-dark-green">{{ $item['title'] }}</p>
                        </div>
                        <img src="{{ $item['logo']['url'] }}" alt="{{ $item['logo']['title'] }}" style="max-height: 80px;">
                    </div>
                @endif
            @endforeach
        @else
            <p>No logos available</p>
        @endif
    </div>
</div>

<div class="text-gray-600 text-xs text-center mt-2 mx-4">
    * La nostra presenza su questo sito non implica sponsorizzazione o contributi economici
</div>
