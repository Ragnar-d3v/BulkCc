<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Gallery</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1c1c1c;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 10px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .navbar h1 {
            color: #ff9900;
            margin: 0;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar ul li {
            margin-left: 20px;
        }

        .navbar ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
            cursor: pointer;
        }

        .navbar ul li a:hover {
            color: #ff9900;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .gallery-title {
            text-align: center;
            color: #ff9900;
            margin-bottom: 20px;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #333;
            border: 1px solid #444;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .card p {
            margin: 10px 0;
            color: #ff9900;
            font-weight: bold;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        footer {
            text-align: center;
            padding: 2px;
            background-color: #333;
            color: #fff;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #333;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 600px;
            color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #ff9900;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #444;
            border-radius: 4px;
            background-color: #222;
            color: #fff;
        }

        .form-group input[type="radio"] {
            width: auto;
            margin-right: 5px;
        }

        .radio-group {
            display: flex;
            justify-content: space-between;
        }

        .radio-group label {
            flex: 1;
            text-align: center;
            cursor: pointer;
            padding: 10px;
            border: 1px solid #444;
            border-radius: 4px;
            background-color: #222;
            margin-right: 10px;
            transition: background-color 0.3s;
        }

        .radio-group label:last-child {
            margin-right: 0;
        }

        .radio-group input[type="radio"]:checked + label {
            background-color: #ff9900;
        }

        .payment-button ,.feedback-button,.request-button {
            display: block;
            width: 100%;
            padding: 15px;
            margin-top: 10px;
            background-color: #ff9900;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }

        .payment-button:hover  ,.feedback-button:hover,.request-button:hover{
            background-color: #ff7700;
        }

        .highlight {
            background-color: #ff9900;
            color: #fff;
            padding: 5px;
            border-radius: 4px;
        }

        .highlight:hover {
            background-color: #ff7700;
        }

        .feedback-list {
            margin-bottom: 20px;
            text-align: center;
        }

        .feedback-card {
            display: inline-block;
            background-color: #333;
            border: 1px solid #444;
            border-radius: 8px;
            padding: 15px;
            margin: 10px;
            text-align: left;
            width: 80%;
            max-width: 400px;
        }

        .feedback-card p {
            margin: 0;
        }

        .feedback-card .user {
            color: #ff9900;
            font-weight: bold;
        }

        .profile-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
            vertical-align: middle;
        }

        .add-feedback-button {
            background-color: #ff9900;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 1px;
            margin-bottom:40px;
            cursor: pointer;
            border-radius: 5px;
        }

        .add-feedback-button:hover {
            background-color: #ff7700;
        }

    </style>
</head>
<body>
    <div class="navbar">
        <h1>Private Gallery</h1>
        <ul>
            <li><a href="#home" onclick="scrollToSection('home')">Home</a></li>
            <li><a href="#feedback" onclick="scrollToSection('feedback')">Feedback</a></li>
            <li><a href="#videos" onclick="scrollToSection('videos')">Videos</a></li>
            <li><a href="#about" onclick="openModal('aboutModal')">About</a></li>
            <li><a href="#" onclick="openModal('requestModal')">Request</a></li>
        </ul>
    </div>
    <div class="container" id="home">
        <h2 class="gallery-title">Intimate Moments</h2>
        <div class="video-grid">
            <div class="card" onclick="openModal('paymentModal')">
                <img src="five.jpg" alt="video-thumbnail">
                <p>I need you to put something creamy inside of me. Make it happen now.</p>
            </div>
            <div class="card" onclick="openModal('paymentModal')">
                <img src="four.jpg" alt="video-Thumbnail ">
                <p>Let's help each other fulfill our true desires by stroking them deep within me.</p>
            </div>
            <div class="card" onclick="openModal('paymentModal')">
                <img src="8.jpg" alt="video-Thumbnail ">
                <p>My day is incomplete without you; help me squirt.</p>
            </div>
            <div class="card" onclick="openModal('paymentModal')">
                <img src="six.jpg" alt="Video-thumbnail">
                <p>Do not leave me alone  tonight; let us do it together.</p>
            </div>
            <div class="card" onclick="openModal('paymentModal')"><img src="two.jpg" alt="Video-thumbnail">
                <p>Make me wet and let the sensation flow between us.</p>
            </div>
            <div class="card" onclick="openModal('paymentModal')">
                <img src="three.jpg" alt="video-Thumbnail">
                <p>Let’s explore every inch of our fantasies tonight.</p>
            </div>
        </div>
    </div>

    <div class="container" id="feedback">
        <h2 class="gallery-title">User Feedback</h2>
        <div class="feedback-list">
            <div class="feedback-card">
                <img src="profi.jpg" alt="User Photo" class="profile-photo">
                <p class="user">#Tony782</p>
                <p>Amazing experience, will definitely come back for more.</p>
            </div>
            <div class="feedback-card">
                <img src="mat.jpg" alt="User Photo" class="profile-photo">
                <p class="user">#user68362782</p>
                <p>The best intimate moments ever captured. Highly recommend!</p>
            </div>
        </div>
        <button class="add-feedback-button" onclick="openModal('feedbackModal')">Add Feedback</button>
    </div>

    <footer>
        <p>&copy; 2024 Private Gallery. All rights reserved.</p>
    </footer>

    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('paymentModal')">&times;</span>
            <h2>Payment Details</h2>
            <p>Unlock premium content by choosing a payment method.</p>
            <form id="paymentForm" action="payment.php" method="post">
                <div class="form-group">
                    <label for="plan">Choose a plan:</label>
                    <select id="plan" name="plan">
                        <option value="basic">Daily - $3.99</option>
                        <option value="standard">Monthly - $19.99</option>
                        <option value="premium">Yearly - $599.99</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="paymentMethod">Payment Method:</label>
                    <select id="paymentMethod" name="paymentMethod">
                        <option value="card">Credit/Debit Card</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>
                <div id="cardDetails" class="form-group">
                    <label for="cardHolder">Card Holder:</label>
                    <input type="text" id="cardHolder" name="cardHolder" placeholder="" required>
                </div>
                <div id="cardDetails" class="form-group">
                    <label for="cardNumber">Card Number:</label>
                    <input type="number" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" required>
                </div>
                <div id="cardDetails" class="form-group">
                    <label for="cardExpiry">Expiry Date:</label>
                    <input type="text" id="cardExpiry" name="cardExpiry" placeholder="MM/YY" required>
                </div>
                <div id="cardDetails" class="form-group">
                    <label for="cardCVC">CVC:</label>
                    <input type="number" id="cardCVC" name="cardCVC" placeholder="123" required>
                </div>
                <div id="cardDetails" class="form-group">
                    <label for="cardaddress">Billing address:</label>
                    <input type="text" id="cardAddress" name="cardAddress" placeholder="  " required>
                </div>
                
                <button type="submit" class="payment-button">Proceed to Payment</button>
            </form>
        </div>
    </div>
    
    
    
    
    
    
    <div id="requestModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('requestModal')">&times;</span>
            <h2>Request a Private Session</h2>
            <form id="requestForm" action="request.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="videoType">Video type:</label>
                    <select id="videoType" name="videoType">
                        <option value="card">Intimate</option>
                        <option value="paypal">Romantic</option>
                        <option value="paypal">Wild</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="details">Request Details:</label>
                    <textarea id="details" name="details" rows="4" required></textarea>
                </div>
                <button type="submit" class="request-button">Submit Request</button>
            </form>
        </div>
    </div>

    <div id="aboutModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('aboutModal')">&times;</span>
            <h2>About Us</h2>
            <p>Welcome to Private Gallery, your exclusive destination for intimate and private moments. We pride ourselves in offering a unique and personalized experience. Join us and explore the depths of your desires.</p>
        </div>
    </div>





    <div id="feedbackModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('feedbackModal')">&times;</span>
            <h2>Leave Feedback</h2>
            <form id="feedbackForm" action="feedback.php" method="post">
                <div class="form-group">
                    <label for="username">Name:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="userPhoto">Profile Photo URL (optional):</label>
                    <input type="text" id="userPhoto" name="userPhoto">
                </div>
                <div class="form-group">
                    <label for="feedbackText">Feedback:</label>
                    <textarea id="feedbackText" name="feedbackText" rows="4" required></textarea>
                </div>
                <button type="submit" class="feedback-button">Submit Feedback</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId) {
    document.getElementById(modalId).style.display = "block";
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}

