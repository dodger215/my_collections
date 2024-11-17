<?php

session_start();

if(!isset($_SESSION['auth'])){
  redirect("../signin.php", "Try again");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require('header/header.php') ?>
  <style>
    body {
      padding-top: 20px;
      background-color: #f8f9fa;
    }
    .product-card {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <?php require('header/nav.php')?>
  <div class="wrapper container">
    <h2 class="text-center mb-4">Upload Your House or Room Info</h2>
    <button type="button" class="btn btn-danger" onclick="back()">Back</button>
    <form id="productForm" enctype="multipart/form-data">
      <!-- Image Upload Section -->
      <div class="mb-3">
        <label for="rentImages" class="form-label">Upload first view  image of the room</label>
        <input class="form-control" type="file" name="images[]" id="rentImages" multiple accept="image/*">
      </div>
      
      <!-- Dynamic Product Fields -->
      <div id="productFields">
        <div class="card product-card">
          <div class="card-body">
            <h5 class="card-title">Section 1</h5>
            <!-- Product Title -->
            <div class="mb-3">
              <label for="location1" class="form-label">Location of the House</label>
              <input type="text" name="location[]" class="form-control" id="location1" placeholder="Enter Location of the House">
            </div>
            <!-- Product Description -->
            <div class="mb-3">
              <label for="roomDescription1" class="form-label">Room Description</label>
              <textarea class="form-control" name="product_descriptions[]" id="productDescription1" rows="3" placeholder="Enter room description"></textarea>
            </div>
            <div class="mb-3">
              <label for="period" class="form-label">Peroid of the rent</label>
              <select class="form-control" name="period" id="period">
                <option>per month</option>
                <option>per day</option>
                <option>per year</option>
              </select>
            </div>
            <!-- Product Price -->
            <div class="mb-3">
              <label for="productPrice1" class="form-label">Price (GHS)</label>
              <input type="number" name="product_prices[]" class="form-control" id="productPrice1" placeholder="Enter price">
            </div>
            <div class="mb-3">
              <label for="rentDescription1" class="form-label">Terms and Condition</label>
              <textarea class="form-control" name="rent_descriptions[]" id="rentDescription1" rows="3" placeholder="Enter terms and condition about the room"></textarea>
          </div>
        </div>
      </div>

      <!-- Add Another Product Button -->
      <div class="d-grid gap-2 mb-3">
        <button type="button" class="btn btn-secondary" id="addProductBtn">Add Another Product</button>
      </div>

      <!-- Submit Button -->
      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">Submit Products</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function back() {
      window.location.href="home.php";
    }

    let rentCount = 1;
    document.getElementById('addProductBtn').addEventListener('click', () => {
      rentCount++;
      const productFields = document.getElementById('productFields');

      const newProductCard = `
      <div class="mb-3">
        <label for="productImages" class="form-label">Upload first view  image of the room</label>
        <input class="form-control" type="file" name="images[]" id="productImages" multiple accept="image/*">
      </div>
      
      <!-- Dynamic Product Fields -->
      <div id="productFields">

        <div class="card product-card">
          <div class="card-body">
            <h5 class="card-title">Section ${rentCount}</h5>
            <!-- Product Title -->
            <div class="mb-3">
              <label for="productTitle${rentCount}" class="form-label">Location of the house</label>
              <input type="text" name="product_titles[]" class="form-control" id="productTitle${rentCount}" placeholder="Enter the location">
            </div>
            <!-- Product Description -->
            <div class="mb-3">
              <label for="roomDescription${rentCount}" class="form-label">Room Description</label>
              <textarea class="form-control" name="product_descriptions[]" id="productDescription${rentCount}" rows="3" placeholder="Enter room description"></textarea>
            </div>
            <div class="mb-3">
              <label for="period${rentCount}" class="form-label">Peroid of the rent</label>
              <select class="form-control" name="period" id="period${rentCount}">
                <option>per month</option>
                <option>per day</option>
                <option>per year</option>
              </select>
            </div>
            <!-- Product Price -->
            <div class="mb-3">
              <label for="productPrice${rentCount}" class="form-label">Price (GHS)</label>
              <input type="number" name="product_prices[]" class="form-control" id="productPrice${rentCount}" placeholder="Enter price">
            </div>
            <div class="mb-3">
              <label for="rentDescription${rentCount}" class="form-label">Terms and Condition</label>
              <textarea class="form-control" name="rent_descriptions[]" id="rentDescription${rentCount}" rows="3" placeholder="Enter terms and condition about the room"></textarea>
          </div>
        </div>
      </div>
      `;

      productFields.insertAdjacentHTML('beforeend', newProductCard);
    });

    document.getElementById('productForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch('api/upload_products.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Products uploaded successfully!');
            window.location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while uploading.');
    });
});



    
  </script>
</body>
</html>
