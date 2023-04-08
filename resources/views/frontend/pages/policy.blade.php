@extends('frontend.layouts.index')
@section('title','Liên hệ')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Chính sách</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
        <h4 class="text-center mb-5">Chính sách mua hàng tại Asihon</h4>
            <h5 class="mb-3">Thông tin về sản phẩm, dịch vụ:</h5>
            <ul class="ml-5 mb-3">
                <li class="mb-2">Cung cấp các sản phẩm về thời trang và phụ kiện thời trang cho mọi lứa tuổi và theo xu thế của xã hội.</li>
                <li class="mb-2">Chất liệu chính: vải lụa, vải voan, các phụ liệu ren, phụ liệu chuyên về ngành hàng may mặc.</li>
            </ul>
            <h5 class="mb-3">Chính sách vận chuyển/ giao nhận:</h5>
            <p>Thời gian ước tính giao hàng: nội thành Sài Gòn ( 1-2 ngày ), nội thành Hà Nội ( 2-3 ngày ), ngoại thành ( 3-4 ngày ), các tỉnh thành khác ( 4 -7 ngày ). Được tính từ thời gian bắt đầu gửi hàng.</p>
            <p>- Trường hợp phát sinh chậm trễ trong việc giao hàng hoặc cung ứng dịch vụ, chúng tôi sẽ báo thông tin kịp thời cho khách hàng.</p>

            <h5 class="mb-3">Chính sách bảo hành sản phẩm/ hàng hóa:</h5>
            <p>- Asihon hỗ trợ bảo hành toàn bộ sản phẩm đối với các sản phẩm lỗi do nhà sản xuất tại toàn bộ cửa hàng trực thuộc. Ngoài ra, chúng tôi còn hỗ trợ nhận đặt may theo yêu cầu của khách hàng theo các trường hợp: nới, bóp, cắt ngắn hoặc may theo số đo phù hợp với khách hàng..</p>

            <h5 class="mb-3">Chính sách bảo vệ thông tin của khách hàng tại Ashion:</h5>
            <p>- Chúng tôi thu thập, lưu trữ và xử lý thông tin của KH cho quá trình mua hàng, cho những thông báo sau này và để cung cấp dịch vụ. Những thông tin KH cần cung cấp để chúng tôi thực hiện quá trình xử lý đơn hàng như sau: danh hiệu, tên, email, địa chỉ giao hàng, số điện thoại, chi tiết thanh toán ( thanh toán bằng thẻ, tài khoản ngân hàng )</p>
            <p>- Chúng tôi sẽ dụng thông tin mà KH đã cung cấp để xử lý đơn hàng, cung cấp dịch vụ và thông tin yêu cầu thông qua trang web và theo yêu cầu của KH. Chúng tôi sẽ chuyển tên và địa chỉ cho bên thứ ba ( Đơn vị vận chuyển ) để họ giao hàng.</p>
            <p>- Chi tiết đơn đặt hàng và toàn bộ thông tin KH cung cấp sẽ được chúng tôi lưu giữ và bảo mật tuyệt đối. Tuy nhiên, KH có thể tiếp cận thông tin bằng cách đăng nhập tài khoản trên trang web. Tại đây, bạn sẽ thấy chi tiết đơn đặt hàng của mình. KH cam kết bảo mật dữ liệu cá nhân và không được phép tiết lộ cho bên thứ ba. Chúng tôi không chịu bất kỳ trách nhiệm nào cho việc dung sai mật khẩu nếu đây không phải là lỗi của chúng tôi.</p>
            <p>- Quyền lợi của KH: KH có quyền yêu cầu truy cập dữ liệu cá nhân của mình, có quyền yêu cầu chúng tôi sửa lại những sai sót trong dữ liệu của bạn mà không mất phí. Bất kì lúc nào bạn cũng có quyền yêu cầu chúng tôi ngưng sử dụng dữ liệu cá nhân của bạn cho mục đích tiếp thị.</p>

            <h5 class="mb-3"> Chính sách đổi trả sản phẩm/ hàng hóa:</h5>
            <p>- Đối với tất cả các sản phẩm được bán trực tiếp tại các cửa hàng chính thức của Asihon, khuyến khích khách hàng kiểm tra kỹ sản phẩm trước khi thanh toán và không hỗ trợ đổi trả sau khi xuất hóa đơn.</p>
            <p>- Đối với KH khi mua hàng trực tuyến, nếu sản phẩm của chúng tôi khiến KH không hài lòng ( Sản phẩm bị lỗi, mặc không vừa ), Asihon sẵn sàng hỗ trợ khách hàng đổi hàng theo chính sách đổi hàng của Asihon. Khách hàng có thể tiến hành gửi hàng đổi hàng trong vòng 7 ngày ( kể từ ngày KH nhận được sản phẩm ).</p>
            <p>- Áp dụng chính sách đổi trả sản phẩm theo các yêu cầu sau:</p>
            <p>+ Sản phẩm còn nguyên vẹn ( không bị xước, chưa qua sử dụng, không qua giặt tẩy ), còn nguyên tem và nhãn mác.</p>
            <p>+ Sản phẩm còn chứng từ hóa đơn nguyên vẹn, không chắp hoặc tẩy xóa.</p>
            <p>+ Chính sách đổi hàng không áp dụng với các sản phẩm trong những chương trình khuyến mãi.</p>
            <p>+ Nếu KH đổi sang hóa đơn có giá tiền thấp hơn, Asihon sẽ không thực hiện hoàn tiền lại cho Qúy khách.</p>
            <p>+ Nếu KH đổi sang hóa đơn có giá tiền cao hơn, vui lòng thanh toán thêm cho Asihon khoản tiền chênh lệch.</p>
            <p>+ Khi Asihon nhận được sản phẩm đổi từ KH, Asihon sẽ kiểm tra và tiến hành đổi sản phẩm mới, gửi hàng lại cho Qúy khách.</p>
        </div>
    </section>
    <!-- Contact Section End -->
@stop