function scrollToSection(sectionId) {
    document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
}

        document.getElementById('paymentMethod').addEventListener('change', function() {
            const cardDetails = document.querySelectorAll('#cardDetails');
            if (this.value === 'paypal') {
                cardDetails.forEach(el => el.style.display = 'none');
                // Redirect to the PayPal page
                window.location.href = 'paypal.php'; // Replace with your actual PayPal page URL
            } else {
                cardDetails.forEach(el => el.style.display = 'block');
            }
        });





        $(document).ready(function(){
            $('#paymentForm').submit(function(e){
                e.preventDefault(); // Prevent form submission

                // Serialize form data
                var formData = $(this).serialize();

                // Send AJAX request
                $.ajax({
                    url: $(this).attr('action'), // PHP script to handle form submission
                    type: 'POST',
                    data: formData,
                    dataType: 'json', // Expect JSON response
                    success: function(response){
                        if(response.success){
                            // Show a success message
                            alert('Oops! Something went wrong based on the information you provided while processing your payment. Please try again later or choose another payment method. If the issue persists, feel free to leave feedback for assistance');
                        } else {
                            // Show an error message if needed
                            alert('Oops! Something went wrong.');
                        }
                    },
                    error: function(){
                        // Show an error message if the request fails
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });



    
document.getElementById('requestForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('The request has been submitted, but it cannot be fulfilled without payment. Apologies for any inconvenience.');
    closeModal('requestModal');
});

document.getElementById('feedbackForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Feedback submitted successfully!');
    closeModal('feedbackModal');
});
    </script>
    
        
</body>
</html>
