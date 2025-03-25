<?php

trait Categories {
    // Find Category by ID or Username
    public function findCategory($category = null) {
        if ($category) {
            $field = (is_numeric($category)) ? 'id' : 'username';
            $data = $this->_db->get('nr_categories', [$field, '=', $category]);

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    // Get categories by ID or Username or all categories
    public function getCategories($id = null) {
        $field = ($id && is_numeric($id)) ? 'category_main_id' : 'username';
        $data = $id ? $this->_db->get('nr_categories', [$field, '=', $id]) : $this->_db->all('nr_categories');

        return $data->count() ? $data->results() : [];
    }

    // Get all main categories
    public function getMainCategories() {
        $data = $this->_db->all('nr_categories_main');
        return $data->count() ? $data->results() : [];
    }

    // Get reviews in categories with pagination
    public function getReviewInCategories($id = null, $start = 0, $end = 0) {
        if ($id) {
            $data = $this->_db->allWithLimit('nr_review', ['review_category', '=', $id], $start, $end);
            return $data->count() ? $data->results() : [];
        }
        return [];
    }

    // Count reviews in a category
    public function countReviewInCategories($id = null) {
        if ($id) {
            $data = $this->_db->get('nr_review', ['review_category', '=', $id]);
            return $data->count();
        }
        return 0;
    }

    // Get categories for sidebar (based on category main id or username)
    public function getCategoriesSidebar($id = null) {
        $field = ($id && is_numeric($id)) ? 'category_main_id' : 'username';
        $data = $id ? $this->_db->get('nr_categories', [$field, '=', $id]) : $this->_db->all('nr_categories');

        return $data->count() ? $data->results() : [];
    }

    // Get specific column of main category
    public function mainCategoriesTable($id = null, $table) {
        if ($id) {
            $field = (is_numeric($id)) ? 'id' : 'username';
            $data = $this->_db->get('nr_categories_main', [$field, '=', $id]);

            if ($data->count()) {
                $this->_data = $data->first();
                return $this->data()->$table;
            }
        }
        return null;
    }

    // Get main category ID by category ID
    public function getIdMainCategory($category_id = null) {
        $data = $this->_db->get('nr_categories', ['id', '=', $category_id]);

        if ($data->count()) {
            $this->_data = $data->first();
            return $this->data()->category_main_id;
        }
        return null;
    }

    // Get explore categories with pagination
    public function getExploreCategories($start = 0, $end = 0) {
        $data = $this->_db->allLimit('nr_categories', $start, $end);
        return $data->count() ? $data->results() : [];
    }
}

trait Posts {
    // Update a post by ID
    public function updatePost($fields = array(), $id = null) {
        return $this->_db->update('nr_posts', $id, $fields);
    }

    // Create a new post
    public function createPost($fields = array()) {
        return $this->_db->insert('nr_posts', $fields);
    }

    // Delete a post by post ID
    public function deletePost($post_id) {
        if ($post_id) {
            $user = new User();
            return $this->_db->delete('nr_posts', ['id', '=', $post_id], $user->data()->id);
        }
        return false;
    }

    // Get posts in a review with pagination
    public function getPostsInReview($id = null, $start = 0, $end = 0) {
        if ($id) {
            $data = $this->_db->allWithLimit('nr_posts', ['review_id', '=', $id], $start, $end);
            return $data->count() ? $data->results() : [];
        }
        return [];
    }

    // Get posts by user with pagination
    public function getPostsInUser($id = null, $start = 0, $end = 0) {
        if ($id) {
            $data = $this->_db->allWithLimit('nr_posts', ['user_id', '=', $id], $start, $end);
            return $data->count() ? $data->results() : [];
        }
        return [];
    }

    // Count posts in a review
    public function countPostsInReview($id = null) {
        if ($id) {
            $data = $this->_db->get('nr_posts', ['review_id', '=', $id]);
            return $data->count();
        }
        return 0;
    }

    // Count posts by user
    public function countPostsInUser($id = null) {
        if ($id) {
            $data = $this->_db->get('nr_posts', ['user_id', '=', $id]);
            return $data->count();
        }
        return 0;
    }

    // Create a helpful mark for a post
    public function createHelpful($fields = array()) {
        return $this->_db->insert('nr_helpful', $fields);
    }

    // Delete a helpful mark for a post
    public function deleteHelpful($post_id) {
        if ($post_id) {
            $user = new User();
            return $this->_db->delete('nr_helpful', ['post_id', '=', $post_id], $user->data()->id);
        }
        return false;
    }

    // Check if a post is marked as helpful
    public function isHelpful($post_id = null) {
        if ($post_id) {
            $user = new User();
            $data = $this->_db->get('nr_helpful', ['post_id', '=', $post_id], $user->data()->id);
            return $data->count() ? 1 : 0;
        }
        return 0;
    }

    // Count helpful marks for a user
    public function countHelpfulInUser($id = null) {
        if ($id) {
            $data = $this->_db->get('nr_helpful', ['user_id', '=', $id]);
            return $data->count();
        }
        return 0;
    }
}

class Review {
    private $_db, $_data;

    use Posts, Categories;

    // Constructor
    public function __construct($review = null) {
        $this->_db = DB::getInstance();
        $this->find($review);
    }

    // Update review data
    public function update($fields = array(), $id = null) {
        return $this->_db->update('nr_review', $id, $fields);
    }

    // Create a new review
    public function create($fields = array()) {
        return $this->_db->insert('nr_review', $fields);
    }

    // Find a review by ID or Username
    public function find($review = null) {
        if ($review) {
            $field = (is_numeric($review)) ? 'id' : 'review_username';
            $data = $this->_db->get('nr_review', [$field, '=', $review]);

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    // Get rating for a review
    public function getRatingInReview($id = null) {
        if ($id) {
            $data = $this->_db->get('nr_posts', ['review_id', '=', $id]);

            if ($data->count()) {
                $sum_rates = array_sum(array_column($data->results(), 'rating'));
                $count_rat = $data->count();
                return round(($sum_rates / $count_rat), 1);
            }
        }
        return '0.0';
    }

    // Check if review exists
    public function exists() {
        return !empty($this->_data);
    }

    // Return review data
    public function data() {
        return $this->_data;
    }

    // Get domain host from URL
    public static function getDomainHost($url = null) {
        return str_ireplace('www.', '', parse_url($url, PHP_URL_HOST));
    }
}
?>
