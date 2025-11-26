<?php
/**
 * Template Name: Tài chính & Trả góp
 */
get_header();
?>

<main class="main-wrapper">

    <!-- Breadcrumb -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="<?php echo home_url('/'); ?>">Home</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active">Tài chính & Trả góp</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('financing_page_title', 'Tài chính & Trả góp')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Financing Section -->
    <div class="axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="financing-intro text-center mb--50">
                        <p class="lead"><?php echo esc_html(get_theme_mod('financing_page_description', 'Giải pháp tài chính linh hoạt, giúp bạn sở hữu chiếc xe mơ ước dễ dàng hơn.')); ?></p>
                    </div>

                    <!-- Financing Options -->
                    <div class="financing-options mb--50">
                        <h3 class="text-center mb--40"><?php echo esc_html(get_theme_mod('financing_options_title', 'Các gói tài chính')); ?></h3>
                        <div class="row">
                            <div class="col-md-4 mb--30">
                                <div class="financing-box text-center">
                                    <i class="fas fa-percent fa-3x mb--15" style="color: #28a745;"></i>
                                    <h4><?php echo esc_html(get_theme_mod('financing_option1_title', 'Trả góp 0%')); ?></h4>
                                    <p><?php echo esc_html(get_theme_mod('financing_option1_desc', 'Trả góp lãi suất 0% trong 12 tháng đầu, áp dụng cho các mẫu xe được chọn.')); ?></p>
                                    <ul class="text-left mt--20">
                                        <li>Lãi suất: 0% (12 tháng đầu)</li>
                                        <li>Trả trước: Từ 30%</li>
                                        <li>Thời hạn: 12-60 tháng</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 mb--30">
                                <div class="financing-box text-center">
                                    <i class="fas fa-hand-holding-usd fa-3x mb--15" style="color: #007bff;"></i>
                                    <h4><?php echo esc_html(get_theme_mod('financing_option2_title', 'Vay ngân hàng')); ?></h4>
                                    <p><?php echo esc_html(get_theme_mod('financing_option2_desc', 'Hỗ trợ vay ngân hàng với lãi suất ưu đãi, thủ tục nhanh chóng.')); ?></p>
                                    <ul class="text-left mt--20">
                                        <li>Lãi suất: Từ 6.5%/năm</li>
                                        <li>Trả trước: Từ 20%</li>
                                        <li>Thời hạn: 12-84 tháng</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 mb--30">
                                <div class="financing-box text-center">
                                    <i class="fas fa-file-invoice-dollar fa-3x mb--15" style="color: #ff497c;"></i>
                                    <h4><?php echo esc_html(get_theme_mod('financing_option3_title', 'Leasing')); ?></h4>
                                    <p><?php echo esc_html(get_theme_mod('financing_option3_desc', 'Thuê tài chính, linh hoạt trong thanh toán và sử dụng xe.')); ?></p>
                                    <ul class="text-left mt--20">
                                        <li>Thanh toán: Hàng tháng</li>
                                        <li>Trả trước: Từ 10%</li>
                                        <li>Thời hạn: 24-60 tháng</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Calculator -->
                    <div class="financing-calculator mb--50">
                        <h3 class="text-center mb--30"><?php echo esc_html(get_theme_mod('financing_calculator_title', 'Tính toán trả góp')); ?></h3>
                        <div class="calculator-box">
                            <div class="row">
                                <div class="col-md-6 mb--20">
                                    <label>Giá xe (VNĐ)</label>
                                    <input type="number" id="car-price" class="form-control" placeholder="1000000000">
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Trả trước (%)</label>
                                    <input type="number" id="down-payment" class="form-control" value="30" min="0" max="100">
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Lãi suất (%/năm)</label>
                                    <input type="number" id="interest-rate" class="form-control" value="6.5" step="0.1">
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Thời hạn (tháng)</label>
                                    <input type="number" id="loan-term" class="form-control" value="36" min="12" max="84">
                                </div>
                                <div class="col-md-12 text-center">
                                    <button onclick="calculateLoan()" class="axil-btn btn-primary">
                                        <?php echo esc_html(get_theme_mod('financing_calculate_button_text', 'Tính toán')); ?>
                                    </button>
                                </div>
                                <div class="col-md-12 mt--30">
                                    <div id="calculation-result" class="calculation-result"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Requirements -->
                    <div class="financing-requirements mb--50">
                        <h3 class="text-center mb--30"><?php echo esc_html(get_theme_mod('financing_requirements_title', 'Điều kiện vay')); ?></h3>
                        <div class="row">
                            <div class="col-md-6 mb--20">
                                <div class="requirement-item">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('requirement1_title', 'Độ tuổi')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('requirement1_desc', 'Từ 18-65 tuổi, có CMND/CCCD hợp lệ.')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb--20">
                                <div class="requirement-item">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('requirement2_title', 'Thu nhập')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('requirement2_desc', 'Có thu nhập ổn định, chứng minh được nguồn thu nhập.')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb--20">
                                <div class="requirement-item">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('requirement3_title', 'Giấy tờ')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('requirement3_desc', 'CMND/CCCD, sổ hộ khẩu, giấy tờ chứng minh thu nhập.')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb--20">
                                <div class="requirement-item">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('requirement4_title', 'Lịch sử tín dụng')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('requirement4_desc', 'Không có nợ xấu, lịch sử tín dụng tốt.')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="<?php echo site_url('/contact'); ?>" class="axil-btn btn-primary">
                            <?php echo esc_html(get_theme_mod('financing_button_text', 'Đăng ký tư vấn tài chính')); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
