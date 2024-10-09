<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PayController extends Controller
{
    public function index()
    {
        return view('user.cart')->with('error', 'Vui lòng chọn sản phẩm thanh toán ở giỏ hàng');
    }

    public function store(Request $request)
    {
        $products = json_decode(request()->products, true);
        $sum = 0;
        if (empty($products)) {
            return redirect()->back()->with('error', 'Vui lòng chọn sản phẩm thanh toán ở giỏ hàng');
        }
        foreach ($products as $value) {
            $sum += floatval($value['price_product']);
        }
        $render = [
            'products' => $products,
            'sum_total' => number_format($sum, 0, ',', '.'),
        ];

        return view('user.pay', $render);
    }

    public function create(Request $request, $information_order)
    {
        // Lấy thông tin config:
        $vnp_TmnCode = 'EJF9QZVP'; // Mã website của bạn tại VNPAY
        $vnp_HashSecret = env('VNP_HASHSECRET'); // Chuỗi bí mật
        $vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'; // URL thanh toán của VNPAY
        $vnp_ReturnUrl = route('getDataBanking'); // URL nhận kết quả trả về

        // Lấy thông tin từ đơn hàng phục vụ thanh toán
        // Dưới đây là thông tin giả định, bạn có thể lấy thông tin đơn hàng của bạn  để thay thế
        $order = (object) [
            'code' => $information_order['order_code'],  // Mã đơn hàng
            'total' => $request->amount, // Số tiền cần thanh toán (VND)
            'bankCode' => 'NCB',   // Mã ngân hàng
            'type' => 'billpayment', // Loại đơn hàng
            'info' => 'Thanh toán đơn hàng '.$information_order['order_code'], // Thông tin đơn hàng
        ];

        // Thông tin đơn hàng, thanh toán
        $vnp_TxnRef = $order->code;
        $vnp_OrderInfo = $order->info;
        $vnp_OrderType = $order->type;
        $vnp_Amount = $order->total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = $order->bankCode;  // Mã ngân hàng
        $vnp_IpAddr = $request->ip(); // Địa chỉ IP

        // Tạo input data để gửi sang VNPay server
        $inputData = [
            'vnp_Version' => '2.1.0',
            'vnp_TmnCode' => $vnp_TmnCode,
            'vnp_Amount' => $vnp_Amount,
            'vnp_Command' => 'pay',
            'vnp_CreateDate' => date('YmdHis'),
            'vnp_CurrCode' => 'VND',
            'vnp_IpAddr' => $vnp_IpAddr,
            'vnp_Locale' => $vnp_Locale,
            'vnp_OrderInfo' => $vnp_OrderInfo,
            'vnp_OrderType' => $vnp_OrderType,
            'vnp_ReturnUrl' => $vnp_ReturnUrl,
            'vnp_TxnRef' => $vnp_TxnRef,
        ];
        // Kiểm tra nếu mã ngân hàng đã được thiết lập và không rỗng
        if (isset($vnp_BankCode) && $vnp_BankCode != '') {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        // Kiểm tra nếu thông tin tỉnh/thành phố hóa đơn đã được thiết lập và không rỗng
        if (isset($vnp_Bill_State) && $vnp_Bill_State != '') {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State; // Gán thông tin tỉnh/thành phố hóa đơn vào mảng dữ liệu input
        }

        // Sắp xếp mảng dữ liệu input theo thứ tự bảng chữ cái của key
        ksort($inputData);

        $query = ''; // Biến lưu trữ chuỗi truy vấn (query string)
        $i = 0; // Biến đếm để kiểm tra lần đầu tiên
        $hashdata = ''; // Biến lưu trữ dữ liệu để tạo mã băm (hash data)

        // Duyệt qua từng phần tử trong mảng dữ liệu input
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                // Nếu không phải lần đầu tiên, thêm ký tự '&' trước mỗi cặp key=value
                $hashdata .= '&'.urlencode($key).'='.urlencode($value);
            } else {
                // Nếu là lần đầu tiên, không thêm ký tự '&'
                $hashdata .= urlencode($key).'='.urlencode($value);
                $i = 1; // Đánh dấu đã qua lần đầu tiên
            }
            // Xây dựng chuỗi truy vấn
            $query .= urlencode($key).'='.urlencode($value).'&';
        }

        // Gán chuỗi truy vấn vào URL của VNPay
        $vnp_Url = $vnp_Url.'?'.$query;

        // Kiểm tra nếu chuỗi bí mật hash secret đã được thiết lập
        if (isset($vnp_HashSecret)) {
            // Tạo mã băm bảo mật (Secure Hash) bằng cách sử dụng thuật toán SHA-512 với hash secret
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            // Thêm mã băm bảo mật vào URL để đảm bảo tính toàn vẹn của dữ liệu
            $vnp_Url .= 'vnp_SecureHash='.$vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function return(Request $request)
    {
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = $request->all();
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = '';
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key).'='.urlencode($value).'&';
        }
        $hashData = rtrim($hashData, '&');
        $secureHash = hash_hmac('sha512', $hashData, env('VNP_HASHSECRET'));
        if ($secureHash === $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                try {
                    OrderModel::query()->create(session('order'));
                } catch (\Throwable $th) {
                    return redirect(route('user.home'))->with('error', 'Lỗi hệ thống: Vui lòng liên hệ admin để xử lí');
                }
                session()->put('cart', session('bill'));

                return redirect(route('user.home'))->with('success', 'Đơn hàng được đặt thành công và chờ người bán chuẩn bị');
            } else {
                return redirect(route('user.home'))->with('error', 'Thanh toán không thành công');
            }
        } else {

            return redirect(route('user.home'))->with('error', 'Đặt hàng thất bại');
        }
    }

    public function order(Request $request)
    {
        $cart = session()->get('cart', []);
        $ids = json_decode(request()->query('id_order'), true);
        foreach ($cart as $key => $product) {
            $id_product = $key;
            foreach ($ids as $key_ids => $id) {
                if ($product['product_code'] == $id['id']) {
                    $ids[$key_ids]['price_product'] = $product['price'] * $id['quantity'];
                    unset($cart[$id_product]);
                }
            }
        }
        $date = Carbon::now();
        $order_code = 'FSCO'.$date->year.$date->month.$date->day.$date->hour.$date->minute.$date->second.rand(0, 100);
        //Nhập liệu đơn hàng
        $information_order = [
            'order_code' => $order_code, //Fashion code order
            'customer_id' => Auth::id(),
            'recipient_name' => $request->query('recipient_name'),
            'number_phone' => $request->query('number_phone'),
            'address' => $request->query('address'),
            'order_information' => $request->query('id_order'),
            'status' => '00',
            'expired_at' => Carbon::now()->toDateTime(),
        ];
        //kiểm tra số lượng tồn kho của đơn hàng nếu số lượng hết thì báo error và kèm LH: với người bán
        if ($request->query('method_payment') == 'homebank') {
            try {
                OrderModel::query()->create($information_order);
            } catch (\Throwable $e) {
                Log::error('Có lỗi xảy ra', ['error' => $e->getMessage()]);

                return redirect(route('user.home'))->with('error', 'Đơn hàng đặt thất bại');
            }
            session()->put('cart', $cart);

            return redirect(route('user.home'))->with('success', 'Đơn hàng được đặt thành công và chờ người bán xét duyệt');
        } else {
            $information_order['status'] = '01';
            session()->flash('order', $information_order);
            session()->flash('bill', $cart);

            return $this->create($request, $information_order);
        }
    }
}
