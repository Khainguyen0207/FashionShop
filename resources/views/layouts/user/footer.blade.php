<div id="footer">
    @php
        $footer = getFooter();
    @endphp
    <h1>Giới thiệu</h1>
    <li>FashionStore tự hào mang đến những sản phẩm thời trang chất lượng cao với xu hướng mới nhất từ khắp nơi trên thế giới. Phong cách và đẳng cấp, tất cả đều có tại FashionStore.</li>
    <div class="social-networking-contact">
        @if (collect($footer['social_network'])->filter(fn($value) => is_null($value))->count() == 0)
            <div class="social-networking">
                <h1>Mạng xã hội</h1>
                @if (!is_null($footer['social_network']['facebook']))
                    <li>FB: <a href="#">{{ $footer['social_network']['facebook'] }}</a></li>
                @endif
                @if (!is_null($footer['social_network']['tiktok']))
                    <li>Tiktok: <a href="#">{{ $footer['social_network']['tiktok'] }}</a></li>
                @endif
                @if (!is_null($footer['social_network']['instagram']))
                    <li>IG: <a href="#">{{ $footer['social_network']['instagram'] }}</a></li>
                @endif
            </div>
        @endif
        @if (collect($footer['contact'])->filter(fn($value) => is_null($value))->count() == 0)
            <div class="contact">
                @if (count($footer['contact']) != 0)
                    <h1>Liên hệ </h1>
                @endif
                @if (!is_null($footer['contact']['hotline']))
                    <li>Hotline: <a href="#">{{ $footer['contact']['hotline'] }}</a></li>
                @endif
                @if (!is_null($footer['contact']['email']))
                    <li>Email: <a href="#">{{ $footer['contact']['email'] }}</a></li>
                @endif
                @if (!is_null($footer['contact']['address']))
                    <li>Địa chỉ: {{ $footer['contact']['address'] }}</li>
                @endif
            </div>
        @endif
    </div>
    <h1>Cảm ơn</h1>
    <li>Cảm ơn quý khách đã ghé thăm và mua sắm tại FashionStore. Chúng tôi luôn nỗ lực để mang đến cho quý khách trải nghiệm mua sắm tốt nhất!</li>
    <p class="copy_right">@Bản quyền thuộc về Fashionstore</p>
</div>