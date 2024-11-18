<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
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

    /**
     * Test create a post.
     */
    public function test_can_create_post()
    {
        $data = [
            'title' => 'Test title',
            'description' => 'Test Bio',
            'publish_date' => '2001-08-05',
            'author_id' => '1',
        ];

        $response = $this->post(route('books.store'), $data);

        $response->assertStatus(200); // Assuming API returns 200 status
        $this->assertDatabaseHas('books', $data);
    }

    /**
     * Test read a post.
     */
    public function test_can_read_post()
    {
        $book = Book::factory()->create();

        $response = $this->get(route('books.show', $book->id));

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $book->id,
            'title' => $book->title,
            'description' => $book->description,
            'publish_date' => $book->publish_date,
            'author_id' => $book->author_id,
        ]);
    }

    /**
     * Test update a post.
     */
    public function test_can_update_post()
    {
        $book = Book::factory()->create();

        $updatedData = [
            'title' => 'Updated title',
            'description' => 'Updated Content',
            'publish_date' => '2001-09-09',
            'author_id' => '1',
        ];

        $response = $this->put(route('books.update', $book->id), $updatedData);

        $response->assertStatus(200); // Assuming API returns 200 status
        $this->assertDatabaseHas('books', $updatedData);
        $this->assertDatabaseMissing('books', $book->toArray());
    }

    /**
     * Test delete a post.
     */
    public function test_can_delete_post()
    {
        $book = Book::factory()->create();

        $response = $this->delete(route('books.destroy', $book->id));

        $response->assertStatus(200); // Assuming API returns 200 status
        $this->assertDatabaseMissing('books', $book->toArray());
    }
}
