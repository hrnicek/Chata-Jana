<?php

namespace Tests\Feature;

use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function test_contact_page_is_displayed()
    {
        $response = $this->get(route('contact'));

        $response->assertStatus(200);
    }

    public function test_contact_form_can_be_submitted()
    {
        Mail::fake();

        $response = $this->post(route('contact.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '+420123456789',
            'message' => 'This is a test message with at least 10 characters.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        Mail::assertSent(ContactFormMail::class, function ($mail) {
            return $mail->hasTo('info@chata-jana.cz') &&
                   $mail->data['email'] === 'test@example.com';
        });
    }

    public function test_contact_form_validation()
    {
        $response = $this->post(route('contact.store'), [
            'name' => '',
            'email' => 'invalid-email',
            'message' => 'short',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'message']);
    }
}
