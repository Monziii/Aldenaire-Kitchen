import React, { useState, useEffect, useCallback } from 'react';
import './Reviews.css';

const Reviews = () => {
  const [reviews, setReviews] = useState([]);
  const [newReview, setNewReview] = useState({
    customer_name: '',
    rating: 5,
    comment: ''
  });
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [submitStatus, setSubmitStatus] = useState(null);
  const [isLoading, setIsLoading] = useState(true);
  const [apiAvailable, setApiAvailable] = useState(true);

  const fetchReviews = useCallback(async () => {
    try {
      console.log('Fetching reviews from:', '/api/reviews.php');
      const controller = new AbortController();
      const timeoutId = setTimeout(() => controller.abort(), 5000); // 5 second timeout
      
      const response = await fetch('/api/reviews.php', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        },
        signal: controller.signal,
      });
      
      clearTimeout(timeoutId);
      console.log('Response status:', response.status);
      console.log('Response ok:', response.ok);
      
      if (!response.ok) {
        const errorText = await response.text();
        console.error('Response error text:', errorText);
        throw new Error(`Failed to fetch reviews: ${response.status} ${response.statusText}`);
      }
      
      const data = await response.json();
      console.log('Reviews data received:', data);
      setReviews(data.reviews || []);
      setApiAvailable(true);
    } catch (error) {
      console.error('Error fetching reviews:', error);
      // Fallback to mock data if API fails
      setReviews(getMockReviews());
      setApiAvailable(false);
    }
  }, []);

  useEffect(() => {
    const loadData = async () => {
      setIsLoading(true);
      await Promise.all([fetchReviews()]);
      setIsLoading(false);
    };
    loadData();
  }, [fetchReviews]);

  const getMockReviews = () => {
    return [
      {
        id: 1,
        customer_name: "Sarah Johnson",
        rating: 5,
        comment: "Absolutely delicious! The chicken was perfectly grilled and the salad was fresh. Highly recommend!",
        created_at: "2024-01-15"
      },
      {
        id: 2,
        customer_name: "Michael Chen",
        rating: 4,
        comment: "Great flavor and the fish was cooked perfectly. The lemon sauce was a nice touch.",
        created_at: "2024-01-14"
      },
      {
        id: 3,
        customer_name: "Emily Rodriguez",
        rating: 5,
        comment: "Best calamari I've ever had! Crispy on the outside, tender on the inside. Amazing!",
        created_at: "2024-01-13"
      },
      {
        id: 4,
        customer_name: "David Wilson",
        rating: 4,
        comment: "Solid burger with good quality chicken. The bun was fresh and the toppings were perfect.",
        created_at: "2024-01-12"
      },
      {
        id: 5,
        customer_name: "Lisa Thompson",
        rating: 5,
        comment: "The shrimp was perfectly grilled and the garlic butter sauce was divine. Will definitely order again!",
        created_at: "2024-01-11"
      }
    ];
  };

  const handleChange = (e) => {
    setNewReview({
      ...newReview,
      [e.target.name]: e.target.value
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsSubmitting(true);
    setSubmitStatus(null);

    try {
      if (!apiAvailable) {
        // If API is not available, use mock submission
        await new Promise(resolve => setTimeout(resolve, 1000));
        
        // Create new review
        const newReviewData = {
          id: reviews.length + 1,
          customer_name: newReview.customer_name,
          rating: parseInt(newReview.rating),
          comment: newReview.comment,
          created_at: new Date().toISOString().split('T')[0]
        };

        // Add to reviews
        setReviews(prevReviews => [newReviewData, ...prevReviews]);

        // Reset form
        setNewReview({
          customer_name: '',
          rating: 5,
          comment: ''
        });

        setSubmitStatus('success');
        return;
      }

      const response = await fetch('/api/reviews.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(newReview)
      });

      if (!response.ok) {
        const errorData = await response.json();
        throw new Error(errorData.error || 'Failed to submit review');
      }

      const data = await response.json();
      
      // Add new review to the list
      setReviews(prevReviews => [data.review, ...prevReviews]);

      // Reset form
      setNewReview({
        customer_name: '',
        rating: 5,
        comment: ''
      });

      setSubmitStatus('success');
    } catch (error) {
      console.error('Error submitting review:', error);
      setSubmitStatus('error');
    } finally {
      setIsSubmitting(false);
    }
  };

  const renderStars = (rating) => {
    return '⭐'.repeat(rating) + '☆'.repeat(5 - rating);
  };

  if (isLoading) {
    return (
      <div className="reviews-page">
        <div className="loading">Loading reviews...</div>
      </div>
    );
  }

  return (
    <div className="reviews-page">
      <section className="reviews-section">
        <h1>Customer Reviews</h1>
        <p>See what our customers are saying about our delicious dishes!</p>

        {!apiAvailable && (
          <div className="api-warning">
            <p>⚠️ API is not available. Using demo mode - reviews will be saved locally only.</p>
          </div>
        )}

        <div className="reviews-content">
          <div className="reviews-list">
            <h2>Recent Reviews</h2>
            {reviews.length > 0 ? (
              <div className="reviews-grid">
                {reviews.map(review => (
                  <div key={review.id} className="review-card">
                    <div className="review-header">
                      <h3>Customer Review</h3>
                      <div className="stars">{renderStars(review.rating)}</div>
                    </div>
                    <p className="review-comment">{review.comment}</p>
                    <div className="review-footer">
                      <span className="customer-name">- {review.customer_name}</span>
                      <span className="review-date">{new Date(review.created_at).toLocaleDateString()}</span>
                    </div>
                  </div>
                ))}
              </div>
            ) : (
              <p>No reviews yet. Be the first to leave a review!</p>
            )}
          </div>

          <div className="review-form-container">
            <h2>Leave a Review</h2>
            <form onSubmit={handleSubmit} className="review-form">
              <div className="form-group">
                <label htmlFor="customer_name">Your Name *</label>
                <input
                  type="text"
                  id="customer_name"
                  name="customer_name"
                  value={newReview.customer_name}
                  onChange={handleChange}
                  required
                />
              </div>

              <div className="form-group">
                <label htmlFor="rating">Rating *</label>
                <select
                  id="rating"
                  name="rating"
                  value={newReview.rating}
                  onChange={handleChange}
                  required
                >
                  <option value="5">⭐⭐⭐⭐⭐ (5 stars)</option>
                  <option value="4">⭐⭐⭐⭐☆ (4 stars)</option>
                  <option value="3">⭐⭐⭐☆☆ (3 stars)</option>
                  <option value="2">⭐⭐☆☆☆ (2 stars)</option>
                  <option value="1">⭐☆☆☆☆ (1 star)</option>
                </select>
              </div>

              <div className="form-group">
                <label htmlFor="comment">Your Review *</label>
                <textarea
                  id="comment"
                  name="comment"
                  value={newReview.comment}
                  onChange={handleChange}
                  rows="4"
                  required
                  placeholder="Tell us about your experience..."
                ></textarea>
              </div>

              <button 
                type="submit" 
                className="submit-btn"
                disabled={isSubmitting}
              >
                {isSubmitting ? 'Submitting...' : 'Submit Review'}
              </button>

              {submitStatus === 'success' && (
                <div className="success-message">
                  Thank you! Your review has been submitted successfully.
                  {!apiAvailable && <span> (Saved locally)</span>}
                </div>
              )}

              {submitStatus === 'error' && (
                <div className="error-message">
                  Sorry, there was an error submitting your review. Please try again.
                </div>
              )}
            </form>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Reviews; 