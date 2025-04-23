<main style="padding-top: 76px;">
    <div class="container">
        <div class="row py-3">
            <div class="col-8 pe-5">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                    <h5 class="text-uppercase">Giỏ hàng</h5>
                    <button class="btn" onclick="deleteAll()"><i class="fa-regular fa-trash-can"></i></button>
                </div>
                <ul id="cart-body">
                </ul>
            </div>
            <div class="col-4">
                <h5 class="text-uppercase text-center mt-1">tóm tắt đơn hàng</h5>
                <div class="mt-4" id="cart-total">
                </div>
                <button class="btn btn-primary mt-2 w-100" id="submit-btn">Thanh toán ngay</button>
            </div>
        </div>
    </div>
</main>

<script>
const checkedItems = [];

const handleCheck = (variant_id, quantity, price, stock, size_id, color_id, thumbnail, product_name, color_name,
    size_name, product_id) => {
    const index = checkedItems.findIndex(el => el.variant_id == variant_id); // Tìm kiếm theo variant_id
    if (index !== -1) {
        checkedItems.splice(index, 1);
    } else {
        const variant = {
            variant_id,
            quantity,
            price,
            stock,
            size_id,
            color_id,
            thumbnail,
            product_name,
            color_name,
            size_name,
            product_id
        };
        checkedItems.push(variant);
    }
    renderTotal();
};

const deleteCheckItems = () => {
    checkedItems.length = 0;
    renderTotal();
}

const updateQuantity = (status, quantity, stock, variant_id, product_id) => {
    let newQuantity = quantity;

    if (status === true) {
        if (quantity < stock) {
            newQuantity++;
        } else {
            showToast('Đã đạt số lượng tồn kho tối đa');
            return;
        }
    } else if (status === false) {
        if (quantity > 1) {
            newQuantity--;
        } else {
            showToast('Số lượng tối thiểu là 1');
            return;
        }
    }

    // Gửi AJAX để cập nhật session
    $.ajax({
        url: '?controller=cart&action=update_quantity',
        method: 'POST',
        dataType: 'json',
        data: {
            variant_id,
            product_id,
            quantity: newQuantity
        },
        success: (res) => {
            if (res.success) {
                renderCart(res.data)
                renderTotal();
            } else {
                showToast(res.message || 'Cập nhật thất bại');
            }
        },
        error: (err) => {
            console.log(err);
        }
    });
}

const renderCart = (cart) => {
    let html = '';
    if (Object.keys(cart).length === 0) {
        html = `
            <div class="text-center py-5">
                <i class="fa-solid fa-cart-shopping fa-3x text-muted mb-3"></i>
                <h5>Giỏ hàng của bạn đang trống</h5>
                <p>Hãy thêm sản phẩm vào giỏ hàng để bắt đầu mua sắm nhé!</p>
            </div>
        `;
    } else {
        Object.keys(cart).forEach(productId => {
            const variants = cart[productId];
            variants.forEach(variant => {
                // Lấy tất cả các thông tin chi tiết của sản phẩm
                const {
                    variant_id,
                    price,
                    stock,
                    size_id,
                    color_id,
                    thumbnail,
                    product_id,
                    product_name,
                    color_name,
                    size_name,
                    quantity
                } = variant;

                html += `
                    <li class="border-bottom">
                        <div class="row py-3 h-100 align-items-stretch">
                            <div class="col-auto d-flex align-items-center pe-0">
                                <input type="checkbox" class="form-check-input mt-1 cart-checkbox"
                                    onchange="handleCheck(
                                        ${variant_id},
                                        ${quantity},
                                        ${price},
                                        ${stock},
                                        ${size_id},
                                        ${color_id},
                                        '${thumbnail.replace(/'/g, "\\'")}',
                                        '${product_name.replace(/'/g, "\\'")}',
                                        '${color_name.replace(/'/g, "\\'")}',
                                        '${size_name.replace(/'/g, "\\'")}',
                                        ${product_id}
                                    )">
                            </div>
                            <div class="col-2 d-flex justify-content-center align-items-center ps-1">
                                <img width="100" height="100" style="object-fit: contain;" src="${thumbnail}" alt="">
                            </div>
                            <div class="col d-flex flex-column justify-content-between" style="height: 100px;">
                                <div class="d-flex justify-content-between flex-grow-1">
                                    <div>
                                        <h6 class="mb-1">${product_name}</h6>
                                        <div class="d-flex gap-3 align-items-center">
                                            <span style="font-size: 13px">${color_name}</span>
                                            <span style="font-size: 13px">${size_name}</span>
                                            <div class="d-flex align-items-center border rounded">
                                                <button class="btn btn-sm border-end" onclick="updateQuantity(false, ${quantity}, ${stock}, ${variant_id}, ${product_id})">-</button>
                                                <span class="mx-2" style="font-size: 13px">${quantity}</span>
                                                <button class="btn btn-sm border-start" onclick="updateQuantity(true, ${quantity}, ${stock}, ${variant_id}, ${product_id})">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    <span>
                                        <h6 class="mb-1" style="font-size: 14px;">
                                            ${Number(price).toLocaleString('vi-VN')} vnđ
                                        </h6>
                                    </span>
                                </div>
                                <div class="mt-auto d-flex justify-content-between align-items-end">
                                    <button class="btn btn-sm border">Yêu thích<i class="ms-1 fa-regular fa-heart"></i></button>
                                    <button class="btn btn-sm border">
                                        <i class="fa-regular fa-trash-can" onclick="deleteItem('${variant_id}', '${productId}')"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    `;
            });
        });
    }
    updateCartQuantitySpan()
    document.getElementById('cart-body').innerHTML = html;
};

