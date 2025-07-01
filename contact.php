<?php require 'view/header.php'; ?>

<style>
  *, *::before, *::after {
    box-sizing: border-box;
  }

  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background: #fff;
    color: #333;
  }

  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  .contact-section {
    flex: 1;
    padding: 60px 20px;
    max-width: 600px;
    margin: 40px auto;
    background: #fff8f0; 
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(255, 165, 0, 0.2);
    text-align: center;
  }

  .contact-section h1 {
    font-weight: 700;
    font-size: 2.8rem;
    margin-bottom: 30px;
    color: #FF8C00;
    letter-spacing: 1.5px;
    text-transform: uppercase;
  }

  form.contact-form {
    display: flex;
    flex-direction: column;
    gap: 25px;
  }

  .form-group {
    text-align: left;
  }

  .form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #bf6200; 
    font-size: 1.1rem;
  }

  .form-group input,
  .form-group textarea {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #FFA500;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    resize: vertical;
    font-family: 'Arial', sans-serif;
  }

  .form-group input:focus,
  .form-group textarea:focus {
    outline: none;
    border-color: #FF8C00;
    box-shadow: 0 0 8px rgba(255, 140, 0, 0.4);
  }

  .submit-btn {
    background-color: #FFA500;
    color: white;
    padding: 16px 0;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 1.2rem;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    box-shadow: 0 4px 12px rgba(255, 165, 0, 0.5);
    transition: background-color 0.3s ease, transform 0.3s ease;
  }

  .submit-btn:hover {
    background-color: #e69500;
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(230, 149, 0, 0.7);
  }

  .policy-text {
    margin-top: 25px;
    font-size: 0.9rem;
    color: #666;
    font-style: italic;
  }

  @media (max-width: 640px) {
    .contact-section {
      margin: 20px 15px;
      padding: 40px 15px;
    }

    .contact-section h1 {
      font-size: 2rem;
    }

    .submit-btn {
      font-size: 1rem;
      padding: 14px 0;
    }
  }
</style>

<section class="contact-section">
  <h1>Contact Us</h1>

  <form class="contact-form" method="post" action="includes/handle-contact.php">
    <div class="form-group">
      <label for="email">Your Email</label>
      <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
    </div>
    
    <div class="form-group">
      <label for="question">What is your question?</label>
      <textarea id="question" name="question" placeholder="Type your question here..." required></textarea>
    </div>
    
    <button type="submit" class="submit-btn">Send your Request!</button>
    
    <p class="policy-text">You agree to our Privacy Policy and Terms.</p>
  </form>
</section>

<?php require 'view/footer.php'; ?>
