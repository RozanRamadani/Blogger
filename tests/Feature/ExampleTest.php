<?php

test('the application redirects guests from home to login', function () {
    $response = $this->get('/');

    $response->assertStatus(302);
});