function calculateLoan() {
    var price = parseFloat(document.getElementById('car-price').value);
    var downPayment = parseFloat(document.getElementById('down-payment').value);
    var interestRate = parseFloat(document.getElementById('interest-rate').value);
    var loanTerm = parseInt(document.getElementById('loan-term').value);

    if (!price || price <= 0) {
        alert('Vui lòng nhập giá xe hợp lệ');
        return;
    }

    var downPaymentAmount = price * (downPayment / 100);
    var loanAmount = price - downPaymentAmount;
    var monthlyRate = interestRate / 100 / 12;
    var monthlyPayment = loanAmount * (monthlyRate * Math.pow(1 + monthlyRate, loanTerm)) / (Math.pow(1 + monthlyRate, loanTerm) - 1);
    var totalPayment = monthlyPayment * loanTerm;
    var totalInterest = totalPayment - loanAmount;

    var result = document.getElementById('calculation-result');
    result.innerHTML = '<div class="alert alert-info">' +
        '<h5>Kết quả tính toán:</h5>' +
        '<p><strong>Giá xe:</strong> ' + formatMoney(price) + ' VNĐ</p>' +
        '<p><strong>Trả trước:</strong> ' + formatMoney(downPaymentAmount) + ' VNĐ (' + downPayment + '%)</p>' +
        '<p><strong>Số tiền vay:</strong> ' + formatMoney(loanAmount) + ' VNĐ</p>' +
        '<p><strong>Trả hàng tháng:</strong> ' + formatMoney(monthlyPayment) + ' VNĐ</p>' +
        '<p><strong>Tổng tiền trả:</strong> ' + formatMoney(totalPayment) + ' VNĐ</p>' +
        '<p><strong>Tổng lãi:</strong> ' + formatMoney(totalInterest) + ' VNĐ</p>' +
        '</div>';
}

function formatMoney(amount) {
    return new Intl.NumberFormat('vi-VN').format(Math.round(amount));
}
</script>

<style>
.financing-box {
    padding: 30px;
    background: #f9f9f9;
    border-radius: 10px;
    height: 100%;
}
.financing-box ul {
    list-style: none;
    padding: 0;
}
.financing-box ul li {
    padding: 5px 0;
}
.calculator-box {
    padding: 30px;
    background: #f9f9f9;
    border-radius: 10px;
}
.requirement-item {
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
}
</style>

<?php get_footer(); ?>

