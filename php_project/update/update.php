<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload Form</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Dark Theme Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #f1f1f1;
        }
        .container {
            padding-top: 50px;
            max-width: 600px;
            margin: auto;
        }
        .btn-custom {
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
        }
        label {
            font-weight: bold;
            color: #f1f1f1;
        }
        .form-control {
            background-color: #333;
            color: #f1f1f1;
            border: 1px solid #555;
        }
        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.5);
        }
        .btn-custom:hover {
            background-color: #45a049;
        }
        h2 {
            color: #f1f1f1;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-control::placeholder {
            color: #bbb;
        }
        /* For Button Disabled State */
        .btn:disabled {
            background-color: #777;
            border-color: #555;
        }
.loader {
    display: none;
    position: fixed;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.7); /* Dark overlay */
    z-index: 1001;
    justify-content: center;
    align-items: center;
    backdrop-filter: blur(5px); /* Blurred background */
    animation: fadeIn 0.3s; /* Animation for showing */
}


.loader.active {
    display: flex; /* Show dialog when active */
    animation: fadeIn 0.3s; /* Animation for showing */
}


 .container-loader {
    --uib-size: 40px;
    --uib-color: rgb(255, 255, 255);
    --uib-speed: 2.5s;
    --uib-dot-size: calc(var(--uib-size) * 0.18);
    position: relative;
    top: 15%;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: var(--uib-size);
    height: var(--uib-size);
  }

  .dot {
    position: absolute;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    width: 100%;
    height: 100%;
  }

  .dot::before {
    content: '';
    display: block;
    height: calc(var(--uib-size) * 0.22);
    width: calc(var(--uib-size) * 0.22);
    border-radius: 50%;
    background-color: var(--uib-color);
    transition: background-color 0.3s ease;
  }

  .dot:nth-child(1) {
    animation: leapFrog var(--uib-speed) ease infinite;
  }

  .dot:nth-child(2) {
    transform: translateX(calc(var(--uib-size) * 0.4));
    animation: leapFrog var(--uib-speed) ease calc(var(--uib-speed) / -1.5)
      infinite;
  }

  .dot:nth-child(3) {
    transform: translateX(calc(var(--uib-size) * 0.8)) rotate(0deg);
    animation: leapFrog var(--uib-speed) ease calc(var(--uib-speed) / -3) infinite;
  }

  @keyframes leapFrog {
    0% {
      transform: translateX(0) rotate(0deg);
    }

    33.333% {
      transform: translateX(0) rotate(180deg);
    }

    66.666% {
      transform: translateX(calc(var(--uib-size) * -0.38)) rotate(180deg);
    }

    99.999% {
      transform: translateX(calc(var(--uib-size) * -0.78)) rotate(180deg);
    }

    100% {
      transform: translateX(0) rotate(0deg);
    }
  }



    </style>
</head>
<body>

    <div class="loader">
        <div class="container-loader">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>
    <div class="container">
        <h2 class="text-center">Upload Image</h2>
        <form action="save.php" method="POST" enctype="multipart/form-data">
            <!-- Image Upload -->
            <div class="form-group">
                <label for="image">Choose an image:</label>
                <input type="file" class="form-control" name="image" id="image" required>
            </div>

            <!-- Type Selection -->
            <div class="form-group">
                <label for="type">Type:</label>
                <select class="form-control" name="type" id="type" required>
                    <option value="all">All</option>
                    <option value="logo">Logo</option>
                    <option value="others">Others</option>
                </select>
            </div>

            <!-- Title Input -->
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-custom btn-block">Submit</button>
        </form>
    </div>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
function show_loading(){
    document.querySelector('.loader').classList.add('active');
}

function hide_loading(){
    document.querySelector('.loader').classList.remove('active');
}


document.getElementById('submitBtn').addEventListener('click', function () {
    const form = document.getElementById('uploadForm');
    const formData = new FormData(form); 
    show_loading();

    // AJAX Request
    fetch('save.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        hide_loading();
        // Display response message
        const responseMessage = document.getElementById('responseMessage');
        if (data.success) {
            hide_loading();
            responseMessage.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
        } else {
            hide_loading();
            responseMessage.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
    })
    .catch(error => {
        hide_loading();
        console.error('Error:', error);
        document.getElementById('responseMessage').innerHTML = `<div class="alert alert-danger">An error occurred while uploading.</div>`;
    });
});
</script>
</body>
</html>







