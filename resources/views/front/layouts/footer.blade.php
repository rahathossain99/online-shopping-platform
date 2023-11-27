<footer class="bg-dark mt-5">
    <div class="container pb-5 pt-3">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-card">
                    <h3>Get In Touch</h3>
                    <p>{{ enterpriseInfo()->street }}, {{ enterpriseInfo()->city }}, {{ enterpriseInfo()->name }} <br>
                    {{ enterpriseInfo()->email }}<br>
                    {{ enterpriseInfo()->mobile }}</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-card">
                    <h3>Important Links</h3>
                    <ul>
                        <li><a href="{{ route('front.page','about-us') }}" title="About">About</a></li>
                        <li><a href="{{ route('front.page','contact-us') }}" title="Contact Us">Contact Us</a></li>
                        <li><a href="#" title="Privacy">Privacy</a></li>
                        <li><a href="{{ route('front.page','terms-conditions') }}" title="Privacy">Terms & Conditions</a></li>
                        <li><a href="#" title="Privacy">Refund Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-card">
                    <h3>My Account</h3>
                    <ul>
                        <li><a href="{{ route('user.login') }}" title="Sell">Login</a></li>
                        <li><a href="{{ route('user.register') }}" title="Advertise">Register</a></li>
                        <li><a href="{{ route('user.myOrders') }}" title="Contact Us">My Orders</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="copy-right text-center">
                        <p>© Copyright 2022 Amazing Shop. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
