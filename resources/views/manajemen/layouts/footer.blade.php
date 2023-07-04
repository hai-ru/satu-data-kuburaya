<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                {{ now()->year }} © {{ isset($hotelInfo) ? $hotelInfo->nm_hotel : config('app.name') }} - v{{ config('app.version') }}
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    <span class="d-none">
                        Design & Develop by Rajunda
                    </span>
                </div>
            </div>
        </div>
    </div>
</footer>