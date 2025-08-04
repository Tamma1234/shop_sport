<div class="col-xl-4 col-sm-6">
    <div class="footer-col-block">
        <p class="footer-heading footer-heading-mobile">Kết nối với chúng tôi</p>
        <div class="tf-collapse-content">
            <div class="footer-newsletter">
                <p class="h6 caption">
                    Theo dõi chúng tôi để nhận thông tin mới nhất về sản phẩm và khuyến mãi.
                </p>
                
                <!-- Facebook Fanpage Section -->
                <div class="social-connect mb-4">
                    <!-- Fanpage Preview -->
                    <div class="fanpage-preview mb-3">
                        <a href="{{ $settings['shop_facebook'] ?? '#' }}" target="_blank" class="fanpage-link">
                            <div class="fanpage-card">
                                <div class="fanpage-cover">
                                    <div class="fanpage-cover-placeholder">
                                        <i class="icon-fb" style="font-size: 2rem; color: white;"></i>
                                    </div>
                                </div>
                                <div class="fanpage-info p-3 bg-white rounded-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="fanpage-avatar me-3">
                                            <div class="fanpage-avatar-placeholder">
                                                <i class="icon-fb" style="font-size: 1.2rem; color: white;"></i>
                                            </div>
                                        </div>
                                        <div class="fanpage-details">
                                            <h6 class="mb-1 fw-bold">{{ $settings['shop_name'] ?? 'Shop Sport' }}</h6>
                                            <small class="text-muted">Fanpage Facebook</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Follow Button -->
                    <a href="{{ $settings['shop_facebook'] ?? '#' }}" target="_blank" 
                       class="btn btn-primary d-flex align-items-center justify-content-center w-100">
                        <i class="icon-fb me-2"></i>
                        Theo dõi Fanpage Facebook
                    </a>
                </div>

      
            </div>
        </div>
    </div>
</div> 