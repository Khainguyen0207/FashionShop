<div id="footer">
    @php
        $footer = getFooter();
    @endphp
    <h1>Giới thiệu</h1>
    <li>FashionStore tự hào mang đến những sản phẩm thời trang chất lượng cao với xu hướng mới nhất từ khắp nơi trên thế giới. Phong cách và đẳng cấp, tất cả đều có tại FashionStore.</li>
    <div class="social-networking-contact">
        <div class="social-networking">
            <h1>Mạng xã hội</h1>
            <li>FB: <a href="#">{{ $footer['social_network']['facebook'] }}</a></li>
            <li>Tiktok: <a href="#">{{ $footer['social_network']['tiktok'] }}</a></li>
            <li>IG: <a href="#">{{ $footer['social_network']['instagram'] }}</a></li>
        </div>
        <div class="contact">
            <h1>Liên hệ </h1>
            <li>Hotline: <a href="#">{{ $footer['contact']['hotline'] }}</a></li>
            <li>Email: <a href="#">{{ $footer['contact']['email'] }}</a></li>
            <li>Địa chỉ: {{ $footer['contact']['address'] }}</li>
        </div>
    </div>
    <h1>Cảm ơn</h1>
    <li>Cảm ơn quý khách đã ghé thăm và mua sắm tại FashionStore. Chúng tôi luôn nỗ lực để mang đến cho quý khách trải nghiệm mua sắm tốt nhất!</li>
    <p class="copy_right">@Bản quyền thuộc về Fashionstore</p>
</div>