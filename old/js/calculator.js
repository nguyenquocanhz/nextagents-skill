/**
 * Shopee Profit Calculator - JavaScript Module
 * Tính toán lợi nhuận bán hàng trên Shopee (2025)
 */

// ===== CẤU HÌNH PHÍ SHOPEE 2025 =====
const SHOPEE_FEES = {
    // Phí thanh toán: 5% (bao gồm VAT)
    paymentFee: 0.05,

    // Phí hạ tầng: 3,000 VNĐ/đơn (từ 01/07/2025)
    infrastructureFee: 3000,

    // VAT trên phí dịch vụ: 8% (giảm từ 10% đến 31/12/2026)
    vatOnServices: 0.08,

    // Phí cố định theo ngành hàng (từ 01/04/2025)
    fixedFee: {
        normal: {
            'electronics': { rate: 0.07, name: 'Điện tử, Điện thoại, Máy tính' },
            'fashion': { rate: 0.10, name: 'Thời trang, Phụ kiện' },
            'beauty': { rate: 0.10, name: 'Làm đẹp, Sức khỏe' },
            'mother_baby': { rate: 0.065, name: 'Mẹ và Bé' },
            'food': { rate: 0.10, name: 'Thực phẩm, Đồ uống' },
            'home': { rate: 0.09, name: 'Nhà cửa, Đời sống' },
            'sports': { rate: 0.09, name: 'Thể thao, Du lịch' },
            'accessories': { rate: 0.09, name: 'Phụ kiện điện tử, Đồng hồ' },
            'others': { rate: 0.09, name: 'Khác' }
        },
        mall: {
            'electronics': { rate: 0.08, name: 'Điện tử, Điện thoại, Máy tính' },
            'fashion': { rate: 0.108, name: 'Thời trang, Phụ kiện' },
            'beauty': { rate: 0.108, name: 'Làm đẹp, Sức khỏe' },
            'mother_baby': { rate: 0.095, name: 'Mẹ và Bé' },
            'food': { rate: 0.108, name: 'Thực phẩm, Đồ uống' },
            'home': { rate: 0.10, name: 'Nhà cửa, Đời sống' },
            'sports': { rate: 0.10, name: 'Thể thao, Du lịch' },
            'accessories': { rate: 0.10, name: 'Phụ kiện điện tử, Đồng hồ' },
            'others': { rate: 0.10, name: 'Khác' }
        }
    },

    // Phí dịch vụ (tùy chọn tham gia)
    serviceFee: {
        // Freeship Xtra: 2% (tối đa 50,000 VNĐ/sản phẩm)
        freeshipXtra: { rate: 0.02, maxPerProduct: 50000 },

        // Voucher Xtra
        voucherXtra: {
            normal: { rate: 0.02, maxPerProduct: 50000 },
            mall: { rate: 0.04, maxPerProduct: 50000 }
        },

        // Content Xtra (Livestream/Video): 3%
        contentXtra: {
            normal: { rate: 0.03, maxPerProduct: null },
            mall: { rate: 0, maxPerProduct: 30000 }
        }
    },

    // Thuế (áp dụng từ 01/07/2025)
    tax: {
        // VAT hàng hóa: 1% doanh thu
        vatGoods: 0.01,
        // Thuế TNCN hàng hóa: 0.5% doanh thu
        pitGoods: 0.005
    }
};

