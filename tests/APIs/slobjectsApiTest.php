<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\slobjects;

class slobjectsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_slobjects()
    {
        $slobjects = slobjects::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/slobjects', $slobjects
        );

        $this->assertApiResponse($slobjects);
    }

    /**
     * @test
     */
    public function test_read_slobjects()
    {
        $slobjects = slobjects::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/slobjects/'.$slobjects->id
        );

        $this->assertApiResponse($slobjects->toArray());
    }

    /**
     * @test
     */
    public function test_update_slobjects()
    {
        $slobjects = slobjects::factory()->create();
        $editedslobjects = slobjects::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/slobjects/'.$slobjects->id,
            $editedslobjects
        );

        $this->assertApiResponse($editedslobjects);
    }

    /**
     * @test
     */
    public function test_delete_slobjects()
    {
        $slobjects = slobjects::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/slobjects/'.$slobjects->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/slobjects/'.$slobjects->id
        );

        $this->response->assertStatus(404);
    }
}
