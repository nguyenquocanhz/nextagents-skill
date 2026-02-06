<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Công cụ tính lợi nhuận bán hàng trên Shopee - Tính toán chi phí, phí sàn và lợi nhuận ròng chính xác nhất 2025">
    <meta name="keywords" content="shopee, tính lợi nhuận, phí shopee, bán hàng online, thương mại điện tử">
    <title>Tính Lợi Nhuận Shopee | Công Cụ Hỗ Trợ Người Bán 2025</title>
    <script src="https://kit.fontawesome.com/a1c6fb159c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🛒</text></svg>">
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="/" class="logo">
                    <svg class="logo-icon" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="40" rx="10" fill="#0066FF" />
                        <path d="M12 20L18 26L28 14" stroke="white" stroke-width="3" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span class="logo-text">Shopee<span>Calc</span></span>
                </a>
                <nav class="d-flex gap-2">
                    <a href="#calculator" class="btn btn-outline btn-sm">Tính toán</a>
                    <a href="#fee-table" class="btn btn-primary btn-sm">Bảng phí 2025</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Tính Lợi Nhuận Bán Hàng <span class="highlight">Shopee</span></h1>
                <p>Công cụ tính toán chi phí sàn, phí dịch vụ và lợi nhuận ròng chính xác nhất. Cập nhật mức phí mới
                    nhất 2025 giúp bạn định giá sản phẩm hiệu quả.</p>
                <div class="d-flex gap-2 justify-center" style="justify-content: center;">
                    <a href="#calculator" class="btn btn-shopee btn-lg"><i class="fa-solid fa-calculator"></i> Bắt đầu tính toán</a>
                    <a href="#fee-table" class="btn btn-outline btn-lg"><i class="fa-solid fa-chart-column"></i> Xem bảng phí</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Calculator Section -->
    <section id="calculator" class="calculator-section">
        <div class="container">
            <div class="calculator-grid">
                <!-- Input Form -->
                <div class="form-card">
                    <div class="card-header">
                        <div class="card-icon orange"><i class="fa-solid fa-box"></i></div>
                        <div>
                            <h3 class="card-title">Thông tin sản phẩm</h3>
                            <p class="text-muted" style="margin: 0; font-size: 0.875rem;">Nhập thông tin để tính lợi
                                nhuận</p>
                        </div>
                    </div>

                    <form id="calculatorForm">
                        <!-- Giá vốn -->
                        <div class="form-group">
                            <label class="form-label">
                                Giá vốn sản phẩm <span class="required">*</span>
                            </label>
                            <div class="input-group">
                                <input type="text" id="costPrice" class="form-input" placeholder="Nhập giá vốn"
                                    value="100,000">
                                <span class="input-suffix">₫</span>
                            </div>
                            <p class="form-hint">Chi phí mua/sản xuất sản phẩm</p>
                        </div>

                        <!-- Giá bán gốc -->
                        <div class="form-group">
                            <label class="form-label">
                                Giá bán gốc <span class="required">*</span>
                            </label>
                            <div class="input-group">
                                <input type="text" id="originalPrice" class="form-input" placeholder="Nhập giá bán gốc"
                                    value="250,000">
                                <span class="input-suffix">₫</span>
                            </div>
                            <p class="form-hint">Giá niêm yết trước khuyến mãi</p>
                        </div>

                        <!-- % Khuyến mãi -->
                        <div class="form-group">
                            <label class="form-label">
                                Giảm giá (%)
                            </label>
                            <div class="input-group">
                                <input type="number" id="discountPercent" class="form-input" placeholder="0" value="20" min="0" max="100" step="1">
                                <span class="input-suffix">%</span>
                            </div>
                            <p class="form-hint">Phần trăm giảm giá khuyến mãi</p>
                        </div>

                        <!-- Giá bán sau khuyến mãi (tự động tính) -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fa-solid fa-arrow-right"></i> Giá bán sau khuyến mãi
                            </label>
                            <div class="input-group">
                                <input type="text" id="sellingPrice" class="form-input" placeholder="Tự động tính"
                                    value="200,000" readonly style="background: rgba(0,102,255,0.1); font-weight: 600; color: #0066FF;">
                                <span class="input-suffix">₫</span>
                            </div>
                            <p class="form-hint">Giá người mua thanh toán (tự động tính)</p>
                        </div>

                        <!-- Phí vận chuyển -->
                        <div class="form-group">
                            <label class="form-label">Phí vận chuyển (người mua trả)</label>
                            <div class="input-group">
                                <input type="text" id="shippingFee" class="form-input" placeholder="0" value="0">
                                <span class="input-suffix">₫</span>
                            </div>
                            <p class="form-hint">Phí ship người mua thanh toán (nếu có)</p>
                        </div>

                        <!-- Loại người bán -->
                        <div class="form-group">
                            <label class="form-label">Loại người bán</label>
                            <div class="radio-cards">
                                <label class="radio-card selected">
                                    <input type="radio" name="sellerType" value="normal" checked>
                                    <div class="radio-card-content">
                                        <div class="radio-card-icon" style="background: #E3F2FD; color: #0066FF;"><i class="fa-solid fa-store"></i></div>
                                        <div class="radio-card-text">
                                            Shop thường
                                            <small>Phí thấp hơn</small>
                                        </div>
                                    </div>
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="sellerType" value="mall">
                                    <div class="radio-card-content">
                                        <div class="radio-card-icon" style="background: #FFF3F0; color: #EE4D2D;"><i class="fa-solid fa-building"></i></div>
                                        <div class="radio-card-text">
                                            Shopee Mall
                                            <small>Uy tín cao hơn</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Ngành hàng -->
                        <div class="form-group">
                            <label class="form-label">Ngành hàng</label>
                            <select id="category" class="form-select">
                                <option value="electronics">Điện tử, Điện thoại, Máy tính (7-8%)</option>
                                <option value="fashion">Thời trang, Phụ kiện (10-10.8%)</option>
                                <option value="beauty">Làm đẹp, Sức khỏe (10-10.8%)</option>
                                <option value="mother_baby">Mẹ và Bé (6.5-9.5%)</option>
                                <option value="food">Thực phẩm, Đồ uống (10-10.8%)</option>
                                <option value="home">Nhà cửa, Đời sống (9-10%)</option>
                                <option value="sports">Thể thao, Du lịch (9-10%)</option>
                                <option value="accessories">Phụ kiện điện tử, Đồng hồ (9-10%)</option>
                                <option value="others" selected>Ngành hàng khác (9-10%)</option>
                            </select>
                        </div>

                        <!-- Dịch vụ tham gia -->
                        <div class="form-group">
                            <label class="form-label">Chương trình tham gia</label>
                            <div class="checkbox-group">
                                <label class="checkbox-item">
                                    <input type="checkbox" name="services" value="freeshipXtra">
                                    <span class="checkbox-label"><i class="fa-solid fa-truck-fast"></i> Freeship Xtra (2%)</span>
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="services" value="voucherXtra">
                                    <span class="checkbox-label"><i class="fa-solid fa-ticket"></i> Voucher Xtra (2-4%)</span>
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="services" value="contentXtra">
                                    <span class="checkbox-label"><i class="fa-solid fa-video"></i> Content Xtra (3%)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Chi phí quảng cáo -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fa-solid fa-ad"></i> Chi phí quảng cáo / đơn
                            </label>
                            <div class="input-group">
                                <input type="text" id="adsCost" class="form-input" placeholder="0" value="0">
                                <span class="input-suffix">₫</span>
                            </div>
                            <p class="form-hint">Chi phí Shopee Ads trung bình cho mỗi đơn hàng (CPC)</p>
                        </div>

                        <!-- Số lượng & Đơn hàng -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Số lượng/đơn</label>
                                <input type="number" id="quantity" class="form-input" value="1" min="1">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Số đơn/tháng</label>
                                <input type="number" id="orderCount" class="form-input" value="30" min="1">
                            </div>
                        </div>

                        <!-- Áp dụng thuế -->
                        <div class="form-group">
                            <label class="checkbox-item" style="width: 100%;">
                                <input type="checkbox" id="applyTax">
                                <span class="checkbox-label"><i class="fa-solid fa-coins"></i> Áp dụng thuế (VAT 1% + TNCN 0.5%)</span>
                            </label>
                            <p class="form-hint">Áp dụng cho cá nhân kinh doanh (từ 01/07/2025)</p>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2" style="margin-top: 1.5rem;">
                            <button type="button" id="resetBtn" class="btn btn-outline" style="flex: 1;"><i class="fa-solid fa-rotate-right"></i> Làm mới</button>
                            <button type="button" id="exportBtn" class="btn btn-success" style="flex: 1;"><i class="fa-solid fa-print"></i> In kết quả</button>
                        </div>
                    </form>
                </div>

                <!-- Results Panel -->
                <div class="results-card">
                    <div class="results-header">
                        <h3><i class="fa-solid fa-chart-pie"></i> Kết Quả Tính Toán</h3>
                        <p>Lợi nhuận ước tính cho mỗi đơn hàng</p>
                    </div>

                    <!-- Main Profit Result -->
                    <div class="result-main">
                        <div class="result-label">Lợi nhuận / đơn</div>
                        <div id="resultProfit" class="result-value">0 ₫</div>
                        <div id="resultProfitMargin" class="result-percent">0%</div>
                    </div>

                    <!-- Revenue Summary -->
                    <div class="revenue-summary">
                        <div class="revenue-item">
                            <div class="revenue-item-label">Giá bán</div>
                            <div id="resultRevenue" class="revenue-item-value">0 ₫</div>
                        </div>
                        <div class="revenue-item">
                            <div class="revenue-item-label">Giá vốn</div>
                            <div id="resultCost" class="revenue-item-value">0 ₫</div>
                        </div>
                        <div class="revenue-item">
                            <div class="revenue-item-label">Thực nhận</div>
                            <div id="resultNetRevenue" class="revenue-item-value">0 ₫</div>
                        </div>
                        <div class="revenue-item">
                            <div class="revenue-item-label">Tổng phí</div>
                            <div id="resultTotalFees" class="revenue-item-value">0 ₫</div>
                        </div>
                    </div>

                    <!-- Fee Breakdown -->
                    <div class="fee-breakdown">
                        <div class="fee-breakdown-title"><i class="fa-solid fa-clipboard-list"></i> Chi tiết các loại phí</div>

                        <div class="fee-item">
                            <div class="fee-name">
                                Phí thanh toán
                                <small>5% giá trị đơn hàng</small>
                            </div>
                            <div id="feePayment" class="fee-amount">0 ₫</div>
                        </div>

                        <div class="fee-item">
                            <div class="fee-name">
                                Phí cố định
                                <small>Theo ngành hàng</small>
                            </div>
                            <div id="feeFixed" class="fee-amount">0 ₫</div>
                        </div>

                        <div class="fee-item">
                            <div class="fee-name">
                                Phí hạ tầng
                                <small>3,000₫/đơn (từ 01/07/2025)</small>
                            </div>
                            <div id="feeInfrastructure" class="fee-amount">0 ₫</div>
                        </div>

                        <div class="fee-item">
                            <div class="fee-name">
                                Phí dịch vụ
                                <small>Freeship, Voucher, Content Xtra</small>
                            </div>
                            <div id="feeServices" class="fee-amount">0 ₫</div>
                        </div>

                        <div class="fee-item">
                            <div class="fee-name">
                                Chi phí quảng cáo
                                <small>Shopee Ads (CPC)</small>
                            </div>
                            <div id="feeAds" class="fee-amount">0 ₫</div>
                        </div>

                        <div class="fee-item">
                            <div class="fee-name">
                                Thuế (VAT + TNCN)
                                <small>Nếu áp dụng</small>
                            </div>
                            <div id="feeTaxes" class="fee-amount">0 ₫</div>
                        </div>

                        <div class="fee-item total">
                            <div class="fee-name">TỔNG PHÍ SHOPEE</div>
                            <div id="feeTotalShopee" class="fee-amount">0 ₫</div>
                        </div>
                    </div>

                    <!-- Monthly Summary -->
                    <div class="fee-breakdown"
                        style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1);">
                        <div class="fee-breakdown-title"><i class="fa-solid fa-calendar-days"></i> Ước tính theo tháng</div>

                        <div class="fee-item">
                            <div class="fee-name">Doanh thu</div>
                            <div id="monthlyRevenue" class="fee-amount" style="color: #81C784;">0 ₫</div>
                        </div>

                        <div class="fee-item">
                            <div class="fee-name">Tổng phí Shopee</div>
                            <div id="monthlyFees" class="fee-amount">0 ₫</div>
                        </div>

                        <div class="fee-item">
                            <div class="fee-name">Tổng giá vốn</div>
                            <div id="monthlyCost" class="fee-amount">0 ₫</div>
                        </div>

                        <div class="fee-item total">
                            <div class="fee-name">LỢI NHUẬN RÒNG / THÁNG</div>
                            <div id="monthlyProfit" class="fee-amount" style="color: #81C784; font-size: 1.5rem;">0 ₫
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fee Table Section -->
    <section id="fee-table" class="fee-table-section">
        <div class="container">
            <div class="text-center mb-4">
                <h2><i class="fa-solid fa-table-list"></i> Bảng Phí Shopee 2025</h2>
                <p>Cập nhật các loại phí mới nhất áp dụng từ tháng 4/2025</p>
            </div>

            <!-- Tabs -->
            <div class="tabs">
                <button class="tab-btn active" data-tab="fixed-fee">Phí Cố Định</button>
                <button class="tab-btn" data-tab="service-fee">Phí Dịch Vụ</button>
                <button class="tab-btn" data-tab="other-fee">Phí Khác</button>
            </div>

            <!-- Fixed Fee Tab -->
            <div id="fixed-fee" class="tab-content active">
                <div class="fee-table-card">
                    <div class="fee-table-header">
                        <h3><i class="fa-solid fa-coins"></i> Phí Cố Định Theo Ngành Hàng (từ 01/04/2025)</h3>
                    </div>
                    <table class="fee-table">
                        <thead>
                            <tr>
                                <th>Ngành hàng</th>
                                <th>Shop thường</th>
                                <th>Shopee Mall</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><i class="fa-solid fa-mobile-screen-button"></i> Điện tử, Điện thoại, Máy tính</td>
                                <td><span class="fee-percent">7%</span></td>
                                <td><span class="fee-percent">8%</span></td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-shirt"></i> Thời trang, Phụ kiện</td>
                                <td><span class="fee-percent">10%</span></td>
                                <td><span class="fee-percent">10.8%</span></td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-spray-can-sparkles"></i> Làm đẹp, Sức khỏe</td>
                                <td><span class="fee-percent">10%</span></td>
                                <td><span class="fee-percent">10.8%</span></td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-baby"></i> Mẹ và Bé</td>
                                <td><span class="fee-percent">6.5%</span></td>
                                <td><span class="fee-percent">9.5%</span></td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-bowl-food"></i> Thực phẩm, Đồ uống</td>
                                <td><span class="fee-percent">10%</span></td>
                                <td><span class="fee-percent">10.8%</span></td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-house"></i> Nhà cửa, Đời sống</td>
                                <td><span class="fee-percent">9%</span></td>
                                <td><span class="fee-percent">10%</span></td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-futbol"></i> Thể thao, Du lịch</td>
                                <td><span class="fee-percent">9%</span></td>
                                <td><span class="fee-percent">10%</span></td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-clock"></i> Phụ kiện điện tử, Đồng hồ</td>
                                <td><span class="fee-percent">9%</span></td>
                                <td><span class="fee-percent">10%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Service Fee Tab -->
            <div id="service-fee" class="tab-content">
                <div class="fee-table-card">
                    <div class="fee-table-header">
                        <h3><i class="fa-solid fa-gift"></i> Phí Dịch Vụ (Chương trình tùy chọn)</h3>
                    </div>
                    <table class="fee-table">
                        <thead>
                            <tr>
                                <th>Dịch vụ</th>
                                <th>Mức phí</th>
                                <th>Giới hạn</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><i class="fa-solid fa-truck-fast"></i> Freeship Xtra</td>
                                <td><span class="fee-percent">2%</span></td>
                                <td>Tối đa 50,000₫/SP</td>
                                <td>Hỗ trợ phí vận chuyển</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-ticket"></i> Voucher Xtra (Shop thường)</td>
                                <td><span class="fee-percent">2%</span></td>
                                <td>Tối đa 50,000₫/SP</td>
                                <td>Voucher giảm giá</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-ticket"></i> Voucher Xtra (Shopee Mall)</td>
                                <td><span class="fee-percent">4%</span></td>
                                <td>Tối đa 50,000₫/SP</td>
                                <td>Voucher giảm giá</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-video"></i> Content Xtra (Shop thường)</td>
                                <td><span class="fee-percent">3%</span></td>
                                <td>Không giới hạn</td>
                                <td>Livestream, Video</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-video"></i> Content Xtra (Shopee Mall)</td>
                                <td>Cố định</td>
                                <td>Tối đa 30,000₫</td>
                                <td>Livestream, Video</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Other Fee Tab -->
            <div id="other-fee" class="tab-content">
                <div class="fee-table-card">
                    <div class="fee-table-header">
                        <h3><i class="fa-solid fa-chart-simple"></i> Các Loại Phí Khác</h3>
                    </div>
                    <table class="fee-table">
                        <thead>
                            <tr>
                                <th>Loại phí</th>
                                <th>Mức phí</th>
                                <th>Áp dụng từ</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><i class="fa-solid fa-credit-card"></i> Phí thanh toán</td>
                                <td><span class="fee-percent">5%</span></td>
                                <td>03/07/2024</td>
                                <td>Tất cả phương thức thanh toán</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-server"></i> Phí hạ tầng</td>
                                <td>3,000₫/đơn</td>
                                <td>01/07/2025</td>
                                <td>Áp dụng cho mọi đơn hàng</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-file-invoice"></i> VAT (hàng hóa)</td>
                                <td><span class="fee-percent">1%</span></td>
                                <td>01/07/2025</td>
                                <td>Thuế giá trị gia tăng</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-briefcase"></i> Thuế TNCN (hàng hóa)</td>
                                <td><span class="fee-percent">0.5%</span></td>
                                <td>01/07/2025</td>
                                <td>Thuế thu nhập cá nhân</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-rotate"></i> VAT trên phí dịch vụ</td>
                                <td><span class="fee-percent">8%</span></td>
                                <td>01/07/2025 - 31/12/2026</td>
                                <td>Giảm từ 10% xuống 8%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="text-center mb-4">
                <h2><i class="fa-solid fa-lightbulb"></i> Mẹo Tối Ưu Lợi Nhuận</h2>
                <p>Những cách giúp bạn tăng lợi nhuận khi bán hàng trên Shopee</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon blue"><i class="fa-solid fa-sack-dollar"></i></div>
                        <h4 class="card-title">Định giá thông minh</h4>
                    </div>
                    <p>Tính toán đầy đủ các loại phí trước khi định giá. Đảm bảo biên lợi nhuận ít nhất 15-20% sau khi
                        trừ tất cả chi phí.</p>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-icon green"><i class="fa-solid fa-boxes-stacked"></i></div>
                        <h4 class="card-title">Chọn ngành hàng phù hợp</h4>
                    </div>
                    <p>Phí cố định khác nhau theo ngành hàng. Điện tử có phí thấp nhất (7%), trong khi thời trang và
                        thực phẩm có phí cao (10%).</p>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-icon orange"><i class="fa-solid fa-bullseye"></i></div>
                        <h4 class="card-title">Tham gia chương trình có chọn lọc</h4>
                    </div>
                    <p>Chỉ tham gia Freeship Xtra, Voucher Xtra khi sản phẩm có biên lợi nhuận đủ lớn để bù đắp phí dịch
                        vụ 2-4%.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>© 2025 ShopeeCalc - Công cụ hỗ trợ người bán hàng trên Shopee</p>
            <p style="margin-top: 0.5rem;">Thiết kế theo phong cách <a href="https://www.kiotviet.vn"
                    target="_blank">KiotViet</a> | Dữ liệu phí được cập nhật từ <a href="https://banhang.shopee.vn"
                    target="_blank">Shopee Seller Center</a></p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="js/calculator.js"></script>
    <script>
        // Tab functionality
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                // Remove active from all tabs
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                // Add active to clicked tab
                this.classList.add('active');
                document.getElementById(this.dataset.tab).classList.add('active');
            });
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>

</html>