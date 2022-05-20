<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SlObject;

class SlObjectApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_sl_object()
    {
        $slObject = SlObject::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sl_objects', $slObject
        );

        $this->assertApiResponse($slObject);
    }

    /**
     * @test
     */
    public function test_read_sl_object()
    {
        $slObject = SlObject::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/sl_objects/'.$slObject->id
        );

        $this->assertApiResponse($slObject->toArray());
    }

    /**
     * @test
     */
    public function test_update_sl_object()
    {
        $slObject = SlObject::factory()->create();
        $editedSlObject = SlObject::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sl_objects/'.$slObject->id,
            $editedSlObject
        );

        $this->assertApiResponse($editedSlObject);
    }

    /**
     * @test
     */
    public function test_delete_sl_object()
    {
        $slObject = SlObject::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sl_objects/'.$slObject->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sl_objects/'.$slObject->id
        );

        $this->response->assertStatus(404);
    }
}