const formatCurrency = (num) => num.toLocaleString('vi-VN') + ' đ';

const renderTotal = () => {
    let totalQuantity = 0;
    let totalPrice = 0;

    if (checkedItems.length > 0) {
        checkedItems.forEach(item => {
            const {
                quantity,
                price,
            } = item;
            const oldPrice = price;

            totalQuantity += quantity;
            totalPrice += price * quantity;
        });
    }

    const shipping = 0;
    const grandTotal = totalPrice + shipping;

    const html = `
        <ul>
            <li class="d-flex justify-content-between mb-2">
                <span>${totalQuantity} sản phẩm</span>
                <span>${formatCurrency(totalPrice)}</span>
            </li>
            <li class="d-flex justify-content-between mb-2">
                <span>Giao hàng</span>
                <span>Miễn phí</span>
            </li>
            <hr>
            <li class="d-flex justify-content-between mt-2">
                <strong>Tổng</strong>
                <strong>${formatCurrency(grandTotal)}</strong>
            </li>
        </ul>
    `;
    if (checkedItems.length <= 0) {
        $('#submit-btn').prop('disabled', true);
    } else {
        $('#submit-btn').prop('disabled', false);
    }
    document.getElementById('cart-total').innerHTML = html;
};

const deleteItem = (variant_id, product_id) => {
    $.ajax({
        url: '?controller=cart&action=remove_variant',
        method: 'POST',
        dataType: 'json',
        data: {
            variant_id,
            product_id
        },
        success: (response) => {
            renderCart(response);
            deleteCheckItems();
        },
        error: (error) => {
            console.log(error);
        }
    })
};

const deleteAll = () => {
    $.ajax({
        url: '?controller=cart&action=remove_all',
        method: 'GET',
        dataType: 'json',
        success: (response) => {
            renderCart(response);
            deleteCheckItems();
        },
        error: (error) => {
            showToast('Có lỗi xảy ra');
        }
    })
}

$('#submit-btn').click(() => {
    $.ajax({
        url: '?controller=cart&action=add_to_order',
        method: 'POST',
        dataType: 'json',
        data: {
            items: checkedItems
        },
        success: (res) => {
            window.location.href = '?controller=home&action=order2'
        },
        error: (err) => {
            console.log(err);
        }
    })
})

$(document).ready(() => {
    $.ajax({
        url: '?controller=cart&action=get_cart',
        method: 'GET',
        dataType: 'json',
        success: (response) => {
            renderCart(response);
            renderTotal();
        },
        error: (error) => {
            console.log(error);
        }
    });
});
</script>