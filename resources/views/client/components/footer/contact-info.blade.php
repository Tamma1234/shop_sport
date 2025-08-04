<div class="col-xl-3 col-sm-6 mb_30 mb-xl-0">
    <div class="footer-col-block">
        <p class="footer-heading footer-heading-mobile">Contact us</p>
        <div class="tf-collapse-content">
            <ul class="footer-contact">
                <li>
                    <i class="icon icon-map-pin"></i>
                    <span class="br-line"></span>
                    <a href="https://www.google.com/maps?q={{ urlencode($settings['shop_address'] ?? '123 Đường ABC, Quận XYZ, TP.HCM') }}" target="_blank"
                        class="h6 link">
                        {{ $settings['shop_address'] ?? '123 Đường ABC, Quận XYZ, TP.HCM' }}
                    </a>
                </li>
                <li>
                    <i class="icon icon-phone"></i>
                    <span class="br-line"></span>
                    <a href="tel:{{ $settings['shop_phone'] ?? '0123 456 789' }}" class="h6 link">{{ $settings['shop_phone'] ?? '0123 456 789' }}</a>
                </li>
                <li>
                    <i class="icon icon-envelope-simple"></i>
                    <span class="br-line"></span>
                    <a href="mailto:{{ $settings['shop_email'] ?? 'info@shopsport.com' }}" class="h6 link">{{ $settings['shop_email'] ?? 'info@shopsport.com' }}</a>
                </li>
            </ul>
            <div class="social-wrap">
                <ul class="tf-social-icon">
                    @if(isset($settings['shop_facebook']) && $settings['shop_facebook'])
                    <li>
                        <a href="{{ $settings['shop_facebook'] }}" target="_blank" class="social-facebook">
                            <span class="icon"><i class="icon-fb"></i></span>
                        </a>
                    </li>
                    @endif
                    @if(isset($settings['shop_instagram']) && $settings['shop_instagram'])
                    <li>
                        <a href="{{ $settings['shop_instagram'] }}" target="_blank" class="social-instagram">
                            <span class="icon"><i class="icon-instagram-logo"></i></span>
                        </a>
                    </li>
                    @endif
                    @if(isset($settings['shop_website']) && $settings['shop_website'])
                    <li>
                        <a href="{{ $settings['shop_website'] }}" target="_blank" class="social-website">
                            <span class="icon"><i class="icon-globe"></i></span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div> 