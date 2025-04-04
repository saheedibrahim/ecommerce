
<div class="footer">
    <!-- Begin Footer Static Top Area -->
    <div class="footer-static-top">
        <div class="container">
            <!-- Begin Footer Shipping Area -->
            <div class="footer-shipping pt-60 pb-55 pb-xs-25">
                <div class="row">
                    <!-- Begin Li's Shipping Inner Box Area -->
                    <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                        <div class="li-shipping-inner-box">
                            <div class="shipping-icon">
                                <img src="/front/images/shipping-icon/1.png" alt="Shipping Icon">
                            </div>
                            <div class="shipping-text">
                                <h2>Free Delivery</h2>
                                <p>And free returns. See checkout for delivery dates.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Li's Shipping Inner Box Area End Here -->
                    <!-- Begin Li's Shipping Inner Box Area -->
                    <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                        <div class="li-shipping-inner-box">
                            <div class="shipping-icon">
                                <img src="/front/images/shipping-icon/2.png" alt="Shipping Icon">
                            </div>
                            <div class="shipping-text">
                                <h2>Safe Payment</h2>
                                <p>Pay with the world's most popular and secure payment methods.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Li's Shipping Inner Box Area End Here -->
                    <!-- Begin Li's Shipping Inner Box Area -->
                    <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                        <div class="li-shipping-inner-box">
                            <div class="shipping-icon">
                                <img src="/front/images/shipping-icon/3.png" alt="Shipping Icon">
                            </div>
                            <div class="shipping-text">
                                <h2>Shop with Confidence</h2>
                                <p>Our Buyer Protection covers your purchasefrom click to delivery.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Li's Shipping Inner Box Area End Here -->
                    <!-- Begin Li's Shipping Inner Box Area -->
                    <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                        <div class="li-shipping-inner-box">
                            <div class="shipping-icon">
                                <img src="/front/images/shipping-icon/4.png" alt="Shipping Icon">
                            </div>
                            <div class="shipping-text">
                                <h2>24/7 Help Center</h2>
                                <p>Have a question? Call a Specialist or chat online.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Li's Shipping Inner Box Area End Here -->
                </div>
            </div>
            <!-- Footer Shipping Area End Here -->
        </div>
    </div>
    <!-- Footer Static Top Area End Here -->
    <!-- Begin Footer Static Middle Area -->
    <div class="footer-static-middle">
        <div class="container">
            <div class="footer-logo-wrap pt-50 pb-35">
                <div class="row">
                    <!-- Begin Footer Logo Area -->
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-logo">
                            <img src="/images/site/logo/{{ get_settings()->site_logo }}" alt="Footer Logo">
                            <p class="info">{{ get_settings()->site_meta_description }}</p>
                        </div>
                        <ul class="des">
                            <li>
                                <i class="bi bi-house-door"></i>
                                <a href="http://maps.google.com/maps?q={{ urlencode(get_settings()->site_address) }}"
                                    target="_blank" class="ms-2">{{ get_settings()->site_address }}</a>
                            </li>
                            <li>
                                <span>Phone: </span>
                                <a href="#">(+123) 123 321 345</a>
                            </li>
                            <li>
                                <i class="bi bi-envelope-at"></i>
                                <a href="mailto:{{ get_settings()->site_email }}" class="ms-2">{{ get_settings()->site_email }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Footer Logo Area End Here -->
                    <!-- Begin Footer Block Area -->
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-block">
                            <h3 class="footer-block-title">Product</h3>
                            <ul>
                                <li><a href="#">Prices drop</a></li>
                                <li><a href="#">New products</a></li>
                                <li><a href="#">Best sales</a></li>
                                <li><a href="#">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Block Area End Here -->
                    <!-- Begin Footer Block Area -->
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-block">
                            <h3 class="footer-block-title">Our company</h3>
                            <ul>
                                <li><a href="#">Delivery</a></li>
                                <li><a href="#">Legal Notice</a></li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Block Area End Here -->
                    <!-- Begin Footer Block Area -->
                    {{-- <div class="col-lg-3">
                        <div class="footer-block">
                            <h3 class="footer-block-title">Follow Us</h3>
                            <ul class="social-link">
                                <li class="twitter">
                                    <a href="https://twitter.com/" data-toggle="tooltip" target="_blank" title="Twitter">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="rss">
                                    <a href="https://rss.com/" data-toggle="tooltip" target="_blank" title="RSS">
                                        <i class="fa fa-rss"></i>
                                    </a>
                                </li>
                                <li class="google-plus">
                                    <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google Plus">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <li class="facebook">
                                    <a href="https://www.facebook.com/" data-toggle="tooltip" target="_blank" title="Facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="youtube">
                                    <a href="https://www.youtube.com/" data-toggle="tooltip" target="_blank" title="Youtube">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </li>
                                <li class="instagram">
                                    <a href="https://www.instagram.com/" data-toggle="tooltip" target="_blank" title="Instagram">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Begin Footer Newsletter Area -->
                        <div class="footer-newsletter">
                            <h4>Sign up to newsletter</h4>
                            <form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="footer-subscribe-form validate" target="_blank" novalidate>
                               <div id="mc_embed_signup_scroll">
                                  <div id="mc-form" class="mc-form subscribe-form form-group" >
                                    <input id="mc-email" type="email" autocomplete="off" placeholder="Enter your email" />
                                    <button  class="btn" id="mc-submit">Subscribe</button>
                                  </div>
                               </div>
                            </form>
                        </div>
                        <!-- Footer Newsletter Area End Here -->
                    </div> --}}
                    <!-- Footer Block Area End Here -->
                    <!-- Begin Footer Block Area -->
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-block">
                            <h3 class="footer-block-title">Contact Us</h3>
                            <ul>
                                <li>
                                    <div class="footer-number">
                                        <p>Do you have any question or suggestion?</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-number">
                                        <div class="contact-number">
                                            <i class="bi bi-telephone"></i>
                                            <h6 class="text-content">Hotline 24/7 :</h6>
                                            <h5>{{ get_settings()->site_phone }}</h5>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="footer-number">
                                        <div class="contact-number">
                                            <i class="bi bi-envelope-at"></i>
                                            <h6 class="text-content">Email Address :</h6>
                                            <h5>{{ get_settings()->site_email }}</h5>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Block Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Static Middle Area End Here -->
    <!-- Begin Footer Static Bottom Area -->
    <div class="footer-static-bottom pt-55 pb-55">
        <div class="container">
            <div class="row">                
                <!-- Begin Footer Block Area -->
                <div class="col-lg-4 col-md-3 col-sm-6">
                    <div class="footer-block">
                        <h3 class="footer-block-title">Contact Us</h3>
                        <ul>
                            <li>
                                <div class="footer-number">
                                    <div class="contact-number">
                                        <i class="bi bi-telephone"></i>
                                        <h6 class="text-content">Hotline 24/7 :</h6>
                                        <h5>{{ get_settings()->site_phone }}</h5>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="footer-number">
                                    <div class="contact-number">
                                        <i class="bi bi-telephone"></i>
                                        <h6 class="text-content">Hotline 24/7 :</h6>
                                        <h5>{{ get_settings()->site_phone }}</h5>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Footer Block Area End Here -->
                <!-- Begin Footer Payment Area -->
                <div class="col-lg-4 text-center">
                    <h6>Stay Connected :</h6>
                    <a href="#">
                        <img src="/front/images/payment/1.png" alt="">
                    </a>
                </div>
                <!-- Footer Payment Area End Here -->
                <!-- Begin Footer Block Area -->
                <div class="col-lg-4 col-md-3 col-sm-6">
                    <div class="d-flex">
                        <h6 class="m-0 p-0">Stay Connected :</h6>
                        <ul class=" d-flex">
                            <li class="me-1">
                                <a href="{{ get_social_network()->facebook_url }}" target="_blank">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            </li>
                            <li class="mx-1">
                                <a href="{{ get_social_network()->twitter_url }}" target="_blank">
                                    <i class="bi bi-twitter"></i>
                                </a>
                            </li>
                            <li class="mx-1">
                                <a href="{{ get_social_network()->instagram_url }}" target="_blank">
                                    <i class="bi bi-instagram"></i>
                                </a>
                            </li>
                            <li class="mx-1">
                                <a href="{{ get_social_network()->yputube_url }}" target="_blank">
                                    <i class="bi bi-youtube"></i>
                                </a>
                            </li>
                            <li class="mx-1">
                                <a href="{{ get_social_network()->facebook_url }}" target="_blank">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            </li>
                            <li class="mx-1">
                                <a href="{{ get_social_network()->facebook_url }}" target="_blank">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Footer Block Area End Here -->
            </div>
        </div>
    </div>
    <!-- Footer Static Bottom Area End Here -->
</div>