// ===== TIỆN ÍCH FORMAT =====
const formatCurrency = (value) => {
    return new Intl.NumberFormat('vi-VN', {
        style: 'decimal',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(value) + ' ₫';
};

const formatPercent = (value) => {
    return (value * 100).toFixed(2) + '%';
};

const parseCurrency = (value) => {
    if (typeof value === 'number') return value;
    // Vietnamese format uses dots as thousand separators (e.g., 299.000)
    // Remove all dots and commas, then parse as integer
    const cleanValue = String(value).replace(/[.,\s]/g, '').replace(/[^\d-]/g, '');
    return parseInt(cleanValue, 10) || 0;
};

// ===== HÀM TÍNH TOÁN =====

/**
 * Tính phí thanh toán
 * @param {number} orderValue - Tổng giá trị đơn hàng (giá sản phẩm + phí vận chuyển)
 * @returns {number} - Phí thanh toán
 */
function calculatePaymentFee(orderValue) {
    return orderValue * SHOPEE_FEES.paymentFee;
}

/**
 * Tính phí cố định
 * @param {number} productValue - Giá trị sản phẩm
 * @param {string} category - Ngành hàng
 * @param {string} sellerType - Loại người bán (normal/mall)
 * @returns {number} - Phí cố định
 */
function calculateFixedFee(productValue, category, sellerType) {
    const feeConfig = SHOPEE_FEES.fixedFee[sellerType]?.[category];
    if (!feeConfig) return productValue * 0.09; // Default 9%
    return productValue * feeConfig.rate;
}

/**
 * Tính phí dịch vụ (Freeship, Voucher, Content Xtra)
 * @param {number} productValue - Giá trị sản phẩm
 * @param {object} services - Các dịch vụ tham gia
 * @param {string} sellerType - Loại người bán
 * @returns {object} - Chi tiết phí dịch vụ
 */
function calculateServiceFees(productValue, services, sellerType) {
    const fees = {
        freeshipXtra: 0,
        voucherXtra: 0,
        contentXtra: 0,
        total: 0
    };

    // Freeship Xtra
    if (services.freeshipXtra) {
        const config = SHOPEE_FEES.serviceFee.freeshipXtra;
        fees.freeshipXtra = Math.min(productValue * config.rate, config.maxPerProduct);
    }

    // Voucher Xtra
    if (services.voucherXtra) {
        const config = SHOPEE_FEES.serviceFee.voucherXtra[sellerType];
        fees.voucherXtra = Math.min(productValue * config.rate, config.maxPerProduct);
    }

    // Content Xtra
    if (services.contentXtra) {
        const config = SHOPEE_FEES.serviceFee.contentXtra[sellerType];
        if (sellerType === 'mall' && config.maxPerProduct) {
            fees.contentXtra = config.maxPerProduct;
        } else {
            fees.contentXtra = productValue * config.rate;
        }
    }

    fees.total = fees.freeshipXtra + fees.voucherXtra + fees.contentXtra;
    return fees;
}

/**
 * Tính thuế
 * @param {number} revenue - Doanh thu
 * @param {boolean} applyTax - Có áp dụng thuế không
 * @returns {object} - Chi tiết thuế
 */
function calculateTaxes(revenue, applyTax) {
    if (!applyTax) {
        return { vat: 0, pit: 0, total: 0 };
    }

    const vat = revenue * SHOPEE_FEES.tax.vatGoods;
    const pit = revenue * SHOPEE_FEES.tax.pitGoods;

    return {
        vat,
        pit,
        total: vat + pit
    };
}

/**
 * Tính toán lợi nhuận tổng hợp
 * @param {object} input - Thông tin đầu vào
 * @returns {object} - Kết quả tính toán
 */
function calculateProfit(input) {
    const {
        costPrice = 0,           // Giá vốn
        sellingPrice = 0,        // Giá bán
        shippingFee = 0,         // Phí vận chuyển (người mua trả)
        adsCost = 0,             // Chi phí quảng cáo/đơn
        sellerType = 'normal',   // Loại người bán
        category = 'others',     // Ngành hàng
        services = {},           // Các dịch vụ tham gia
        applyTax = false,        // Áp dụng thuế
        quantity = 1,            // Số lượng sản phẩm/đơn
        orderCount = 1           // Số đơn hàng/tháng
    } = input;

    // Tính cho 1 đơn hàng
    const orderValue = sellingPrice + shippingFee;

    // 1. Phí thanh toán
    const paymentFee = calculatePaymentFee(orderValue);

    // 2. Phí cố định
    const fixedFee = calculateFixedFee(sellingPrice, category, sellerType);

    // 3. Phí hạ tầng
    const infrastructureFee = SHOPEE_FEES.infrastructureFee;

    // 4. Phí dịch vụ
    const serviceFees = calculateServiceFees(sellingPrice, services, sellerType);

    // 5. Tổng phí Shopee (1 đơn) - bao gồm cả chi phí quảng cáo
    const totalShopeeFeesPerOrder = paymentFee + fixedFee + infrastructureFee + serviceFees.total + adsCost;

    // 6. Thuế (nếu có)
    const taxes = calculateTaxes(sellingPrice, applyTax);

    // 7. Tổng chi phí (1 đơn)
    const totalCostPerOrder = costPrice * quantity + totalShopeeFeesPerOrder + taxes.total;

    // 8. Doanh thu thực nhận (1 đơn)
    const netRevenuePerOrder = sellingPrice - totalShopeeFeesPerOrder - taxes.total;

    // 9. Lợi nhuận (1 đơn)
    const profitPerOrder = netRevenuePerOrder - (costPrice * quantity);

    // 10. Tỷ suất lợi nhuận
    const profitMargin = sellingPrice > 0 ? profitPerOrder / sellingPrice : 0;

    // 11. ROI (Return on Investment)
    const roi = costPrice > 0 ? profitPerOrder / (costPrice * quantity) : 0;

    // Tính cho tháng (nhiều đơn)
    const monthlyRevenue = sellingPrice * orderCount;
    const monthlyShopeeFeess = totalShopeeFeesPerOrder * orderCount;
    const monthlyTaxes = taxes.total * orderCount;
    const monthlyCost = (costPrice * quantity) * orderCount;
    const monthlyAds = adsCost * orderCount;
    const monthlyProfit = profitPerOrder * orderCount;

    return {
        // Thông tin đơn hàng
        orderValue,
        sellingPrice,
        costPrice: costPrice * quantity,

        // Chi tiết phí (1 đơn)
        fees: {
            payment: paymentFee,
            fixed: fixedFee,
            infrastructure: infrastructureFee,
            services: serviceFees,
            ads: adsCost,
            taxes: taxes,
            totalShopee: totalShopeeFeesPerOrder,
            totalWithTax: totalShopeeFeesPerOrder + taxes.total
        },

        // Kết quả (1 đơn)
        perOrder: {
            revenue: sellingPrice,
            netRevenue: netRevenuePerOrder,
            cost: costPrice * quantity,
            profit: profitPerOrder,
            profitMargin: profitMargin,
            roi: roi
        },

        // Kết quả (tháng)
        monthly: {
            orderCount,
            revenue: monthlyRevenue,
            shopeeFeess: monthlyShopeeFeess,
            taxes: monthlyTaxes,
            cost: monthlyCost,
            ads: monthlyAds,
            profit: monthlyProfit,
            profitMargin: monthlyRevenue > 0 ? monthlyProfit / monthlyRevenue : 0
        },

        // Tỷ lệ phí so với doanh thu
        feeBreakdown: {
            paymentRate: sellingPrice > 0 ? paymentFee / sellingPrice : 0,
            fixedRate: sellingPrice > 0 ? fixedFee / sellingPrice : 0,
            serviceRate: sellingPrice > 0 ? serviceFees.total / sellingPrice : 0,
            infrastructureRate: sellingPrice > 0 ? infrastructureFee / sellingPrice : 0,
            adsRate: sellingPrice > 0 ? adsCost / sellingPrice : 0,
            taxRate: sellingPrice > 0 ? taxes.total / sellingPrice : 0,
            totalRate: sellingPrice > 0 ? (totalShopeeFeesPerOrder + taxes.total) / sellingPrice : 0
        }
    };
}

// ===== DOM MANIPULATION =====
document.addEventListener('DOMContentLoaded', function () {
    // Elements
    const form = document.getElementById('calculatorForm');
    const costPriceInput = document.getElementById('costPrice');
    const originalPriceInput = document.getElementById('originalPrice');
    const discountPercentInput = document.getElementById('discountPercent');
    const sellingPriceInput = document.getElementById('sellingPrice');
    const shippingFeeInput = document.getElementById('shippingFee');
    const adsCostInput = document.getElementById('adsCost');
    const categorySelect = document.getElementById('category');
    const quantityInput = document.getElementById('quantity');
    const orderCountInput = document.getElementById('orderCount');
    const sellerTypeRadios = document.querySelectorAll('input[name="sellerType"]');
    const serviceCheckboxes = document.querySelectorAll('input[name="services"]');
    const applyTaxCheckbox = document.getElementById('applyTax');

    // Result elements
    const resultProfit = document.getElementById('resultProfit');
    const resultProfitMargin = document.getElementById('resultProfitMargin');
    const resultRevenue = document.getElementById('resultRevenue');
    const resultCost = document.getElementById('resultCost');
    const resultNetRevenue = document.getElementById('resultNetRevenue');
    const resultTotalFees = document.getElementById('resultTotalFees');

    // Fee breakdown elements
    const feePayment = document.getElementById('feePayment');
    const feeFixed = document.getElementById('feeFixed');
    const feeInfrastructure = document.getElementById('feeInfrastructure');
    const feeServices = document.getElementById('feeServices');
    const feeAds = document.getElementById('feeAds');
    const feeTaxes = document.getElementById('feeTaxes');
    const feeTotalShopee = document.getElementById('feeTotalShopee');

    // Monthly elements
    const monthlyRevenue = document.getElementById('monthlyRevenue');
    const monthlyFees = document.getElementById('monthlyFees');
    const monthlyCost = document.getElementById('monthlyCost');
    const monthlyProfit = document.getElementById('monthlyProfit');

    // Format input with thousand separator
    function formatInputValue(input) {
        let value = input.value.replace(/[^\d]/g, '');
        if (value) {
            input.value = parseInt(value).toLocaleString('vi-VN');
        }
    }

    // Calculate selling price after discount
    function updateSellingPrice() {
        const originalPrice = parseCurrency(originalPriceInput?.value || 0);
        const discountPercent = parseFloat(discountPercentInput?.value || 0);

        const discountAmount = originalPrice * (discountPercent / 100);
        const sellingPrice = Math.round(originalPrice - discountAmount);

        if (sellingPriceInput) {
            sellingPriceInput.value = sellingPrice.toLocaleString('vi-VN');
        }

        updateCalculation();
    }

    // Add formatting to number inputs
    [costPriceInput, originalPriceInput, shippingFeeInput, adsCostInput].forEach(input => {
        if (input) {
            input.addEventListener('input', function () {
                formatInputValue(this);
                if (this === originalPriceInput) {
                    updateSellingPrice();
                } else {
                    updateCalculation();
                }
            });
        }
    });

    // Discount percent input listener
    if (discountPercentInput) {
        discountPercentInput.addEventListener('input', updateSellingPrice);
        discountPercentInput.addEventListener('change', updateSellingPrice);
    }

    // Add event listeners for other inputs
    [categorySelect, quantityInput, orderCountInput].forEach(input => {
        if (input) {
            input.addEventListener('change', updateCalculation);
            input.addEventListener('input', updateCalculation);
        }
    });

    sellerTypeRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            // Update visual state
            document.querySelectorAll('.radio-card').forEach(card => {
                card.classList.remove('selected');
            });
            this.closest('.radio-card').classList.add('selected');
            updateCalculation();
        });
    });

    serviceCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            this.closest('.checkbox-item').classList.toggle('active', this.checked);
            updateCalculation();
        });
    });

    if (applyTaxCheckbox) {
        applyTaxCheckbox.addEventListener('change', function () {
            this.closest('.checkbox-item').classList.toggle('active', this.checked);
            updateCalculation();
        });
    }

    // Main calculation function
    function updateCalculation() {
        const input = {
            costPrice: parseCurrency(costPriceInput?.value || 0),
            sellingPrice: parseCurrency(sellingPriceInput?.value || 0),
            shippingFee: parseCurrency(shippingFeeInput?.value || 0),
            adsCost: parseCurrency(adsCostInput?.value || 0),
            sellerType: document.querySelector('input[name="sellerType"]:checked')?.value || 'normal',
            category: categorySelect?.value || 'others',
            quantity: parseInt(quantityInput?.value || 1),
            orderCount: parseInt(orderCountInput?.value || 1),
            applyTax: applyTaxCheckbox?.checked || false,
            services: {
                freeshipXtra: document.querySelector('input[name="services"][value="freeshipXtra"]')?.checked || false,
                voucherXtra: document.querySelector('input[name="services"][value="voucherXtra"]')?.checked || false,
                contentXtra: document.querySelector('input[name="services"][value="contentXtra"]')?.checked || false
            }
        };

        const result = calculateProfit(input);

        // Update main result
        if (resultProfit) {
            resultProfit.textContent = formatCurrency(result.perOrder.profit);
            resultProfit.classList.toggle('negative', result.perOrder.profit < 0);
        }

        if (resultProfitMargin) {
            const marginPercent = (result.perOrder.profitMargin * 100).toFixed(1);
            resultProfitMargin.innerHTML = `<i class="icon-trending-${result.perOrder.profit >= 0 ? 'up' : 'down'}"></i> ${marginPercent}%`;
            resultProfitMargin.classList.toggle('negative', result.perOrder.profit < 0);
        }

        // Update revenue summary
        if (resultRevenue) resultRevenue.textContent = formatCurrency(result.sellingPrice);
        if (resultCost) resultCost.textContent = formatCurrency(result.costPrice);
        if (resultNetRevenue) resultNetRevenue.textContent = formatCurrency(result.perOrder.netRevenue);
        if (resultTotalFees) resultTotalFees.textContent = formatCurrency(result.fees.totalWithTax);

        // Update fee breakdown
        if (feePayment) feePayment.textContent = formatCurrency(result.fees.payment);
        if (feeFixed) feeFixed.textContent = formatCurrency(result.fees.fixed);
        if (feeInfrastructure) feeInfrastructure.textContent = formatCurrency(result.fees.infrastructure);
        if (feeServices) feeServices.textContent = formatCurrency(result.fees.services.total);
        if (feeAds) feeAds.textContent = formatCurrency(result.fees.ads);
        if (feeTaxes) feeTaxes.textContent = formatCurrency(result.fees.taxes.total);
        if (feeTotalShopee) feeTotalShopee.textContent = formatCurrency(result.fees.totalWithTax);

        // Update monthly results
        if (monthlyRevenue) monthlyRevenue.textContent = formatCurrency(result.monthly.revenue);
        if (monthlyFees) monthlyFees.textContent = formatCurrency(result.monthly.shopeeFeess + result.monthly.taxes);
        if (monthlyCost) monthlyCost.textContent = formatCurrency(result.monthly.cost);
        if (monthlyProfit) {
            monthlyProfit.textContent = formatCurrency(result.monthly.profit);
            monthlyProfit.classList.toggle('negative', result.monthly.profit < 0);
        }

        // Animate result update
        document.querySelectorAll('.result-value, .fee-amount, .revenue-item-value').forEach(el => {
            el.classList.add('animate-fade-in');
            setTimeout(() => el.classList.remove('animate-fade-in'), 500);
        });
    }

    // Initial calculation - calculate selling price first
    updateSellingPrice();

    // Export functionality
    const exportBtn = document.getElementById('exportBtn');
    if (exportBtn) {
        exportBtn.addEventListener('click', function () {
            // Simple print
            window.print();
        });
    }

    // Reset functionality
    const resetBtn = document.getElementById('resetBtn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            if (form) form.reset();
            document.querySelectorAll('.checkbox-item.active, .radio-card.selected').forEach(el => {
                el.classList.remove('active', 'selected');
            });
            document.querySelector('.radio-card:first-child')?.classList.add('selected');
            updateSellingPrice(); // Recalculate selling price after reset
        });
    }
});

// Export functions for external use
window.ShopeeCalculator = {
    calculateProfit,
    formatCurrency,
    formatPercent,
    SHOPEE_FEES
};
