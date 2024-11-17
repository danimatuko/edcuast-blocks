<?php

function educast_blocks_signin($request)
{
    // Retrieve and sanitize input
    $params = $request->get_params();
    $username = sanitize_user($params['username'] ?? '');
    $password = sanitize_text_field($params['password'] ?? '');

    // Prepare default response
    $response = [
        'status' => 0,
        'message' => 'The username or password you entered is incorrect.',
    ];

    // Check for missing fields
    if (empty($username) || empty($password)) {
        $response['message'] = 'Both username and password are required.';
        return new WP_REST_Response($response, 400);  // Return HTTP status 400 for bad request
    }

    // Attempt to sign in
    $user = wp_signon([
        'user_login' => $username,
        'user_password' => $password,
        'remember' => true,
    ]);

    // If sign-in failed, return the same error message
    if (is_wp_error($user)) {
        return new WP_REST_Response($response, 401);  // Return HTTP status 401 for authentication failure
    }

    // Successfully authenticated
    $response = [
        'status' => 1,
        'message' => 'User logged in successfully.',
        'user_id' => $user->ID, // Optional: Return user ID
    ];

    return new WP_REST_Response($response, 200);  // Return HTTP status 200 for success
}
