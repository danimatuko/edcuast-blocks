<?php

function educast_blocks_signup($request)
{
    // Default response with failure status
    $response = [
        'status' => 0,
        'message' => 'Invalid parameters provided.'
    ];

    // Retrieve and sanitize parameters
    $params = $request->get_params();
    $email = isset($params['email']) ? sanitize_email($params['email']) : '';
    $username = isset($params['username']) ? sanitize_text_field($params['username']) : '';
    $password = isset($params['password']) ? sanitize_text_field($params['password']) : '';

    // Validate parameters
    if (empty($email) || empty($username) || empty($password)) {
        return $response; // Early return if any required field is missing
    }

    // Validate email format
    if (!is_email($email)) {
        $response['message'] = 'Invalid email format.';
        return $response;
    }

    // Check if email is already in use
    if (email_exists($email)) {
        $response['message'] = 'Email already in use.';
        return $response;
    }

    // Check if username is already in use
    if (username_exists($username)) {
        $response['message'] = 'Username already in use.';
        return $response;
    }

    $user_id = wp_insert_user([
        'user_login' => $username,
        'user_pass'  => $password,  // Use 'user_pass' for password
        'user_email' => $email
    ]);

    if (is_wp_error($user_id)) {
        return $response;
    }


    wp_new_user_notification($user_id, null, 'user');
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);


    $user = get_user_by('id', $user_id);

    do_action('wp_login', $user->user->login);

    // If all checks pass, update response status
    $response['status'] = 1;
    $response['message'] = 'Parameters validated successfully.';

    return $response;
}
