 function updateTotalPrice(checkbox) {
    var label = checkbox.parentElement;
    if (checkbox.checked) {
        label.classList.add('checked');
    } else {
        label.classList.remove('checked');
    }
}




function decrementQuantity() {
    var quantityInput = document.getElementById('quantity');
    if (parseInt(quantityInput.value) > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
        updateTotalPrice(); // Update total price when quantity changes
    }
}

function incrementQuantity() {
    var quantityInput = document.getElementById('quantity');
    var maxQuantity = <?php echo $ramyeon_quantity; ?>;
    var currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity < maxQuantity) {
        quantityInput.value = currentQuantity + 1;
        updateTotalPrice(); // Update total price when quantity changes
    } else {
        alert('คุณไม่สามารถเพิ่มจำนวนสินค้าเกิน ' + maxQuantity + ' ได้');
    }
}

