<?php
/**
 * @var \Models\HomeFields $data
 */
?>
@extends('layouts.mainLayout')
@section('content')
    <div class="w-full relative">
        <div class="swiper vertical-slide-carousel swiper-container relative h-dvh">
            <div class="swiper-wrapper">
                @foreach($data as $key => $slide)

                    <div class="swiper-slide">
                        <div class="bg-indigo-50 rounded-2xl h-dvh flex justify-center items-center">
                            <span class="text-3xl font-semibold text-indigo-600">{{$data->titolo_1}}</span>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="swiper-pagination !right-10 !left-full !top-1/3 !translate-y-8"></div>
        </div>
    </div>
@stop