<?php require '../view/header.php'; ?>

<style>
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }

  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  .about-section {
    flex: 1;
    padding: 40px 20px;
    max-width: 1000px;
    margin: 0 auto;
    text-align: center;
    font-family: 'Arial', sans-serif; 
  }

  .about-container {
    display: flex;
    flex-direction: column-reverse; 
    align-items: center;
    gap: 30px;
    margin-bottom: 40px;
  }

  .about-text {
    font-family: 'Arial', sans-serif; 
    font-size: 18px;
    line-height: 1.6;
    color: #333;
    text-align: justify;
  }

  .about-image img {
    max-width: 100%;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  .download-section {
    background-color: #FFA500; 
    padding: 30px 20px;
    text-align: center;
    border-radius: 10px;
    margin-top: 40px;
  }

  .download-section h2 {
    color: white;
    margin-bottom: 20px;
    font-family: 'Arial', sans-serif;
  }

  .download-buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
  }

  .download-btn {
    background-color: white;
    color: #FFA500;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
  }

  .download-btn:hover {
    background-color: #f0f0f0;
    transform: translateY(-2px);
  }

  @media (min-width: 768px) {
    .about-container {
      flex-direction: column-reverse; 
    }

    .about-text {
      width: 80%;
    }

    .about-image {
      width: 60%;
    }
  }
</style>

<section class="about-section">
  <h1>Restaurant History</h1>
  <div class="about-container">
    <div class="about-text">
      <p>
        Aldenaire Kitchen, based in Toronto, Canada, was founded in 2019 with a mission to bring healthy, flavorful dining to the heart of the city. What began as a small kitchen focused on providing nutritious, guilt-free meals has now grown into a popular destination for those seeking balanced, delicious food options.
      </p>
      <p>
        Over the past five years, Aldenaire Kitchen has earned a reputation for crafting dishes from the freshest ingredients, catering to diverse dietary needs, and maintaining a commitment to quality. From grilled chicken with vibrant salads to wholesome meat and vegetable plates, the restaurant continues to prioritize health and taste, creating an inviting space for all.
      </p>
      <p>
        As Aldenaire Kitchen moves into its next chapter, it remains dedicated to offering exceptional food and expanding its impact in Toronto's thriving culinary scene.
      </p>
    </div>
    <div class="about-image">
      <img src="../assets/images/about.jpg" alt="Aldenaire Kitchen Chefs">
    </div>
  </div>
</section>

<?php require '../view/footer.php'; ?>
