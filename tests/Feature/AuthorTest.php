<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    use RefreshDatabase;

    /**
     * Test create a post.
     */
    public function test_can_create_post()
    {
        $data = [
            'name' => 'Test Name',
            'bio' => 'Test Bio',
            'birth_date' => '2001-08-05',
        ];

        $response = $this->post(route('authors.store'), $data);

        $response->assertStatus(200); // Assuming API returns 200 status
        $this->assertDatabaseHas('authors', $data);
    }

    /**
     * Test read a post.
     */
    public function test_can_read_post()
    {
        $author = Author::factory()->create();

        $response = $this->get(route('authors.show', $author->id));

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $author->id,
            'name' => $author->name,
            'bio' => $author->bio,
            'birth_date' => $author->birth_date,
        ]);
    }

    /**
     * Test update a post.
     */
    public function test_can_update_post()
    {
        $author = Author::factory()->create();

        $updatedData = [
            'name' => 'Updated name',
            'bio' => 'Updated Content',
            'birth_date' => '2001-09-09',
        ];

        $response = $this->put(route('authors.update', $author->id), $updatedData);

        $response->assertStatus(200); // Assuming API returns 200 status
        $this->assertDatabaseHas('authors', $updatedData);
        $this->assertDatabaseMissing('authors', $author->toArray());
    }

    /**
     * Test delete a post.
     */
    public function test_can_delete_post()
    {
        $author = Author::factory()->create();

        $response = $this->delete(route('authors.destroy', $author->id));

        $response->assertStatus(200); // Assuming API returns 200 status
        $this->assertDatabaseMissing('authors', $author->toArray());
    }

    public function test_cannot_get_nonexistent_post()
{
    $response = $this->get(route('authors.show', 9999)); // ID tidak ada

    $response->assertStatus(404); // Not Found
}
}
