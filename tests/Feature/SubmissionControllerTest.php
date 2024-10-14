<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

use App\Models\Submission;

class SubmissionControllerTest extends TestCase
{
    //use RefreshDatabase;       // Refresh DB before tests
    use DatabaseTransactions;

    public function test_can_list_submissions(): void
    {
        $response = $this->getJson(route('index'));
        $response->assertStatus(200);
    }

    public function test_can_create_submission(): void
    {
        $submissionData = [
            'name' => 'Test submission',
            'email' => 'test@mail.com',
            'message' => 'This is a test'
        ];
        $response = $this->postJson(route('submit'), $submissionData);
        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Test submission']);
        $this->assertDatabaseHas('submissions', ['email' => 'test@mail.com']);
    }

    public function test_can_show_submission(): void
    {
        $submission = Submission::factory()->create();
        $response = $this->getJson(route('show', ['submission' => $submission->id]));
        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $submission->id]);
    }

    public function test_can_update_submission(): void
    {
        $submission = Submission::factory()->create();
        $updatedData = [
            'name' => 'Updated submission',
            'email' => 'updated@email.com',
            'message' => 'Updated message'
        ];
        $response = $this->putJson(route('update', ['submission' => $submission->id]), $updatedData);
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated submission']);
        $this->assertDatabaseHas('submissions', ['id' => $submission->id, 'name' => 'Updated submission']);
    }

    public function test_can_delete_user(): void
    {
        $submission = Submission::factory()->create();
        $response = $this->deleteJson(route('delete', ['submission' => $submission->id]));
        $response->assertStatus(204);
        $this->assertDatabaseMissing('submissions', ['id' => $submission->id]);
    }
}
